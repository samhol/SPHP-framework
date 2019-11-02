<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers;

use PDO;
use PDOException;
use Sphp\Exceptions\RuntimeException;
use Sphp\Network\Utils;

/**
 * Description of DataSaver
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Data {

  const IP = 'ip';
  const USER_AGENT = 'browser';
  const FIRST_VISIT = 'firstVisit';
  const LAST_VISIT = 'lastVisit';

  /**
   * @var PDO
   */
  private $pdo;

  public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
    $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  }

  public function __destruct() {
    unset($this->pdo);
  }

  public function gettPdo(): PDO {
    return $this->pdo;
  }

  public function contains(User $user): bool {
    $stmt = $this->gettPdo()->prepare('SELECT 1 FROM visitors WHERE uid = ? LIMIT 1');
    $stmt->execute([$user->getUID()]);
    return $stmt->fetchColumn() !== false;
  }

  public function getUserData(User $user): array {
    $stmt = $this->gettPdo()->prepare('SELECT id, uid, firstVisit, lastVisit, visits, INET_NTOA(ip) as ip, browser FROM visitors WHERE uid=?');
    $stmt->execute([$user->getUID()]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result === false) {
      return [];
    }
    return $result;
  }

  public function updateUser(User $user) {
    if ($this->contains($user)) {
      $stmt = $this->gettPdo()->prepare('SELECT * FROM visitors WHERE uid=?');
      $stmt->execute([$user->getUID()]);
    }
    $stmt = $this->gettPdo()->prepare('SELECT * FROM visitors WHERE uid=?');
    $stmt->execute([$user->getUID()]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result === false) {
      return null;
    }
    return $result;
  }

  public function getUrlData(User $user = null): array {
    try {
      if ($user === null) {
        $stmt = $this->gettPdo()->prepare("SELECT DISTINCT(url), COUNT(visitorID) AS userCount, SUM(count) AS visits FROM siteVisits group by url");
        $stmt->execute();
      } else {
        $stmt = $this->gettPdo()->prepare("SELECT * FROM siteVisits WHERE uid = ?");
        $stmt->execute([$user->getUID()]);
      }
      //$result = $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      throw new RuntimeException('Refresh counting failed', 0, $e);
    }
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function insertVisitor(User $user): int {
    try {
      $stmt = $this->gettPdo()->prepare('INSERT INTO visitors (uid, firstVisit, lastVisit, ip, browser) VALUES (?, ?, ?, INET_ATON(?), ?)');
      $data = [
          $user->getUID(),
          $user->getFirstVisit()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s'),
          $user->getLastVisit()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s'),
          $user->getIp(),
          $user->getUserAgent()];
      $success = $stmt->execute($data);
      if (!$success) {
        throw new RuntimeException('Data saving faled', 0, $e);
      }
      //$id = $this->gettPdo()->lastInsertId();
      // echo $this->gettPdo()->lastInsertId();
      $id = $this->gettPdo()->lastInsertId();
      // $user->getData()->id = $id;
      // echo "New record created successfully";
      return $id;
    } catch (PDOException $e) {
      throw new RuntimeException('Data saving faled', 0, $e);
    }
    // return $success;
  }

  public function containsUrl(User $u, string $url): bool {
    $stmt = $this->gettPdo()->prepare('SELECT 1 FROM siteVisits, visitors WHERE visitors.uid = ? AND visitors.id = siteVisits.visitorID AND url = ? LIMIT 1');
    $stmt->execute([$u->getUID(), $url]);
    return $stmt->fetchColumn() !== false;
  }

  public function addRevisit(User $user) {
    try {

      //$count = $userData->visits + 1;
      $stmt = $this->gettPdo()->prepare('UPDATE visitors SET visits = visits + 1, lastVisit = ? WHERE uid = ?');
      $data = [
          $user->getLastVisit()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s'),
          $user->getUID()];
      $success = $stmt->execute($data);
      //$stmt = null;
      // echo "Site revisited successfully";
    } catch (PDOException $e) {
      throw new RuntimeException('Data saving faled', 0, $e);
    }
    return $success;
  }

  public function getDBIDFor(User $user) {
    $stmt = $this->gettPdo()->prepare('SELECT id FROM visitors WHERE uid = ?');
    $stmt->execute([$user->getUID()]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result === false) {
      return null;
    }
    return $result->id;
  }

  public function addSiteRefresh(User $user, string $site) {
    try {
      if (!$this->containsUrl($user, $site)) {
        $id = $this->getDBIDFor($user);
        $stmt = $this->gettPdo()->prepare('INSERT INTO siteVisits (visitorID, url, lastVisit) VALUES (?, ?, ?)');
        $data = [
            $id,
            $site,
            $user->getLastVisit()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s')];
        $success = $stmt->execute($data);
      } else {
        ///$this->getDBIDFor($user);
        $stmt = $this->gettPdo()->prepare('UPDATE siteVisits SET count = count + 1, lastVisit = ? WHERE visitorID = ? AND url = ?');
        $data = [
            $user->getLastVisit()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s'),
            $this->getDBIDFor($user),
            $site];
        $success = $stmt->execute($data);
      }
      //$stmt = null;
      if (!$success) {
        throw new RuntimeException('Site refresh was not saved', 0, $e);
      }
      // echo "Site clicked successfully '$count'";
    } catch (PDOException $e) {
      throw new RuntimeException('Data saving faled', 0, $e);
    }
    return $success;
  }

  public function countIps(): int {
    try {
      $stmt = $this->gettPdo()->prepare('SELECT COUNT(DISTINCT ip) as count FROM visitors');
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      throw new RuntimeException('IP counting failed', 0, $e);
    }
    return $result->count;
  }

  public function countUserAgents(): int {
    try {
      $stmt = $this->gettPdo()->prepare('SELECT COUNT(DISTINCT browser) as count FROM visitors');
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      throw new RuntimeException('IP counting failed', 0, $e);
    }
    return $result->count;
  }

  public function countUsers(): int {
    try {
      $stmt = $this->gettPdo()->prepare('SELECT COUNT(uid) as userCount FROM visitors');
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      throw new RuntimeException('User counting failed', 0, $e);
    }
    return $result->userCount;
  }

  public function countVisits(User $user = null): int {
    try {
      if ($user === null) {
        $stmt = $this->gettPdo()->prepare('SELECT SUM(visits) as visits FROM visitors');
        $stmt->execute();
      } else {
        $stmt = $this->gettPdo()->prepare('SELECT SUM(visits) as visits FROM visitors WHERE uid = ?');
        $stmt->execute([$user->getUID()]);
      }
      $result = $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      throw new RuntimeException('Visits counting failed', 0, $e);
    }
    return (int) $result->visits;
  }

  public function countRefreshes(User $user = null): int {
    try {
      if ($user === null) {
        $stmt = $this->gettPdo()->prepare('SELECT SUM(count) as refreshes FROM siteVisits');
        $stmt->execute();
      } else {
        $stmt = $this->gettPdo()->prepare('SELECT SUM(count) as refreshes FROM visitors, siteVisits WHERE visitors.uid = ? AND visitors.id = siteVisits.visitorID');
        $stmt->execute([$user->getUID()]);
      }
      $result = $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      throw new RuntimeException('Refresh counting failed', 0, $e);
    }
    return (int) $result->refreshes;
  }

  public function getUserAgents() {
    try {
      $stmt = $this->gettPdo()->prepare('SELECT SUM(visits),  ' . self::USER_AGENT . ' FROM visitors GROUP BY ' . self::USER_AGENT);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      throw new RuntimeException('Refresh counting failed', 0, $e);
    }
    return $result;
  }

}
