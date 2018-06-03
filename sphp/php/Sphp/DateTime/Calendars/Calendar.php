<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars;

use IteratorAggregate;
use Sphp\DateTime\Date;
use Traversable;
use Exception;
use Sphp\DateTime\Calendars\Events\AnnualHoliday;
use Sphp\DateTime\Calendars\Events\EventCollection;
use Sphp\DateTime\Calendars\Diaries\DiaryInterface;

/**
 * Basic implementation of a traversable calendar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Calendar implements IteratorAggregate, TraversableCalendar {

  /**
   * @var CalendarDate[]
   */
  private $days;

  /**
   * @var DiaryInterface
   */
  private $diaries;

  /**
   * Constructor
   */
  public function __construct(DiaryInterface $events = null) {
    $this->days = [];
    if ($events === null) {
      $events = new Diaries\Diary();
    }
    $this->useEvents($events);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->days);
  }

  /**
   * Clone method
   */
  public function __clone() {
    $this->days = clone $this->days;
  }

  public function useEvents(DiaryInterface $events) {
    $this->diaries = $events;
    return $this;
  }

  public function getEvents(): DiaryInterface {
    return $this->diaries;
  }

  /**
   * 
   * @param  TraversableCalendar $days
   * @return $this for a fluent interface
   */
  public function mergeCalendar(TraversableCalendar $days) {
    foreach ($days as $group) {
      $this->mergeDate($group);
    }
    return $this;
  }

  /**
   * 
   * @param  CalendarDate $date
   * @return CalendarDate
   */
  public function mergeDate(CalendarDate $date): CalendarDate {
    //$key = $this->parseKey($date);
    if (!$this->contains($date)) {
      return $this->setDate($date);
    } else {
      $events = $date->getEvents();
      return $this->get($date)->getEvents()->mergeEvents($events);
    }
  }

  /**
   * 
   * @param  CalendarDate $date
   * @return CalendarDate
   */
  public function setDate(CalendarDate $date): CalendarDate {
    $key = $date->toDateString();
    $this->days[$key] = $date;
    return $this->days[$key];
  }

  /**
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @return string
   */
  protected function parseKey($date): string {
    try {
      $key = Date::from($date)->toDateString();
    } catch (Exception $ex) {
      $key = '';
    }
    return $key;
  }

  /**
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @return bool 
   */
  public function contains($date): bool {
    $key = $this->parseKey($date);
    return array_key_exists($key, $this->days);
  }

  /**
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @return CalendarDate
   */
  public function get($date): CalendarDate {
    $key = $this->parseKey($date);
    if (!array_key_exists($key, $this->days)) {
      $calendarDate = new CalendarDate($date);
      $events = $this->getEvents()->getEventsForDate($date);
      $calendarDate->getEvents()->mergeDiaries($this->getEvents());
      $this->diaries->addListener($calendarDate->getEvents());
      $this->days[$key] = $calendarDate;
    }
    return $this->days[$key];
  }

  /**
   * Create a new iterator to iterate through dates in calendar
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    ksort($this->days);
    return new \ArrayIterator($this->days);
  }

}
