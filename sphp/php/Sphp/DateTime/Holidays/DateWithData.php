<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Holidays;
use Sphp\DateTime\Date;
/**
 * Description of DateData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DateWithData implements \IteratorAggregate {

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

  public function merge(DateWithData $dateWithData) {
    if ($dateWithData->getDate()->equals($this->getDate()) && !$this->contains($dateWithData)) {
      foreach ($dateWithData as $evt) {
        $this->addEvent($evt);
      }
    }
  }

  public function addEvent(Holiday $event) {
    if ($event->getDate()->equals($this->getDate()) && !$this->contains($event)) {
      $this->collection[] = $event;
    }
  }

  /**
   * 
   * @param  Holiday $date
   * @return bool 
   */
  public function contains(Holiday $date): bool {
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
    return implode("\n", $this->collection);
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->collection);
  }

}
