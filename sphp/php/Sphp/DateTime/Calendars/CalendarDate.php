<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars;

use Sphp\DateTime\Date;

/**
 * Description of CalendarDate
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CalendarDate implements \Sphp\DateTime\DateInterface {

  /**
   * @var Date 
   */
  private $date;

  /**
   * @var CalendarDateNotes 
   */
  private $noteCollection;

  /**
   * @var mixed
   */
  private $data;

  public function __construct($date = null) {
    if ($date instanceof \DateTimeInterface) {
      $date = new Date($date);
    } else if ($date instanceof Date) {
      $date = $date;
    } else if ($date instanceof CalendarDate) {
      $date = $date->getDate();
    } else if (is_float($date)) {
      $date = Date::fromTimestamp($date)->format('Y-m-d');
    } else if (is_string($date)) {
      $date = Date::fromString($date);
    } else {
      $date = new Date();
    }
    $this->date = $date;
    $this->noteCollection = new CalendarDateNotes($this->date);
  }

  public function getData() {
    return $this->data;
  }

  public function setData($data) {
    $this->data = $data;
    return $this;
  }

  public function getDate(): Date {
    return $this->date;
  }

  public function getInfo(): CalendarDateNotes {
    return $this->noteCollection;
  }

  public function hasInfo(): bool {
    return $this->getInfo()->notEmpty();
  }

  public function mergeNotes(CalendarDate $date) {
    $this->noteCollection->merge($date->getInfo());
    return $this;
  }

  public function addNote(CalendarDateNote $note) {
    $this->noteCollection->addNote($note);
    return $this;
  }

  /**
   * 
   * @param  CalendarDateNote $note
   * @return bool 
   */
  public function containsNote(CalendarDateNote $note): bool {
    return $this->noteCollection->contains($note);
  }

  public function __toString(): string {
    $output = "$this->date:\n";
    //print_r($this->notes);
    foreach ($this->getInfo() as $note) {
      // print_r($note);
      $output .= "  $note\n";
    }
    return $output;
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
