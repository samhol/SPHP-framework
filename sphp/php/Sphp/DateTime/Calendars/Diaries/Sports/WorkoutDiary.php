<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Sports;

use IteratorAggregate;
use Sphp\DateTime\Calendars\Diaries\LogInterface;
use Sphp\DateTime\DateInterface;
use Sphp\DateTime\Date;
use Sphp\DateTime\Calendars\Diaries\DiaryInterface;

/**
 * Implements a HTTP code object collection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class WorkoutDiary implements IteratorAggregate, DiaryInterface {

  private $days;

  /**
   * Constructor
   */
  public function __construct() {
    $this->days = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->days);
  }

  public function __toString() {
    $output = '';
    foreach ($this as $ex) {
      $output .= "\n$ex";
    }
    return $output;
  }

  public function setDay(WorkoutDay $e) {
    $date = $e->getDate()->format('Y-m-d');
    $this->days[$date] = $e;
    return $this;
  }

  public function getDay($date): WorkoutDay {
    $d = new Date($date);
    $key = $d->format('Y-m-d');
    if (!isset($this->days[$key])) {
      $this->days[$key] = new WorkoutDay($d);
    }
    return $this->days[$key];
  }

  /**
   * Returns
   *
   * @param  Exercise $e 
   * @return boolean
   */
  public function contains($date): bool {
    return $this->dateExists($e->getDate()) && $this->dateContainsType($e);
  }

  public function dateExists($date): bool {
    if (!$date instanceof DateInterface) {
      $date = new Date($date);
    }
    return array_key_exists($date->format('Y-m-d'), $this->days);
  }

  /**
   * Returns
   *
   * @param  Exercise $e
   * @return boolean
   */
  public function dateContainsType(Exercise $e): bool {
    return $this->dateExists($e->getDate()) && array_key_exists($e->getName(), $this->days[$e->getDate()->format('Y-m-d')]);
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->days);
  }

  public function containsLog(LogInterface $log): bool {
    $contains = false;
    foreach ($this->days as $n) {
      $contains = $log == $n;
      if ($contains) {
        break;
      }
    }
    return $contains;
  }

  public function notEmpty(): bool {
    return !empty($this->days);
  }

  public function toArray(): array {
    return $this->days;
  }

}
