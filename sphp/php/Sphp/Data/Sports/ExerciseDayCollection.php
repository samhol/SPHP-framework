<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data\Sports;

use Sphp\DateTime\DateInterface;
use Sphp\DateTime\Date;
/**
 * Implements a HTTP code object collection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ExerciseDayCollection implements \IteratorAggregate, \Sphp\DateTime\Calendars\Events\EventCollectionInterface {

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

  public function setDay(ExerciseDay $e) {
    $date = $e->getDate()->format('Y-m-d');
    $this->days[$date] = $e;
    return $this;
  }

  public function getDay($date): ExerciseDay {
    $d = new \Sphp\DateTime\Date($date);
    $key = $d->format('Y-m-d');
    if (!isset($this->days[$key])) {
      $this->days[$key] = new ExerciseDay($d);
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
      $date = new \Sphp\DateTime\Date($date);
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

  public function containsEvent(\Sphp\DateTime\Calendars\Events\Event $event): bool {
    
  }

  public function getBirthdays(): array {
    
  }

  public function getHolidays(): array {
    
  }

  public function getNotes(): array {
    
  }

  public function insertEvent(\Sphp\DateTime\Calendars\Events\Event $event): bool {
    
  }

  public function mergeEvents(\Sphp\DateTime\Calendars\Events\EventCollectionInterface $events): \this {
    
  }

  public function notEmpty(): bool {
    
  }

  public function toArray(): array {
    
  }

}
