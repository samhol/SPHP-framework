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
class IpDataController extends AbstractDataController {

  const UID = 'uid';
  const FIRST_VISIT = 'firstVisit';
  const LAST_VISIT = 'lastVisit';
  const NUM_VISITS = 'visits';
  const IP = 'ip';

  public function contains(string $ip): bool {
    $stmt = $this->gettPdo()->prepare('SELECT 1 FROM visitors WHERE uid = ? LIMIT 1');
    $stmt->execute([$ip]);
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

  public function storeUser(User $user): int {
    try {
      if (!$this->contains($user)) {
        $stmt = $this->gettPdo()->prepare('INSERT INTO visitors (uid, firstVisit, lastVisit, ip, browser) VALUES (?, ?, ?, INET_ATON(?), ?)');
        $data = [
            $user->getUID(),
            $user->getFirstVisit()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s'),
            $user->getLastVisit()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s'),
            $user->getIp(),
            $user->getUserAgent()];
        $success = $stmt->execute($data);
      }
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

  public function storeIp(string $ip) {
    if ($visited === null) {
      $visited = new \DateTimeImmutable();
    }
    $dateStr = $visited->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s');
    try {
      //We start our transaction.
      $this->getPdo()->beginTransaction();
      if ($this->containsUserAgent($userAgent)) {
        $sql = "INSERT INTO ips (userAgent, firstVisit) VALUES (?, ?)";
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

  public function getUrlData(User $user): array {
    try {

      $stmt = $this->gettPdo()->prepare("SELECT * FROM siteVisits WHERE uid = ?");
      $stmt->execute([$user->getUID()]);
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

}
