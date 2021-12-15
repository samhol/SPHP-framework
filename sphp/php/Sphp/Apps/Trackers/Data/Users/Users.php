<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Data\Users;

use Sphp\Apps\Trackers\Data\AbstractDB;
use IteratorAggregate;
use Traversable;
use PDO;
use Sphp\DateTime\ImmutableDate;
use Sphp\Apps\Trackers\Data\DataException;

/**
 * Class Visitors
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Users extends AbstractDB implements IteratorAggregate {

  public function getIterator(): Traversable {
    $stmt = $this->pdo()->prepare('SELECT * FROM visitors');
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
    $out = new \ArrayIterator();
    foreach ($data as $ua) {
      $out[] = new User((array) $ua);
    }
    return $out;
  }

  public function contains(User $u): bool {
    return $this->containsUID($u->getUID());
  }

  public function containsUID(string $uid): bool {
    $stmt = $this->pdo()->prepare('SELECT 1 FROM visitors WHERE uid=? LIMIT 1');
    $stmt->execute([$uid]);
    return $stmt->fetchColumn() !== false;
  }

  public function getUser(string $uid): ?User {
    $query = 'SELECT visitors.*, 
               ua AS uaId, crawler AS isCrawler, browser, raw 
              FROM visitors INNER JOIN userAgents ON userAgents.id=visitors.ua 
              WHERE uid=?';
    try {
      $stmt = $this->pdo()->prepare($query);
      $stmt->execute([$uid]);
      $result = $stmt->fetchObject(User::class);

      if ($result === false) {
        $result = null;
      }
      return $result;
    } catch (PDOException $e) {
      throw new DataException('User fetching failed', 0, $e);
    }
  }

  public function getFirstDate(): ?Date {
    $query = 'SELECT MIN(date) AS y FROM userStats';
    try {
      $stmt = $this->pdo()->prepare($query);
      $stmt->execute();
      $result = $stmt->fetchColumn();
      if ($result === false) {
        $date = null;
      } else {
        $date = new ImmutableDate($result);
      }
      return $date;
    } catch (\Exception $e) {
      throw new DataException('Fetching first date failed', 0, $e);
    }
  }

  public function getYears(): array {
    $query = 'SELECT DISTINCT YEAR(date) AS year FROM userStats';
    try {
      $stmt = $this->pdo()->prepare($query);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $data = [];
      if ($result !== false) {
        foreach ($result as $row) {
          $data[] = (int) $row['year'];
        }
      }
      return $data;
    } catch (\Exception $e) {
      throw new DataException('User fetching failed', 0, $e);
    }
  }

  public function getMonths(): array {
    $query = 'SELECT DISTINCT MONTH(date) AS month FROM userStats';
    try {
      $stmt = $this->pdo()->prepare($query);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $data = [];
      if ($result !== false) {
        foreach ($result as $row) {
          $data[] = (int) $row['month'];
        }
      }
      return $data;
    } catch (\Exception $e) {
      throw new DataException('User fetching failed', 0, $e);
    }
  }

  public function getDomains(): array {
    $query = 'SELECT DISTINCT domain FROM visitors';
    try {
      $stmt = $this->pdo()->prepare($query);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $data = [];
      if ($result !== false) {
        foreach ($result as $row) {
          $data[] = $row['domain'];
        }
      }
      return $data;
    } catch (\Exception $e) {
      throw new DataException('User fetching failed', 0, $e);
    }
  }

  public function getDateTrafficData(Date $date, array $domain = []): DateData {
    $dateStr = $date->format('Y-m-d');
    if (count($domain) === 0) {
      $data = [$dateStr, $dateStr];
      $query = 'WITH A AS 
               (SELECT COUNT(*) AS visits, SUM(clicks) AS clicks FROM userStats WHERE date=?),
              B AS (SELECT COUNT(*) AS firstVisits 
              FROM visitors WHERE DATE(firstVisit)=?)
              SELECT visits, clicks, firstVisits FROM A, B';
    } else {
      $qmarks = implode(',', array_fill(0, count($domain), '?'));
      $query = "WITH A AS 
               (SELECT COUNT(*) AS visits, SUM(userStats.clicks) AS clicks 
                FROM visitors INNER JOIN userStats ON visitors.id=userStats.uid 
                WHERE date=? AND domain IN ($qmarks)),
              B AS (SELECT COUNT(*) AS firstVisits 
               FROM visitors WHERE DATE(firstVisit)=? AND domain IN ($qmarks))
              SELECT visits, clicks, firstVisits FROM A, B";
      //$data = [$dateStr, $domain, $dateStr];
      $data = array_merge([$dateStr], $domain, [$dateStr], $domain);
      //var_dump($query,$data);
      // $data = array_merge($data, $domain);
    }
    $stmt = $this->pdo()->prepare($query);
    $stmt->execute($data);
    $result = $stmt->fetchObject(DateData::class);
    if ($result === false) {
      $result = new DateData();
    }
    $result->setDate($date);
    return $result;
  }

  /**
   * 
   * @param  User $user
   * @return bool
   * @throws DataException if the process failed
   */
  public function store(User $user): bool {
    if ($this->contains($user)) {
      $result = $this->update($user);
    } else {
      $result = $this->insert($user);
    }
    return $result;
  }

  /**
   * 
   * @param  User $user
   * @return bool
   * @throws DataException
   */
  protected function insert(User $user): bool {
    $pdo = $this->pdo();
    $query = 'INSERT INTO visitors (uid, domain, firstVisit, lastVisit, ip, ua) 
               VALUES (?, ?, NOW(), NOW(), ?, ?)';
    try {
      $pdo->beginTransaction();
      $stmt = $pdo->prepare($query);
      $data = [
          $user->getUID(),
          $user->getDomain(),
          $user->getIp(),
          $user->getUserAgent()->getDbId()];
      $result = $stmt->execute($data);
      $user->setId((int) $pdo->lastInsertId());
      $pdo->commit();
    } catch (\Exception $e) {
      if ($pdo->inTransaction()) {
        $pdo->rollback();
      }
      throw new DataException('User insertion failed', 0, $e);
    }
    return $result;
  }

  /**
   * 
   * @param  User $user
   * @return bool
   * @throws DataException
   */
  protected function update(User $user): bool {
    $pdo = $this->pdo();
    $query = 'UPDATE visitors SET lastVisit=NOW(), clicks=?, visits=?, ip=?, ua=? WHERE uid=?';
    try {
      $pdo->beginTransaction();
      $stmt = $pdo->prepare($query);
      $data = [
          $user->getClicks(),
          $user->getVisits(),
          $user->getIp(),
          $user->getUserAgent()->getDbId(),
          $user->getUID()];
      $result = $stmt->execute($data);
      $pdo->commit();
    } catch (\Exception $e) {
      if ($pdo->inTransaction()) {
        $pdo->rollback();
      }
      throw new DataException('User update failed', 0, $e);
    }
    return $result;
  }

  /**
   * 
   * @param  User $user
   * @param  Date|null $date
   * @return bool
   * @throws DataException if the process failed
   */
  public function storeDate(User $user, Date $date = null): bool {
    if ($date === null) {
      $date = new ImmutableDate();
    }
    if ($this->containsDate($user, $date)) {
      //echo "dd";
      $result = $this->updateDate($user, $date);
    } else {
      $result = $this->insertDate($user, $date);
    }
    return $result;
  }

  public function containsDate(User $u, Date $date = null): bool {
    if ($date === null) {
      $date = new ImmutableDate();
    }
    $query = 'SELECT 1 FROM userStats WHERE uid=? AND date=? LIMIT 1';
    $stmt = $this->pdo()->prepare($query);
    $stmt->execute([$u->getId(), $date->format('Y-m-d')]);
    return $stmt->fetchColumn() !== false;
  }

  /**
   * 
   * @param  User $user
   * @return bool
   * @throws DataException
   */
  protected function insertDate(User $user, Date $date): bool {
    $pdo = $this->pdo();
    $query = 'INSERT INTO userStats (uid, date, clicks) VALUES (?, ?, ?)';
    //print_r($user);
    try {
      $pdo->beginTransaction();
      $stmt = $pdo->prepare($query);
      $data = [$user->getId(), $date->format('Y-m-d'), 1];
      $result = $stmt->execute($data);
      $pdo->commit();
      $user->setId((int) $pdo->lastInsertId());
    } catch (\Exception $e) {
      if ($pdo->inTransaction()) {
        $pdo->rollback();
      }
      throw new DataException('Date stats insertion for a User failed', 0, $e);
    }
    return $result;
  }

  /**
   * 
   * @param  User $user
   * @return bool
   * @throws DataException
   */
  protected function updateDate(User $user, Date $date): bool {
    $pdo = $this->pdo();
    $query = 'UPDATE userStats SET clicks=clicks+1 WHERE uid=? AND date=?';
    try {
      $pdo->beginTransaction();
      $stmt = $pdo->prepare($query);
      $data = [
          $user->getId(),
          $date->format('Y-m-d')];
      $result = $stmt->execute($data);
      $pdo->commit();
    } catch (\Exception $e) {
      if ($pdo->inTransaction()) {
        $pdo->rollback();
      }
      throw new DataException('Date stats update for a User failed', 0, $e);
    }
    return $result;
  }

  /**
   * 
   * @return int number of removed crawlers
   * @throws DataException
   */
  public function removeCrawlersFromUsers(): int {
    $pdo = $this->pdo();
    $botQuery = 'DELETE visitors FROM visitors LEFT JOIN userAgents 
                      ON visitors.ua=userAgents.id WHERE userAgents.crawler=true';
    try {
      $pdo->beginTransaction();
      $stmt1 = $pdo->prepare($botQuery);
      $stmt1->execute();
      $count = $stmt1->rowCount();
      $pdo->commit();
    } catch (\Exception $e) {
      if ($pdo->inTransaction()) {
        $pdo->rollback();
      }
      throw new DataException('Bot removal failed failed', 0, $e);
    }
    return $count;
  }

}
