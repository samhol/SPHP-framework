<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers;

use Sphp\Exceptions\RuntimeException;

/**
 * Description of UserAgentDataController
 *
 * @author samih
 */
class UserAgentDataController extends AbstractDataController {

  public function containsUserAgent(string $userAgent): bool {
    $stmt = $this->getPdo()->prepare('SELECT 1 AS num FROM userAgents WHERE userAgent = ? LIMIT 1');
    $stmt->execute([$userAgent]);
    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
    // var_dump($row);
    return $row !== false;
  }

  public function getDbId(string $userAgent): ?int {
    $stmt = $this->getPdo()->prepare('SELECT id FROM userAgents WHERE userAgent = ?');
    $stmt->execute([$userAgent]);
    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $row['id'];
  }

  public function storeUserAgent(string $userAgent, \DateTimeImmutable $visited = null): int {
    if ($visited === null) {
      $visited = new \DateTimeImmutable();
    }
    $dateStr = $visited->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s');
    try {
      //We start our transaction.
      $this->getPdo()->beginTransaction();
      if ($this->containsUserAgent($userAgent)) {
        $sql = "INSERT INTO userAgents (userAgent, firstVisit) VALUES (?, ?)";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            $userAgent,
            $dateStr
        ]);
        $uaId = $this->getPdo()->lastInsertId();
      } else {
        $sql = "UPDATE userAgents SET count=count+1, lastVisit=? WHERE userAgent=?";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            $dateStr,
            $userAgent
        ]);
        $uaId = $this->getDbId($userAgent);
      }
      $this->getPdo()->commit();
      return $uaId;
    } catch (\Exception $e) {
      $this->getPdo()->rollBack();
      throw new RuntimeException('Storing User Agent failed', 0, $e);
    }
  }

}
