<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\DateTime;

use IteratorAggregate;

/**
 * Description of SpecialDays
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SpecialDays implements IteratorAggregate, SpecialDaysCollection {

  /**
   *
   * @var SpecialDay
   */
  private $days;

  public function __construct(array $data) {
    $this->days = $data;
  }

  public function merge(SpecialDays $days) {
    foreach ($days as $key => $group) {
      
    }
  }

  public function add(SpecialDay $day) {
    $key = $day->getDate()->format('Y-m-d');
    if (!$this->contains($day)) {
      $this->days[$key][] = $day;
    }
    return $this;
  }

  /**
   * 
   * @param SpecialDay $date
   * @return bool 
   */
  public function contains(SpecialDay $date): bool {
    $key = $date->getDate()->format('Y-m-d');
    if (!array_key_exists($key, $this->days)) {
      return false;
    } else {
      $contains = false;
      foreach ($this->days[$key] as $day) {
        if ($day == $date) {
          $contains = true;
          break;
        }
      }
      return $contains;
    }
  }

  /**
   * 
   * @param  Date $date
   * @return bool 
   */
  public function hasSpecialDays(Date $date): bool {
    $key = $date->format('Y-m-d');
    return array_key_exists($key, $this->days);
  }

  /**
   * 
   * @param Date $date
   */
  public function get(Date $date): array {
    $key = $date->format('Y-m-d');
    if ($this->hasSpecialDays($date)) {
      return $this->days[$key];
    }
    return [];
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->days);
  }

}
