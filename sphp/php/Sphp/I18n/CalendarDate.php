<?php

/**
 * Calendar.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\I18n;

use Sphp\I18n\Gettext\Translator;
use Sphp\Stdlib\Arrays;
use DateTimeInterface;
use DateTime;

/**
 * Class localizes weekday and month names
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-02-23
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CalendarDate implements TranslatorAwareInterface {

  use TranslatorAwareTrait;

  /**
   *
   * @var DateTimeInterface
   */
  private $date;

  /**
   * 
   * @param DateTimeInterface|null $date
   * @param Translator|null $translator the translator component
   */
  public function __construct(DateTimeInterface $date = null, Translator $translator = null) {
    if ($date !== null) {
      $date = new DateTime();
    }
    $this->setDate($date);
    if ($translator !== null) {
      $this->setTranslator($translator);
    } else {
      $this->setTranslator(new Translator());
    }
  }

  /**
   * 
   * @return DateTimeInterface
   */
  public function getDate() {
    return $this->date;
  }

  /**
   * 
   * @param  DateTimeInterface $date
   * @return self for a fluent interface
   */
  public function setDate(DateTimeInterface $date) {
    $this->date = $date;
    return $this;
  }

  /**
   * Returns the name or the abbreviation of the given weekday number
   *
   * @param  int|null $length optional length of the weekday string
   * @return string the name or the abbreviation of the given weekday number
   */
  public function getWeekdayName($length = null) {
    $day = $this->getTranslator()->get($this->date->format('l'));
    if ($length > 0) {
      $day = mb_substr($day, 0, $length);
    }
    return $day;
  }

  /**
   * Returns the name or the abbreviation of the given month number
   *
   * @param  int|null $length optional length of the month string
   * @return string the name or the abbreviation of the given month number
   */
  public function getMonthName($length = null) {
    $monthName = $this->getTranslator()->get($this->date->format('F'));
    if ($length > 0) {
      $monthName = mb_substr($monthName, 0, $length);
    }
    return $monthName;
  }

  /**
   * Returns the name or the abbreviation of the given month number
   *
   * @return string the name or the abbreviation of the given month number
   */
  public function getFiDate() {
    $time = $this->date->format('H:i.s');
    $day = $this->date->format('d');
    $year = $this->date->format('Y');
    $monthName = $this->getTranslator()->get($this->date->format('F')) . "ta";
    return "$day. $monthName $year kello $time";
  }

  /**
   * 
   * @param  int $timestamp
   * @param  Translator $translator
   * @return self new instance 
   */
  public static function fromTimestamp($timestamp, Translator $translator = null) {
    return new static(new DateTime("@$timestamp"), $translator);
  }

}
