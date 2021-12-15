<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Data\URLs;

use Sphp\Apps\Trackers\Data\AbstractDB;
use PDO;
use Sphp\Apps\Trackers\Data\DataException;

/**
 * Class URLDataDb
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class URLDataDb extends AbstractDB {

  public function containsUrlData(URLData $urlData): bool {
    $stmt = $this->pdo()->prepare('SELECT 1 FROM urls WHERE hash=? LIMIT 1');
    $stmt->execute([$urlData->getHash()]);
    return $stmt->fetchColumn() !== false;
  }

  /**
   * 
   * @param  URLData $urlData
   * @return bool
   * @throws DataException
   */
  protected function insert(URLData $urlData): bool {
    $pdo = $this->pdo();
    try {
      $sql = 'INSERT INTO urls (hash, sheme, domain, path, query, lastVisit) VALUES (?, ?, ?, ?, ?, ?)';
      $pdo->beginTransaction();
      $stmt = $pdo->prepare($sql);
      $data = [
          $urlData->getHash(),
          $urlData->getSheme(),
          $urlData->getDomain(),
          $urlData->getPath(),
          $urlData->getQuery(),
          $urlData->getLastVisitAsTimestamp()];
      $success = $stmt->execute($data);
      $pdo->commit();
    } catch (\Throwable $e) {
      if ($pdo->inTransaction()) {
        $pdo->rollback();
      }
      throw new DataException('URL data insertion failed', 0, $e);
    }
    return $success;
  }

  protected function update(URLData $urlData) {
    $pdo = $this->pdo();
    try {
      $pdo->beginTransaction();
      $stmt = $pdo->prepare(
              'UPDATE urls SET visits=visits+1, lastVisit=? WHERE domain=? AND path=?');
      $data = [
          $urlData->getLastVisitAsTimestamp(),
          $urlData->getDomain(),
          $urlData->getPath(),];
      $success = $stmt->execute($data);
      $pdo->commit();
    } catch (\Exception $e) {
      if ($pdo->inTransaction()) {
        $pdo->rollback();
      }
      throw new DataException('Data saving faled', 0, $e);
    }
    return $success;
  }

  public function updateSiteData(URLData $urlData) {
    if (!$this->containsUrlData($urlData)) {
      $result = $this->insert($urlData);
    } else {
      $result = $this->update($urlData);
    }
    return $result;
  }

  /**
   * 
   * @param  string $domain
   * @return PathShareData[]
   * @throws DataException
   */
  public function getPathStats(string $domain = null, int $limit = null): array {
    $sql = "WITH total AS 
            (SELECT SUM(visits) AS total FROM urls WHERE domain=:domain)
             SELECT sheme, query, hash, domain, path, visits, lastVisit, (visits/total)*100 AS share
              FROM urls, total WHERE domain=:domain GROUP BY path ORDER BY share DESC, path";
    if ($limit > 0) {
      $sql .= " LIMIT $limit";
    }
    $data = ['domain' => $domain];
    $this->pdo()->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
    $stmt = $this->pdo()->prepare($sql);
    $stmt->execute($data);
    $result = $stmt->fetchAll(PDO::FETCH_CLASS, PathShareData::class);
    if ($result === false) {
      throw new DataException('URL data fetchin failed');
    }
    return $result;
  }

}
