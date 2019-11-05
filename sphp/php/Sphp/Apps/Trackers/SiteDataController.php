<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Apps\Trackers;

use PDO;
use Sphp\Exceptions\InvalidArgumentException;
/**
 * Description of SiteDataController
 *
 * @author samih
 */
class SiteDataController extends AbstractDataController {

  /**
   * 
   * @param  User $user
   * @param  string $url
   * @return bool
   * @throws InvalidArgumentException
   * @throws RuntimeException
   */
  public function addRefresh(User $user, string $url):bool {
    if ($user->getDbId() === null) {
      throw new InvalidArgumentException('Site refresh cannot be saved: User is not stored', 0, $e);
    }
    try {
      $this->getDBIDFor($user);
      if (!$this->containsUrl($user, $url)) {
        $stmt = $this->gettPdo()->prepare('INSERT INTO siteVisits (visitorID, url, lastVisit) VALUES (?, ?, ?)');
        $data = [
            $user->getDbId(),
            $url,
            $user->getLastVisit()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s')];
        $success = $stmt->execute($data);
      } else {
        ///$this->getDBIDFor($user);
        $stmt = $this->gettPdo()->prepare('UPDATE siteVisits SET count = count + 1, lastVisit = ? WHERE visitorID = ? AND url = ?');
        $data = [
            $user->getLastVisit()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s'),
            $user->getDbId(),
            $url];
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

  /**
   * Counts statistics data values
   * 
   * @param  string $field
   * @return int
   * @throws RuntimeException
   * @throws InvalidArgumentException
   */
  public function count(string $field = self::NUM_VISITS): int {
    try {
      if ($field === self::IP || $field === self::USER_AGENT) {
        $rawQueryString = 'SELECT COUNT(DISTINCT %s) as count FROM visitors';
      } else if ($field === self::UID) {
        $rawQueryString = 'SELECT COUNT(%s) as count FROM visitors';
      } else if ($field === self::NUM_VISITS) {
        $rawQueryString = 'SELECT SUM(%s) as count FROM visitors';
      } else if ($field === self::CLICKS) {
        $rawQueryString = 'SELECT SUM(%s) as count FROM siteVisits';
      } else {
        $message = vsprintf('Cannot count using parameter value (%s)', [$field]);
        throw new InvalidArgumentException($message, 0, $e);
      }
      $queryString = vsprintf($rawQueryString, [$field]);
      $stmt = $this->gettPdo()->prepare($queryString);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      $message = vsprintf('Cannot count using parameter value (%s)', [$field]);
      throw new RuntimeException($message, 0, $e);
    }
    if ($result->count === null) {
      $result->count = 0;
    }
    return $result->count;
  }

  public function getStatisticsFor(): array {
    try {
      $rawQueryString = 'SELECT url, SUM(count) as totalVisits, count(visitorID) as userCount FROM siteVisits GROUP BY url';
      // $queryString = vsprintf($rawQueryString, [$dataField, $dataField]);
      $stmt = $this->getPdo()->prepare($rawQueryString);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      throw new RuntimeException('Statistics could not be fetched', 0, $e);
    }
    return $result;
  }

}
