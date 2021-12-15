<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Data\Users;

use Sphp\Network\Utils;
use Sphp\Apps\Trackers\Data\UserAgents\UserAgent;
use Sphp\DateTime\DateTime;
use Sphp\DateTime\ImmutableDateTime;

/**
 * Site user for tracking purposes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class User {

  /**
   * @var int
   */
  private $id;

  /**
   * @var string
   */
  private $domain;

  /**
   * @var string
   */
  private $uid;

  /**
   * @var int
   */
  private $firstVisit;

  /**
   * @var DateTime
   */
  private $lastVisit;

  /**
   * @var int
   */
  private $visits = 1;

  /**
   * @var int
   */
  private $clicks = 1;

  /**
   * @var UserAgent
   */
  private $ua;

  /**
   * @var int
   */
  private $uaId;

  /**
   * @var string
   */
  private $browserName;

  /**
   * @var bool
   */
  private $isCrawler;

  public function __construct(array $data = []) {
    foreach (array_keys(get_object_vars($this)) as $varName) {
      if (array_key_exists($varName, $data)) {
        $this->{$varName} = $data[$varName];
      }
    }
    settype($this->id, 'integer');
    $this->firstVisit = new ImmutableDateTime($this->firstVisit);
    $this->updateLastVisit($this->lastVisit);
  }

  public function __destruct() {
    unset($this->lastVisit, $this->ua);
  }

  public function isUnknown(): bool {
    return $this->browserName === 'Default Browser' && $this->isCrawler === false;
  }

  public function isCrawler(): bool {
    return $this->getUserAgent()->isCrawler();
  }

  public function getId(): int {
    return $this->id;
  }

  public function setId(int $id) {
    $this->id = $id;
    return $this;
  }

  public function getUID(): string {
    return $this->uid;
  }

  public function setUID(string $uid) {
    $this->uid = $uid;
    return $this;
  }

  public function getDomain(): ?string {
    return $this->domain;
  }

  public function setDomain(string $domain) {
    $this->domain = $domain;
    return $this;
  }

  public function getFirstVisit(): DateTime {
    return $this->firstVisit;
  }

  public function getIp(): string {
    return Utils::getClientIp();
  }

  public function setUserAgent(UserAgent $ua = null) {
    $this->ua = $ua;
    return $this;
  }

  public function getUserAgent(): UserAgent {
    if ($this->ua === null) {
      $this->ua = new UserAgent();
    }
    return $this->ua;
  }

  public function updateLastVisit($last = null) {
    if (!$last instanceof ImmutableDateTime) {
      $this->lastVisit = new ImmutableDateTime($last);
    } else {
      $this->lastVisit = $last;
    }
    return $this;
  }

  public function getLastVisit(): DateTime {
    return $this->lastVisit;
  }

  public function getVisits(): int {
    return $this->visits;
  }

  public function addVisit() {
    $this->visits++;
    return $this;
  }

  public function getClicks(): int {
    return $this->clicks;
  }

  public function addClick() {
    $this->clicks++;
    return $this;
  }

}
