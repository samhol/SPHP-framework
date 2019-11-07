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

}
