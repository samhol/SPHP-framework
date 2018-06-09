<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars;

use Sphp\DateTime\DateInterface;
use Sphp\DateTime\Date;
use Exception;
use Sphp\DateTime\Exceptions\DateTimeException;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;
use Sphp\DateTime\Calendars\Events\Event;

/**
 * Description of CalendarDate
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CalendarDate implements DateInterface {

  /**
   * @var Date 
   */
  private $date;

  /**
   * @var DateEvents 
   */
  private $events;

  /**
   * @var mixed
   */
  private $data;

  /**
   * Constructor
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @throws DateTimeException if date cannot be parsed from input
   */
  public function __construct($date = null) {
    try {
      $this->date = Date::from($date);
    } catch (Exception $ex) {
      throw new DateTimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    $this->events = new DiaryDate($this->date);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->date, $this->events, $this->data);
  }

  public function __toString(): string {
    $output = "$this->date:\n";
    //print_r($this->notes);
    foreach ($this->getEvents() as $note) {
      // print_r($note);
      $output .= "  $note\n";
    }
    return $output;
  }

  /**
   * Returns the data attached to the date
   * 
   * @return mixed data
   */
  public function getData() {
    return $this->data;
  }

  /**
   * Sets the data attached to the date
   * 
   * @param  mixed $data
   * @return $this
   */
  public function setData($data) {
    $this->data = $data;
    return $this;
  }

  /**
   * Returns the plain date object
   * 
   * @return Date the plain date object
   */
  public function getDate(): Date {
    return $this->date;
  }

  public function getEvents(): DiaryDate {
    return $this->events;
  }


  public function mergeDateEvents(DiaryDate $events) {
    $this->events->merge($events->getNotes());
    return $this;
  }

  public function addNote(Event $note) {
    $this->events->addNote($note);
    return $this;
  }

  /**
   * 
   * @param  CalendarDateNote $note
   * @return bool 
   */
  public function containsEvent(Event $note): bool {
    return $this->events->contains($note);
  }

  public function toDateString(): string {
    return $this->date->toDateString();
  }

  public function format(string $format): string {
    return $this->date->format($format);
  }

  public function getMonth(): int {
    return $this->date->getMonth();
  }

  public function getMonthDay(): int {
    return $this->date->getMonthDay();
  }

  public function getWeek(): int {
    return $this->date->getWeek();
  }

  public function getWeekDay(): int {
    return $this->date->getWeekDay();
  }

  public function getYear(): int {
    return $this->date->getYear();
  }

  public function isCurrent(): bool {
    return $this->date->isCurrent();
  }

  public function matchesWith($date): bool {
    return $this->date->matchesWith($date);
  }

}
