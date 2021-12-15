<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Data\UserAgents;

use Sphp\Apps\Trackers\Data\AbstractDB;
use PDO;
use Sphp\Apps\Trackers\Data\UserAgents\ManufacturerShareData;
use Sphp\Apps\Trackers\Data\UserAgents\UserAgentModel;
use Sphp\Apps\Trackers\Data\UserAgents\UserAgentVersion;
use Sphp\Apps\Trackers\Data\DataException;

/**
 * Class Browsers
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class UserAgents extends AbstractDB implements \IteratorAggregate {

  public const DBID_FIELD = 'id';
  public const CRAWLER_FIELD = 'crawler';
  public const NAME_FIELD = 'browser';
  public const MAKER_FIELD = 'browser_maker';
  public const VERSION_FIELD = 'version';
  public const MINOR_VERSION_FIELD = 'minorver';
  public const MAJOR_VERSION_FIELD = 'majorver';
  public const RAW_FIELD = 'raw';

  public function isCrawler(string $raw): bool {
    $stmt = $this->pdo()->prepare(
            'SELECT crawler
              FROM userAgents
              WHERE raw=?');
    $stmt->execute([$raw]);
    $rawData = $stmt->fetchColumn();
    return (bool) $rawData;
  }

  public function getBrowsers(): array {
    $stmt = $this->pdo()->prepare(
            'SELECT crawler, browser_maker, browser, version, userAgentsStats.count, raw
              FROM userAgents INNER JOIN userAgentsStats
              ON userAgents.id=userAgentsStats.userAgent
              WHERE userAgents.crawler = false AND userAgents.browser <> "Default Browser"
              ORDER BY count DESC, raw DESC');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_CLASS, UserAgent::class);
    if ($result === false) {
      $result = [];
    }
    return $result;
  }

  /**
   * 
   * @return array
   */
  public function countBrowserVisits(): int {
    $stmt = $this->pdo()->prepare(
            'SELECT SUM(count) as total
              FROM userAgents
              WHERE crawler = false AND browser <> "Default Browser"');
    $stmt->execute();
    $rawData = $stmt->fetchColumn();
    return (int) $rawData;
  }

  /**
   * 
   * @param  string $name
   * @param  bool $isCrawler
   * @return UserAgentVersion[]
   */
  public function getUserAgentVersionsMarketShare(string $name, bool $isCrawler = true): array {
    $stmt = $this->pdo()->prepare(
            'WITH 
              total AS 
               (SELECT SUM(userAgentStats.count) AS total 
                 FROM userAgents INNER JOIN userAgentStats
                 ON userAgents.id=userAgentStats.userAgent
                 WHERE crawler=? AND browser=?),
              data AS 
               (SELECT 
                  browser_maker AS manufacturer, 
                  browser AS name, 
                  majorver AS version,
                  SUM(count) as part, 
                  crawler AS isCrawler
                 FROM userAgents INNER JOIN userAgentStats
                  ON userAgents.id=userAgentStats.userAgent
                 WHERE crawler=? AND browser=?
                 GROUP BY majorver)
            SELECT manufacturer, name, version, isCrawler, (part/total)*100 AS share
             FROM data, total
             ORDER BY share DESC');
    $stmt->execute([$isCrawler, $name, $isCrawler, $name]);
    $rawData = $stmt->fetchAll(PDO::FETCH_CLASS, UserAgentVersion::class);
    return $rawData;
  }

  /**
   * 
   * @param  bool $isCrawler
   * @return array
   */
  public function getUserAgentByName(bool $isCrawler = true): array {
    $stmt = $this->pdo()->prepare(
            'WITH 
              total AS 
               (SELECT SUM(userAgentStats.count) AS total 
                 FROM userAgents INNER JOIN userAgentStats
                 ON userAgents.id=userAgentStats.userAgent
                 WHERE crawler = ? AND browser <> "Default Browser"),
              data AS 
               (SELECT 
                  browser AS name, 
                  browser_maker AS manufacturer, 
                  SUM(userAgentStats.count) as part, 
                  COUNT(DISTINCT(version)) AS versions,
                  crawler AS isCrawler
                 FROM userAgents INNER JOIN userAgentStats
                  ON userAgents.id=userAgentStats.userAgent
                 WHERE crawler=? AND browser <> "Default Browser"
                 GROUP BY browser)
            SELECT 
              name, 
              manufacturer, 
              isCrawler, 
              (data.part/total.total)*100 AS share, 
              data.versions AS versionCount
             FROM data, total
             ORDER BY share DESC');
    $stmt->execute([$isCrawler, $isCrawler]);
    $rawData = $stmt->fetchAll(PDO::FETCH_CLASS, UserAgentModel::class);
    return $rawData;
  }

  /**
   * 
   * @return ManufacturerShareData[]
   */
  public function getManufacturersMarketShare(int $type = null): array {
    $stmt = $this->pdo()->prepare(
            'WITH 
              total AS (SELECT SUM(count) AS total 
                 FROM userAgentStats),
              data AS (SELECT 
                  browser_maker AS manufacturer, 
                  SUM(count) AS part,
                  COUNT(DISTINCT(browser)) AS versions
                 FROM userAgents LEFT JOIN userAgentStats 
                  ON userAgents.id = userAgentStats.userAgent  
                 GROUP BY browser_maker)
            SELECT 
              manufacturer,
              data.versions AS versionCount,
              (data.part/total.total)*100 AS share
             FROM data, total ORDER BY share DESC');
    $stmt->execute();
    $rawData = $stmt->fetchAll(PDO::FETCH_CLASS, ManufacturerShareData::class);
    return $rawData;
  }

  /**
   * 
   * @param  string $maker
   * @return UserAgentModel[]
   */
  public function getUserAgentByMaker(string $maker): array {
    $stmt = $this->pdo()->prepare(
            'WITH 
              total AS 
               (SELECT SUM(count) AS total 
                FROM userAgents LEFT JOIN userAgentStats 
                 ON userAgents.id = userAgentStats.userAgent
                WHERE browser_maker=?),
              data AS 
               (SELECT 
                  browser AS name, 
                  browser_maker AS manufacturer, 
                  SUM(count) as part, 
                  COUNT(DISTINCT(version)) AS versions,
                  crawler AS isCrawler
                 FROM userAgents LEFT JOIN userAgentStats 
                  ON userAgents.id = userAgentStats.userAgent  
                  WHERE browser_maker=?
                 GROUP BY browser)
            SELECT 
              manufacturer,
              name, 
              isCrawler, 
              (data.part/total.total)*100 AS share, 
              data.versions AS versionCount
             FROM data, total
             ORDER BY isCrawler, share DESC');
    $stmt->execute([$maker, $maker]);
    $rawData = $stmt->fetchAll(PDO::FETCH_CLASS, UserAgentModel::class);
    return $rawData;
  }

  /**
   * 
   * @return UserAgent[]
   */
  public function getUserAgents(): array {
    $stmt = $this->pdo()->prepare(
            'SELECT crawler, browser_maker, browser, version, count, raw
              FROM userAgents
              ORDER BY count DESC, raw DESC');
    $stmt->execute();
    $rawData = $stmt->fetchAll(PDO::FETCH_OBJ);
    $browsers = [];
    foreach ($rawData as $browserData) {
      $browsers[] = UserAgent::fromData($browserData);
    }
    return $browsers;
  }

  private function getDbInstance(string $ua): ?UserAgent {
    $stmt = $this->pdo()->prepare(
            'SELECT 
               id, 
               crawler, 
               browser_maker AS maker, 
               browser AS name, 
               version,
               majorVer AS majorVersion,
               minorVer AS minorVersion,
               raw
              FROM userAgents WHERE raw=?');
    $stmt->execute([$ua]);
    $data = $stmt->fetchObject(UserAgent::class);
    if ($data === false) {
      $data = null;
    }
    return $data;
  }

  public function contains(UserAgent $ua): bool {
    return $this->containsUserAgentString($ua->getRaw());
  }

  public function containsUserAgentString(string $ua): bool {
    $stmt = $this->pdo()->prepare('SELECT 1 FROM userAgents WHERE raw=?');
    $stmt->execute([$ua]);
    return $stmt->fetchColumn() !== false;
  }

  public function recheckDatabase(): int {
    $upStmt = $this->pdo()->prepare(
            'UPDATE userAgents SET 
                crawler=:crawler, 
                browser=:name, 
                browser_maker=:maker, 
                version=:version, 
                minorver=:minorVersion, 
                majorver=:majorVersion,
                raw=:raw,
                isMobileDevice=:isMobileDevice
              WHERE id=:id'
    );
    $out = 0;
    $selection = $this->pdo()->prepare('SELECT id, raw FROM userAgents');
    $selection->execute();
    $oldData = $selection->fetchAll(PDO::FETCH_ASSOC);
    foreach ($oldData as $ua) {
      $d = UserAgentParser::instance()->fromRawString($ua['raw']);
      $data = [];
      $data['crawler'] = $d->isCrawler();
      $data['name'] = $d->getName();
      $data['maker'] = $d->getMaker();
      $data['version'] = $d->getVersion();
      $data['minorVersion'] = $d->getMinorVersion();
      $data['majorVersion'] = $d->getMajorVersion();
      $data['raw'] = $d->getRaw();
      $data['isMobileDevice'] = $d->isMobileDevice();
      $data['id'] = $ua['id'];
      $ok = $upStmt->execute($data);
      // $upStmt->rowCount();
      $out += $upStmt->rowCount();
    }
    return $out;
  }

  public function updateUserAgentData(string $ua): UserAgent {
    if (!$this->containsUserAgentString($ua)) {
      $this->insertNew(UserAgentParser::instance()->fromRawString($ua), 1);
    } else {
      $this->pdo()->beginTransaction();
      //echo "\n\tbaaaarrrrr\n";
      $stmt = $this->pdo()->prepare(
              'UPDATE userAgents
                  SET count=count+1
                  WHERE raw=?');
      $data = [$ua];
      $success = $stmt->execute($data);
      $this->pdo()->commit();
    }
    return $this->getUserAgent($ua);
  }

  public function getUserAgent(string $ua): UserAgent {
    if (!$this->containsUserAgentString($ua)) {
      $uaObj = UserAgentParser::instance()->fromRawString($ua);
      $this->insertNew($uaObj);
    } else {
      $uaObj = $this->getDbInstance($ua);
    }
    return $uaObj;
  }

  /**
   * 
   * @param  UserAgent $uaObj
   * @param  int $visits
   * @return bool
   * @throws DataException
   */
  private function insertNew(UserAgent $uaObj, int $visits = 0): bool {
    $pdo = $this->pdo();
    try {
      $uaQuery = 'INSERT INTO userAgents (raw, crawler, browser, version, browser_maker, majorver) 
                  VALUES (?, ?, ?, ?, ?, ?)';
      $pdo->beginTransaction();
      $stmt1 = $this->pdo()->prepare($uaQuery);
      $data = [
          $uaObj->getRaw(),
          $uaObj->isCrawler(),
          $uaObj->getName(),
          $uaObj->getVersion(),
          $uaObj->getMaker(),
          $uaObj->getMajorVersion(),];
      $result = $stmt1->execute($data); 
      $pdo->commit();
    } catch (\Exception $e) {
      if ($pdo->inTransaction()) {
        $pdo->rollback();
      }
      throw new DataException('User Agent insertion failed', 0, $e);
    }
    return $result;
  }

  public function getIterator(): \Traversable {
    $stmt = $this->pdo()->prepare(
            'SELECT 
               id, 
               crawler, 
               browser_maker AS maker, 
               browser AS name, 
               majorVer AS majorVersion,
               minorVer AS minorVersion,
               count
              FROM userAgents');
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
    $out = new \ArrayIterator();
    foreach ($data as $ua) {
      $out[] = new UserAgent((array)$ua);
    }
    return $out;
  }

  public function getTypeSplitData() {
    $stmt = $this->pdo()->prepare('
     SELECT (bCount/total) AS browserShare, (1 - bCount/total) AS crawlerShare
     FROM 
       (SELECT SUM(count) AS total FROM userAgents) AS t1,
	   (SELECT SUM(count) AS bCount 
                 FROM userAgents WHERE crawler=false) AS t2');
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_OBJ);
    if ($data === false) {
      $data = null;
    }
    return $data;
  }

  public const BROWSER = 0;
  public const CRAWLER = 1;

  public function countShare(int $type = self::BROWSER): float {
    $crawler = (bool) $type;
    $stmt = $this->pdo()->prepare(
            'WITH 
              total AS (SELECT SUM(userAgentStats.count) AS total 
                 FROM userAgents INNER JOIN userAgentStats
                 ON userAgents.id=userAgentStats.userAgent),
              ua AS (SELECT SUM(userAgentStats.count) AS uaCount 
                 FROM userAgents INNER JOIN userAgentStats
                  ON userAgents.id=userAgentStats.userAgent
                 WHERE crawler=?)
            SELECT (uaCount/total) AS share
             FROM ua, total');
    $stmt->execute([$crawler]);
    $count = $stmt->fetchColumn();
    if ($count === false) {
      $result = null;
    } else {
      $result = (float) $count;
    }
    return $result;
  }

  public function getUserAgentShareData(string $ua): UserAgentShareData {
    $stmt = $this->pdo()->prepare(
            'WITH total AS (SELECT SUM(userAgentStats.count) AS total 
                 FROM userAgents INNER JOIN userAgentStats
                 ON userAgents.id=userAgentStats.userAgent)
              SELECT 
               raw, count/total AS share
              FROM total, userAgents INNER JOIN userAgentStats ON userAgents.id=userAgentStats.userAgent
              WHERE userAgents.raw=?');
    $stmt->execute([$ua]);
    $data = $stmt->fetchObject(UserAgentShareData::class);
    if ($data === false) {
      $data = new UserAgentShareData();
    }
    return $data;
  }

  public function countBrowserShare(): float {
    return $this->countShare(self::BROWSER);
  }

  public function countCrawlerShare(): float {
    return 1 - $this->countShare(self::BROWSER);
  }

}
