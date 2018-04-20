<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

/**
 * Description of DateData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DateData implements \IteratorAggregate {

  /**
   * @var Date 
   */
  private $date;

  /**
   * @var array 
   */
  private $collection = [];

  public function __construct(Date $date) {
    $this->date = $date;
  }

  public function getDate(): Date {
    return $this->date;
  }

  public function merge(DateData $event) {
    if ($event->getDate()->equals($this->getDate()) && !$this->contains($event)) {
      foreach ($event as $evt) {
        $this->addEvent($event);
      }
    }
  }
  public function addEvent(SpecialDay $event) {
    if ($event->getDate()->equals($this->getDate()) && !$this->contains($event)) {
      $this->collection[] = $event;
    }
  }

  /**
   * 
   * @param SpecialDay $date
   * @return bool 
   */
  public function contains(SpecialDay $date): bool {
    $contains = false;
    if ($date->getDate()->equals($this->getDate())) {
      foreach ($this->collection as $day) {
        if ($day == $date) {
          $contains = true;
          break;
        }
      }
      return $contains;
    }
  }

  public function __toString(): string {
    return implode("\n",$this->collection);
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->collection);
  }

}
