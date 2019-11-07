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

  public function containsUrl(User $u, string $url): bool {
    $stmt = $this->getPdo()->prepare('SELECT 1 FROM siteVisits, visitors WHERE visitors.uid = ? AND visitors.id = siteVisits.visitorID AND url = ? LIMIT 1');
    $stmt->execute([$u->getUID(), $url]);
    return $stmt->fetchColumn() !== false;
  }

  /**
   * 
   * @param  User $user
   * @param  string $url
   * @return bool
   * @throws InvalidArgumentException
   * @throws RuntimeException
   */
  public function addSiteRefresh(User $user, string $site, bool $status = true) {
    try {
      //$this->getDBIDFor($user);
      if (!$this->containsUrl($user, $site)) {
        $stmt = $this->getPdo()->prepare('INSERT INTO siteVisits (visitorID, url, validity, lastVisit) VALUES (?,?, ?, ?)');
        $data = [
            $user->getDbId(),
            $site,
            $status,
            $user->getLastVisit()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s')];
        $success = $stmt->execute($data);
      } else {
        ///$this->getDBIDFor($user);
        $stmt = $this->getPdo()->prepare('UPDATE siteVisits SET count = count + 1, validity=?, lastVisit = ? WHERE visitorID = ? AND url = ?');
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

  public function getActuals(): array {
    try {
      $rawQueryString = 'SELECT url, SUM(count) as hits, count(visitorID) as userCount '
              . 'FROM siteVisits '
              . 'WHERE validity = 1 '
              . 'GROUP BY url';
      // $queryString = vsprintf($rawQueryString, [$dataField, $dataField]);
      $stmt = $this->getPdo()->prepare($rawQueryString);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      throw new RuntimeException('Statistics could not be fetched', 0, $e);
    }
    return $result;
  }

  public function getstatsForValid(): array {
    try {
      $rawQueryString = 'SELECT url, SUM(count) as hits, count(visitorID) as userCount '
              . 'FROM siteVisits '
              . 'WHERE validity = 1 '
              . 'GROUP BY url';
      // $queryString = vsprintf($rawQueryString, [$dataField, $dataField]);
      $stmt = $this->getPdo()->prepare($rawQueryString);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      throw new RuntimeException('Statistics could not be fetched', 0, $e);
    }
    return $result;
  }

  public function getstatsFor(bool $validUrl = true): array {
    try {
      $rawQueryString = 'SELECT url, SUM(count) as hits, count(visitorID) as userCount '
              . 'FROM siteVisits '
              . 'WHERE validity = ? '
              . 'GROUP BY url';
      // $queryString = vsprintf($rawQueryString, [$dataField, $dataField]);
      $stmt = $this->getPdo()->prepare($rawQueryString);
      $stmt->execute([$validUrl]);
      $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      throw new RuntimeException('Statistics could not be fetched', 0, $e);
    }
    return $result;
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

  public function getUserStatistics(User $user): array {
    try {
      $rawQueryString = 'SELECT url, count FROM siteVisits WHERE visitorID=?';
      // $queryString = vsprintf($rawQueryString, [$dataField, $dataField]);
      $stmt = $this->getPdo()->prepare($rawQueryString);
      $stmt->execute([$user->getDbId()]);
      $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      throw new RuntimeException('Statistics could not be fetched', 0, $e);
    }
    return $result;
  }

}
