<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Apps\Trackers;

use Sphp\Stdlib\Random\UUID;
use Sphp\Network\Utils;

/**
 * Description of User
 *
 * @author samih
 */
class User {

  /**
   * @var string
   */
  private $uid;
  private $dbId;

  /**
   * @var int
   */
  private $lastVisit;
  private $visits = 0;
  private $firstVisit;

  public function __construct(string $uid, \DateTimeImmutable $last = null) {
    $this->uid = $uid;
    $this->setLastVisit($last);
  }

  public function getUID(): string {
    return $this->uid;
  }

  public function getDbId(): ?int {
    return $this->dbId;
  }

  public function setDbId(int $dbId = null) {
    $this->dbId = $dbId;
    return $this;
  }

  public function setLastVisit(\DateTimeImmutable $last = null) {
    if ($last === null) {
      $this->lastVisit = new \DateTimeImmutable();
    } else {
      $this->lastVisit = $last;
    }
    return $this;
  }

  public function setFirstVisit(\DateTimeImmutable $timestamp) {
    $this->firstVisit = $timestamp;
    return $this;
  }

  public function getFirstVisit(): \DateTimeImmutable {
    if ($this->firstVisit === null) {
      $this->firstVisit = $this->getLastVisit();
    }
    return $this->firstVisit;
  }

  public function getLastVisit(): \DateTimeImmutable {
    return $this->lastVisit;
  }

  public function getVisits(): int {
    return $this->visits;
  }

  public function setVisits(int $visits) {
    $this->visits = $visits;
    return $this;
  }

  public function getIp(): string {
    return Utils::getClientIp();
  }

  public function getUserAgent(): string {
    return Utils::getHttpUserAgent();
  }

  public static function generate(): User {
    $token = UUID::v5(UUID::v4(), 'tracker');
    return new self($token);
  }

}
