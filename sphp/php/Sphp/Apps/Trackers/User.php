<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Apps\Trackers;

use Sphp\Stdlib\Random\UUID;

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

  /**
   * @var int
   */
  private $lastVisit;

  public function __construct(string $uid, int $last = null) {
    $this->uid = $uid;
    $this->updateLastVisit($last);
  }

  public function getId(): string {
    return $this->uid;
  }

  public function updateLastVisit(int $last = null) {
    if ($last === null) {
      $this->lastVisit = time();
    } else {
      $this->lastVisit = $last;
    }
  }

  public function getLastVisit(): int {
    return $this->lastVisit;
  }

  public static function generate(): User {
    $token = UUID::v5(UUID::v4(), 'tracker');
    return new self($token);
  }

  public static function fromCookie(): ?User {
    $instance = null;
    if (isset($_COOKIE['visitor_id'])) {
      $visitor_id = $_COOKIE['visitor_id'];
      $instance = new self($visitor_id);

      if (isset($_COOKIE['lastVisit'])) {
        $instance->updateLastVisit((int) $_COOKIE['lastVisit']);
      }
    }
    return $instance;
  }

}
