<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers;

/**
 * Description of UserAgentDataController
 *
 * @author samih
 */
class UserAgentDataController extends AbstractDataController {

  public function containsUserAgent(string $userAgent): bool {
    $stmt = $this->gettPdo()->prepare('SELECT 1 AS num FROM userAgents WHERE userAgent = ? LIMIT 1');
    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
   // var_dump($row);
    return $row !== false;
  }
  public function getDbId(string $userAgent): ?int {
    $stmt = $this->gettPdo()->prepare('SELECT id FROM userAgents WHERE userAgent = ?');
     $stmt->execute([$userAgent]);
     $row = $stmt->fetch(\PDO::FETCH_ASSOC);
     return $row['id'];
  }

  public function storeUserAgent(string $userAgent, \DateTimeImmutable $visited = null):int {
    if ($visited === null) {
      $visited = new \DateTimeImmutable();
    }
    $dateStr = $visited->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s');
    try {
      //We start our transaction.
      $this->gettPdo()->beginTransaction();
      if ($this->containsUserAgent($userAgent)) {
        $sql = "INSERT INTO userAgents (userAgent, firstVisit) VALUES (?, ?)";
        $stmt = $this->gettPdo()->prepare($sql);
        $stmt->execute([
            $userAgent,
            $dateStr
        ]);
        $uaId = $this->getPdo()->lastInsertId();
      } else {
        $sql = "UPDATE userAgents SET count=count+1, lastVisit = ? WHERE userAgent = ?";
        $stmt = $this->gettPdo()->prepare($sql);
        $stmt->execute([ 
            $dateStr,
            $userAgent
        ]);
        $uaId = $this->getDbId($userAgent);
      }

      $this->gettPdo()->commit();
      return $uaId;
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

}
