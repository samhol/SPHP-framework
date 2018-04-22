<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Holidays;

use DateTime;
use IteratorAggregate;
use Sphp\DateTime\Holidays\Holiday;
use Sphp\DateTime\Date;

/**
 * Description of SpecialDays
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Holidays implements IteratorAggregate {

  /**
   * @var Holiday[]
   */
  private $days;

  /**
   * @var int 
   */
  private $year;

  public function __construct(int $year = null) {
    if ($year === null) {
      $year = (int) date('Y');
    }
    $this->year = $year;
    $this->days = [];
  }

  public function merge(Holidays $days) {
    foreach ($days as $key => $group) {
      $this->mergeDateData($group);
    }
  }

  public function mergeDateData(DateWithData $day) {
    $key = $day->getDate()->format('Y-m-d');
    if (!$this->hasSpecialDays($day->getDate())) {
      $this->days[$key] = $day;
    } else {
      $this->days[$key]->merge($day);
    }
    return $this;
  }

  public function addHoliday($date, string $name): Holiday {
    $holiday = Holiday::from($date, $name);
    $this->add($holiday);
    return $holiday;
  }

  public function add(Holiday $day) {
    $key = $day->getDate()->format('Y-m-d');
    if (!$this->contains($day)) {
      $data = new DateWithData($day->getDate());
      $data->addEvent($day);
      $this->days[$key] = $data;
    }
    return $this;
  }

  /**
   * 
   * @param Holiday $date
   * @return bool 
   */
  public function contains(Holiday $date): bool {
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
  public function get(Date $date): DateWithData {
    $key = $date->format('Y-m-d');
    if ($this->hasSpecialDays($date)) {
      return $this->days[$key];
    }
    return [];
  }

  public function getIterator(): \Traversable {
    ksort($this->days);
    return new \ArrayIterator($this->days);
  }

}
