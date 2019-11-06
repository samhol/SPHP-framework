<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Apps\Trackers;

use PDO;
use PDOException;
use Sphp\Exceptions\RuntimeException;

/**
 * Description of UserData
 *
 * @author samih
 */
class UserData {

  const UID = 'uid';
  const FIRST_VISIT = 'firstVisit';
  const LAST_VISIT = 'lastVisit';
  const NUM_VISITS = 'visits';
  const IP = 'ip';
  const USER_AGENT = 'browser';

  /**
   * @var PDO
   */
  private $pdo;

  /**
   * @var User 
   */
  private $user;
  private $dbid;
  private $userAgents;

  public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
    // $this->getDBID();
    $this->userAgents = new UserAgentDataController($pdo);
  }

  public function __destruct() {
    unset($this->pdo);
  }

  public function gettPdo(): PDO {
    $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
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

  public function storeUser(User $user): bool {
    try {
      $browserId = $this->userAgents->storeUserAgent($user->getUserAgent());
      if (!$this->contains($user)) {
        $stmt = $this->gettPdo()->prepare('INSERT INTO visitors (uid, firstVisit, lastVisit, ip, uaid) VALUES (?, ?, ?, INET_ATON(?), ?)');
        $data = [
            $user->getUID(),
            $user->getFirstVisit()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s'),
            $user->getLastVisit()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s'),
            $user->getIp(),
            $browserId];
        $success = $stmt->execute($data);
        //$dbId = $this->gettPdo()->lastInsertId();
        $user->setDbId($this->gettPdo()->lastInsertId());
        $this->storeUsersIp($user);
      } else {
        $success = $this->addRevisit($user);
      }
      if (!$success) {
        throw new RuntimeException('User Data saving faled', 0, $e);
      }
    } catch (PDOException $e) {
      throw new RuntimeException('Data saving faled', 0, $e);
    }
    return $success;
  }

  public function storeUsersIp(User $user) {
    try {
      if (!$this->getDBIDFor($user)) {
        throw new RuntimeException('User not stored---ip saving faled');
      }
      //We start our transaction.
      $this->gettPdo()->beginTransaction();

      $containsStmt = $this->gettPdo()->prepare(
              'SELECT 1 FROM ips WHERE visitorId = ? AND ip = INET_ATON(?) LIMIT 1');
      $containsStmt->execute([
          $user->getDbId(),
          $user->getIp()]);
      //var_dump($containsStmt->fetchColumn());
      if ($containsStmt->fetchColumn() === false) {
        $sql = "INSERT INTO ips (visitorId, ip) VALUES (?, INET_ATON(?))";
        $stmt = $this->gettPdo()->prepare($sql);
        $stmt->execute([
            $user->getDbId(),
            $user->getIp(),
        ]);
      } else {
        $sql = "UPDATE ips SET lastVisit=?, count=count+1 WHERE visitorId=? AND ip=INET_ATON(?)";
        $stmt = $this->gettPdo()->prepare($sql);
        $stmt->execute([
            $user->getLastVisit()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s'),
            $user->getDbId(),
            $user->getIp(),
        ]);
      }

      //Query 1: Attempt to insert the payment record into our database.
      //Query 2: Attempt to update the user's profile.
      //We've got this far without an exception, so commit the changes.
      return $this->gettPdo()->commit();
    }
//Our catch block will handle any exceptions that are thrown.
    catch (Exception $e) {
      //An exception has occured, which means that one of our database queries
      //failed.
      //Print out the error message.
      echo $e->getMessage();
      //Rollback the transaction.
      $this->gettPdo()->rollBack();
    }
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

  public function addRevisit(User $user): bool {
    try {

      //$count = $userData->visits + 1;
      $stmt = $this->gettPdo()->prepare('UPDATE visitors SET visits = visits + 1, lastVisit = ? WHERE uid = ?');
      $data = [
          $user->getLastVisit()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s'),
          $user->getUID()];
      $success = $stmt->execute($data);

      $this->storeUsersIp($user);
      //$stmt = null;
      // echo "Site revisited successfully";
    } catch (PDOException $e) {
      throw new RuntimeException('Data saving faled', 0, $e);
    }
    return $success;
  }

  public function getDBIDFor(User $user): bool {
    $result = true;
    if ($user->getDbId() === null) {
      $stmt = $this->gettPdo()->prepare('SELECT id FROM visitors WHERE uid = ?');
      $stmt->execute([$user->getUID()]);
      $result = $stmt->fetch(PDO::FETCH_OBJ);
      $user->setDbId($result->id);
    }
    return $result !== false;
  }

  public function addSiteRefresh(User $user, string $site, int $status = null) {
    try {
      $this->getDBIDFor($user);
      if (!$this->containsUrl($user, $site)) {
        $stmt = $this->gettPdo()->prepare('INSERT INTO siteVisits (visitorID, url, statusCode, lastVisit) VALUES (?,?, ?, ?)');
        $data = [
            $user->getDbId(),
            $site,
            $status, 
            $user->getLastVisit()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s')];
        $success = $stmt->execute($data);
      } else {
        ///$this->getDBIDFor($user);
        $stmt = $this->gettPdo()->prepare('UPDATE siteVisits SET count = count + 1, statusCode=?, lastVisit = ? WHERE visitorID = ? AND url = ?');
        $data = [
            $status, 
            $user->getLastVisit()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s'),
            $user->getDbId(),
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

  public function count(string $field): int {
    try {
      if ($field === self::IP || $field === self::USER_AGENT) {
        $rawQueryString = 'SELECT COUNT(DISTINCT %s) as count FROM visitors WHERE uid = ?';
      } else if ($field === self::UID) {
        $rawQueryString = 'SELECT COUNT(%s) as count FROM visitors uid = ?';
      } else if ($field === self::NUM_VISITS) {
        $rawQueryString = 'SELECT SUM(%s) as count FROM visitors uid = ?';
      }
      $queryString = vsprintf($rawQueryString, [$field]);
      $stmt = $this->gettPdo()->prepare($queryString);
      $stmt->execute([$this->user->getUID()]);
      $result = $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      throw new RuntimeException($field . ' counting failed', 0, $e);
    }
    return $result->count;
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

}
