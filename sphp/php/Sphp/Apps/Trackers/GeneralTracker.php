<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers;

use Sphp\Stdlib\Random\UUID;
use Sphp\Apps\Trackers\Data\Users\User;
use Sphp\Apps\Trackers\Data\Users\Users;
use Sphp\Apps\Trackers\Data\UserAgents\UserAgent;
use Sphp\Apps\Trackers\Data\UserAgents\UserAgents;
use Sphp\Network\Utils;
use Sphp\Apps\Trackers\Data\URLs\URLDataDb;
use Sphp\Apps\Trackers\Data\URLs\URLData;
use Sphp\Exceptions\RuntimeException;

/**
 * Class GeneralTracker
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class GeneralTracker {

  /**
   * @var Users 
   */
  private $visitors;

  /**
   * @var UserAgents 
   */
  private $uaDb;

  /**
   * @var URLDataDb
   */
  private $urlDb;
  private $executed = false;

  /**
   * @var UserAgent
   */
  private $ua;

  /**
   * @var UrlData
   */
  private $urlData;

  public function __construct(Users $visitors, UserAgents $uaDb, URLDataDb $urlDataDb) {
    $this->out = [];
    $this->visitors = $visitors;
    $this->uaDb = $uaDb;
    $this->urlDb = $urlDataDb;
    $this->urlData = URLData::fromCurrentPage();
    $this->getCurrentUserAgent();
  }

  public function __destruct() {
    unset($this->visitors, $this->uaDb, $this->urlData);
  }

  public function run(): void {
    if (!$this->executed) {
      $userAgent = $this->storeCurrentUserAgent();
      $this->urlData = $this->processUrlData();
      $this->ua = $userAgent;
      if (!$this->ua->isCrawler()) {
        $user = $this->storeUser();
        // print_r($this->ua);
        // $this->processDateData($user);
      }
      $this->executed = true;
    }
    $_SESSION[self::class] = $this->out;
  }

  public function getCurrentUserAgent(): UserAgent {
    return $this->uaDb->getUserAgent(Utils::getHttpUserAgent());
  }

  public function getCurrentUser(): ?User {
    $instance = null;
    if (filter_has_var(INPUT_COOKIE, 'visitor_id')) {
      $uid = filter_input(INPUT_COOKIE, 'visitor_id', FILTER_SANITIZE_STRING);
      $instance = $this->visitors->getUser($uid);
      if ($instance !== null) {
        $instance->setUserAgent($this->getCurrentUserAgent())
                ->setDomain($this->urlData->getDomain());
      }
    }
    return $instance;
  }

  private function storeUser(): User {
    $user = $this->getCurrentUser();
    if ($user !== null) {
      $this->updateExistingUser($user);
    } else {
      $user = $this->addNewUser();
    }
    $this->storeCookie($user);
    $this->visitors->storeDate($user);
    return $user;
  }

  private function storeCookie(User $user): void {
    $year = 31536000 + time();
    $success = setcookie('visitor_id', $user->getUID(), $year, '/');
    if (!$success) {
      throw new RuntimeException('User cookie could not be set');
    }
    $this->out['user'][] = 'User cookie is refreshed';
  }

  private function createUniqueToken(string $seed = self::class): string {
    $token = UUID::v5(UUID::v4(), $seed);
    $this->out['user'][] = 'Generating user token: ' . $token;
    while ($this->visitors->containsUID($token)) {
      $token = UUID::v5(UUID::v4(), $seed);
      $this->out['user'][] = 'Generating user token: ' . $token;
    }
    $this->out['user'][] = 'accepted user token: ' . $token;
    return $token;
  }

  protected function addNewUser(): User {
    $this->out['user'][] = 'Adding a new user';
    $user = new User();
    $user->setUID($this->createUniqueToken())
            ->setUserAgent($this->getCurrentUserAgent())
            ->setDomain($this->urlData->getDomain());

    // $this->dateDataDb->addRevisit();
    if ($this->visitors->store($user)) {
      //$user->updateLastVisit();
      // $user->storeCookie();
      $this->out['user'][] = "Welcome: " . $user->getUID() . "!";
      $this->out['user'][] = "crawler: " . (int) $user->isCrawler();
      $this->out['user'][] = "unknown type: " . (int) $user->isUnknown();
      /*  if (!$user->isCrawler()) {
        $this->dateDataDb->addFirstVisit();
        } */
    } else {
      $this->out['user'][] = "New user failed: " . $user->getUID() . "!";
    }
    return $user;
  }

  protected function updateExistingUser(User $dbUser): void {
    $this->out['user'][] = "Updating user";
    $current = time();
    //$dbUser = $this->visitors->getUser($user->getUID());
    $dbUser->addClick();
    $dbUser->setUserAgent($this->ua);
    $lastVisit = $dbUser->getLastVisit();
    $dbUser->updateLastVisit($current);
    $this->out['user'][] = 'current time: ' . date('Y-m-d', $current);
    $this->out['user'][] = 'last visit: ' . $lastVisit->format('Y-m-d');
    $changed = $lastVisit->dateEqualsTo($current);
    if ($changed) {
      $dbUser->addVisit();
      //$this->dateDataDb->addRevisit();
      $this->out['user'][] = "Delay gone";
      $this->out['user'][] = "You last visited on " . $dbUser->getLastVisit()->format('m/d/y h:i:s');
    } else {
      $this->out['user'][] = "Delay not gone!";
    }
    $this->visitors->store($dbUser);
    $this->out['user'][] = "DB user updated!";
  }

  /**
   * 
   * @return UserAgent|null
   */
  public function storeCurrentUserAgent(): UserAgent {
    $ua = Utils::getHttpUserAgent();
    //$obj = null;
    if ($ua !== null) {
      $this->out['ua'][] = $ua;
      $obj = $this->uaDb->updateUserAgentData($ua);
      //$obj = $this->uaDb->getUserAgent($ua);
      $this->out['ua'][] = 'is crawler: ' . var_export($obj->isCrawler(), true);
    } else {
      $obj = new UserAgent();
    }
    $this->ua = $obj;
    return $obj;
  }

  /* private function processDateData(User $user): void {
    if ($user->isUnknown()) {
    $this->dateDataDb->addUnknownVisit();
    } else if ($user->isCrawler()) {
    $this->dateDataDb->addCrawlerVisit();
    } else {
    $this->dateDataDb->addRefresh();
    }
    //return $curl;
    } */

  protected function processUrlData(): URLData {
    $curl = URLData::fromCurrentPage();
    if ($this->urlDb->updateSiteData($curl)) {
      $this->out['url'][] = "URL data updated for domain: " . $curl->getDomain();
    }
    return $curl;
  }

}
