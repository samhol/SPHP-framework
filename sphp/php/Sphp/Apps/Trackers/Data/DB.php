<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Data;

use PDO;
use PDOException;
use Sphp\Exceptions\RuntimeException;

/**
 * Description of DataSaver
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DB extends AbstractDB {

  public function getURLDataForDomainPaths(string $domain, array $paths = []): array {
    try {
      if (count($paths) > 0) {
        $qMarks = str_repeat('?,', count($paths) - 1) . '?';
        $stmt = $this->pdo()->prepare(
                "SELECT 
                DISTINCT(url), domain, COUNT(uid) AS userCount, SUM(count) AS visits 
                FROM siteVisits 
                WHERE url IN($qMarks) AND domain=?
                GROUP BY url, domain");
        $data = $paths;
        $data[] = $domain;
        $stmt->execute($data);
      } else {
        $stmt = $this->pdo()->prepare(
                "SELECT 
                DISTINCT(url), domain, COUNT(uid) AS userCount, SUM(count) AS visits 
                FROM siteVisits 
                WHERE domain=?
                GROUP BY url, domain");
        $data[] = $domain;
        $stmt->execute($data);
      }

//$result = $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      throw new RuntimeException('Refresh counting failed', 0, $e);
    }
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function contains(User $u): bool {
    $stmt = $this->pdo()->prepare('SELECT 1 FROM visitors WHERE uid = ? LIMIT 1');
    $stmt->execute([$u->getUID()]);
    return $stmt->fetchColumn() !== false;
  }

  public function getValidUrlData(string $domain = null): array {
    try {
      if ($domain !== null) {
        $stmt = $this->pdo()->prepare(
                'SELECT * FROM urls
                WHERE domain=? AND httpCode=200');
        $stmt->execute([$domain]);
      } else if ($domain === null) {
        $stmt = $this->pdo()->prepare(
                'SELECT * FROM urls
                WHERE httpCode=200');
        $stmt->execute();
      }
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $out = [];
      foreach ($result as $urldata) {
        $out[] = new URLData($urldata);
      }
      return $out;
    } catch (PDOException $e) {
      throw new RuntimeException('Fetching last visit failed', 0, $e);
    }
  }

  public function containsUrl(User $u, string $domain, string $path): bool {
    $stmt = $this->pdo()->prepare('SELECT 1 FROM siteVisits WHERE uid = ? AND domain = ? AND url = ? LIMIT 1');
    $stmt->execute([$u->getUID(), $domain, $path]);
    return $stmt->fetchColumn() !== false;
  }

  public function countUsers(string $domain = null): int {
    $sql = 'SELECT COUNT(DISTINCT(uid)) FROM userStats';
    if ($domain === null) {
      $stmt = $this->pdo()->prepare($sql);
      $stmt->execute();
    } else {
      $stmt = $this->pdo()->prepare("$sql AND domain=?");
      $stmt->execute([$domain]);
    }
    $result = $stmt->fetchColumn();
    return $result;
  }

  public function countVisits(string $domain = null): int {
    $sql = 'SELECT COUNT(uid) FROM userStats';
    if ($domain === null) {
      $stmt = $this->pdo()->prepare($sql);
      $stmt->execute();
    } else {
      $stmt = $this->pdo()->prepare("$sql AND domain=?");
      $stmt->execute([$domain]);
    }
    $result = $stmt->fetchColumn();
    return (int) $result;
  }

  public function countClicks(string $domain = null): int {
    $sql = 'SELECT SUM(clicks) FROM userStats';
    if ($domain === null) {
      $stmt = $this->pdo()->prepare($sql);
      $stmt->execute();
    } else {
      $stmt = $this->pdo()->prepare("$sql AND domain=?");
      $stmt->execute([$domain]);
    }
    $result = $stmt->fetchColumn();
    return (int) $result;
  }

  public function getFirstVisit(string $domain = null): ?\DateTime {
    $date = null;
    $sql = 'SELECT MIN(firstVisit) as firstVisit FROM visitors';
    if ($domain === null) {
      $stmt = $this->pdo()->prepare($sql);
      $stmt->execute();
    } else {
      $sql .= ' WHERE domain=?';
      $stmt = $this->pdo()->prepare($sql);
      $stmt->execute([$domain]);
    }
    $result = $stmt->fetchColumn();
    if (is_numeric($result)) {
      $date = new \DateTime('@' . $result);
      $date->setTimezone(new \DateTimeZone('Europe/Helsinki'));
    }
    return $date;
  }

  public function getLastVisit(string $domain = null, string $path = null): ?\DateTime {
    $date = null;
    try {
      if (!empty($domain) && !empty($path)) {
        $stmt = $this->pdo()->prepare(
                'SELECT MAX(lastVisit) as lastVisit FROM urls
                WHERE domain=? AND url=?');
        $stmt->execute([$domain, $path]);
      } else if (!empty($domain) && $path === null) {
        $stmt = $this->pdo()->prepare(
                'SELECT MAX(lastVisit) as lastVisit FROM urls
                WHERE domain=?');
        $stmt->execute([$domain]);
      } else if ($domain === null) {
        $stmt = $this->pdo()->prepare(
                'SELECT MAX(lastVisit) as lastVisit FROM urls');
        $stmt->execute();
      }
      $result = $stmt->fetch(PDO::FETCH_OBJ);
      if (is_numeric($result->lastVisit)) {
        $date = new \DateTime("@{$result->lastVisit}");
        $date->setTimezone(new \DateTimeZone('Europe/Helsinki'));
      }
    } catch (PDOException $e) {
      throw new RuntimeException('Fetching last visit failed', 0, $e);
    }
    return $date;
  }

  /**
   * 
   * @param  string $domain
   * @param  string $path
   * @return URLData[]
   * @throws RuntimeException
   */
  public function getUrlDataCollection(string $domain = null, string $path = null): array {
    try {
      if (!empty($domain) && !empty($path)) {
        $stmt = $this->pdo()->prepare(
                'SELECT * FROM urls
                WHERE domain=? AND path=?
                ORDER BY visits DESC');
        $stmt->execute([$domain, $path]);
      } else if (!empty($domain) && $path === null) {
        $stmt = $this->pdo()->prepare(
                'SELECT * FROM urls
                WHERE domain=? AND httpCode=200
                ORDER BY visits DESC');
        $stmt->execute([$domain]);
      } else if ($domain === null) {
        $stmt = $this->pdo()->prepare(
                'SELECT * FROM urls
                WHERE httpCode=200
                ORDER BY visits DESC');
        $stmt->execute();
      }
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $out = [];
      foreach ($result as $urldata) {
        $out[] = new URLData($urldata);
      }
      return $out;
    } catch (PDOException $e) {
      throw new RuntimeException('Fetching last visit failed', 0, $e);
    }
  }

  public function domainExists(string $domain): bool {
    $stmt = $this->pdo()->prepare('SELECT 1 FROM urls WHERE domain=?');
    $stmt->execute([$domain]);
    return $stmt->fetchColumn() !== false;
  }

  public function getDomainData(string $domain): DomainData {
    $sql = 'WITH  
             users AS 
              (SELECT COUNT(*) AS visitorCount 
                 FROM visitors INNER JOIN userAgents
                 ON userAgents.id=visitors.ua
                 WHERE crawler=false AND domain=:domain),
             code200 AS 
              (SELECT COUNT(*) > 0 AS hasValidUrls 
                 FROM urls
                 WHERE httpCode=200 AND domain=:domain)
              SELECT 
               DISTINCT(domain), 
               count(path) AS pathCount, 
               sum(visits) AS loadCount, 
               MAX(lastVisit) AS lastVisit, 
               visitorCount,
               hasValidURLs
                FROM urls, users, code200
                WHERE domain=:domain';
    $this->pdo()->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);
    $stmt = $this->pdo()->prepare($sql);
    $stmt->execute(['domain' => $domain]);
    $result = $stmt->fetchObject(DomainData::class);
    // var_dump($result);
    if ($result === false) {
      $result = null;
    }
    return $result;
  }

}
