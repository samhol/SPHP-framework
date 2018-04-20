<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\DateTime;

use DateTime;

/**
 * Description of SpecialDay
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SpecialDay {

  /**
   * @var Date 
   */
  private $date;

  /**
   * @var string 
   */
  private $name;

  /**
   *  
   * 
   * @param Date $date 
   * @param string $name
   */
  public function __construct(Date $date, string $name) {
    $this->date = $date;
    $this->name = $name;
  }

  public function getDate(): Date {
    return $this->date;
  }

  public function getName(): string {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  public function equals($date): bool {
    return $this->date->equals($date);
  }

  public function __toString(): string {
    return $this->date->format('l, Y-m-d') . ": " . $this->name;
  }

  public static function from($date, string $name): SpecialDay {
    if (is_string($date)) {
      return static::fromDateString($date, $name);
    }else if (is_int($date)) {
      return static::fromTimestamp($date, $name);
    } else if ($date instanceof Date) {
      return new static($date, $name);
    }
  }

  public static function fromTimestamp(int $unixtimestamp, string $name): SpecialDay {
    return new static(Date::createFromTimestamp($unixtimestamp), $name);
  }

  public static function fromDateString(string $dateString, string $name): SpecialDay {
    return new static(Date::createFromString($dateString), $name);
  }

}
