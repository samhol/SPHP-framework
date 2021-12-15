<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Data\URLs;

use Sphp\Apps\Trackers\Data\AbstractDB;
use PDO;

/**
 * Description of DataSaver
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DomainDb extends AbstractDB implements \IteratorAggregate, \Countable {

  public function getDomainNames(): array {
    $stmt = $this->pdo()->prepare('SELECT DISTINCT(domain) FROM urls');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_COLUMN, 'domain');
    $out = $result;

    return $out;
  }

  public function getValidUrlData(string $domain = null): array {
    try {
      if ($domain !== null) {
        $stmt = $this->pdo()->prepare('SELECT * FROM urls WHERE domain=? AND httpCode=200');
        $stmt->execute([$domain]);
      } else if ($domain === null) {
        $stmt = $this->pdo()->prepare('SELECT * FROM urls WHERE httpCode=200');
        $stmt->execute();
      }
      $result = $stmt->fetchAll(PDO::FETCH_CLASS, URLData::class);
      if ($result === false) {
        $result = [];
      }
      return $result;
    } catch (\Exception $e) {
      throw new DataException('Fetching last visit failed', 0, $e);
    }
  }

  public function countUsers(string $domain = null): int {
    try {
      if ($domain === null) {
        $stmt = $this->pdo()->prepare(
                'SELECT COUNT(uid) as userCount 
                  FROM visitors INNER JOIN userAgents
                  ON userAgents.id=visitors.ua
                  WHERE crawler=false');
        $stmt->execute();
      } else {
        $stmt = $this->pdo()->prepare(
                'SELECT COUNT(uid) as userCount 
                  FROM visitors INNER JOIN userAgents
                  ON userAgents.id=visitors.ua
                  WHERE crawler=false AND domain=?');
        $stmt->execute([$domain]);
      }
      $result = $stmt->fetch(PDO::FETCH_OBJ);
    } catch (\Exception $e) {
      throw new DataException('User counting failed', 0, $e);
    }
    return $result->userCount;
  }

  public function countSiteVisits(string $domain = null): int {
    try {
      if ($domain === null) {
        $stmt = $this->pdo()->prepare(
                'SELECT SUM(clicks) as visits 
                  FROM visitors INNER JOIN userAgents
                  ON userAgents.id=visitors.ua
                  WHERE crawler=false');
        $stmt->execute();
      } else {
        $stmt = $this->pdo()->prepare(
                'SELECT sum(clicks) as visits
                  FROM visitors INNER JOIN userAgents
                  ON userAgents.id=visitors.ua
                  WHERE crawler=false AND domain=?');
        $stmt->execute([$domain]);
      }
      $result = $stmt->fetch(PDO::FETCH_OBJ);
    } catch (\Exception $e) {
      throw new DataException('Visits counting failed', 0, $e);
    }
    return (int) $result->visits;
  }

  public function getLastVisit(string $domain = null, string $path = null): ?\DateTime {
    $date = null;
    try {
      if (!empty($domain) && !empty($path)) {
        $stmt = $this->pdo()->prepare('SELECT MAX(lastVisit) as lastVisit FROM urls WHERE domain=? AND url=?');
        $stmt->execute([$domain, $path]);
      } else if (!empty($domain) && $path === null) {
        $stmt = $this->pdo()->prepare('SELECT MAX(lastVisit) as lastVisit FROM urls WHERE domain=?');
        $stmt->execute([$domain]);
      } else if ($domain === null) {
        $stmt = $this->pdo()->prepare('SELECT MAX(lastVisit) as lastVisit FROM urls');
        $stmt->execute();
      }
      $result = $stmt->fetch(PDO::FETCH_OBJ);
      if (is_numeric($result->lastVisit)) {
        $date = new \DateTime("@{$result->lastVisit}");
        $date->setTimezone(new \DateTimeZone('Europe/Helsinki'));
      }
    } catch (\Exception $e) {
      throw new DataException('Fetching last visit failed', 0, $e);
    }
    return $date;
  }

  public function domainExists(string $domain): bool {
    $stmt = $this->pdo()->prepare('SELECT 1 FROM urls WHERE domain=?');
    $stmt->execute([$domain]);
    return $stmt->fetchColumn() !== false;
  }

  public function getTotalStatistics(): TotalStatistics {
    $sql = 'WITH a AS (SELECT 
             SUM(userStats.clicks) AS clickCount, 
             COUNT(DISTINCT(userStats.uid)) AS userCount,
             COUNT(userStats.id) AS visitCount,
             MAX(lastVisit) AS lastVisit, 
             MIN(firstVisit) AS firstVisit
            FROM visitors INNER JOIN userStats
             ON visitors.id=userStats.uid),
            b AS (SELECT 
             COUNT(path) AS pathCount, 
             COUNT(DISTINCT(domain)) AS domainCount
            FROM urls)
            SELECT * FROM a,b';
    $stmt = $this->pdo()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchObject(TotalStatistics::class);
    if ($result === false) {
      $result = new TotalStatistics();
    }
    return $result;
  }

  public function getDomainData(string $domain): DomainStatistics {
    $sql = 'WITH a AS (SELECT 
             SUM(userStats.clicks) AS totalClickCount, 
             COUNT(DISTINCT(userStats.uid)) AS totalUserCount, 
             COUNT(userStats.id) AS totalVisitCount
            FROM visitors INNER JOIN userStats ON visitors.id=userStats.uid),
            users AS (SELECT 
             domain, 
             SUM(userStats.clicks) AS clickCount, 
             COUNT(DISTINCT(userStats.uid)) AS userCount, 
             COUNT(userStats.id) AS visitCount,
             MAX(lastVisit) AS lastVisit, 
             MIN(firstVisit) AS firstVisit
            FROM visitors INNER JOIN userStats ON visitors.id=userStats.uid 
            WHERE domain=:domain)
            SELECT 
             DISTINCT(urls.domain), 
             users.firstVisit,
             users.lastVisit, 
             count(path) AS pathCount, 
             clickCount, 
             (clickCount/totalClickCount) AS clickShare,
             visitCount, 
             (visitCount/totalVisitCount) AS visitShare,
             userCount,
             (userCount/totalUserCount) AS userShare
            FROM a, urls, users WHERE urls.domain=:domain';
    $this->pdo()->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);
    $stmt = $this->pdo()->prepare($sql);
    $stmt->execute(['domain' => $domain]);
    $result = $stmt->fetchObject(DomainStatistics::class);
    if ($result === false) {
      $result = null;
    }
    return $result;
  }

  public function getIterator(): \Traversable {
    $it = new \ArrayIterator();
    foreach ($this->getDomainNames() as $domainName) {
      $it->append($this->getDomainData($domainName));
    }
    return $it;
  }

  public function count(): int {
    $stmt = $this->pdo()->prepare('SELECT COUNT(DISTINCT(domain)) FROM urls');
    $stmt->execute();
    $out = (int) $stmt->fetchColumn();

    return $out;
  }

}
