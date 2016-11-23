<?php

/**
 * Calendar.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\I18n;

use Sphp\Core\I18n\Gettext\Translator;
use Sphp\Core\Types\Arrays;

/**
 * Class localizes weekday and month names
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-02-23
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Calendar implements TranslatorAwareInterface {

  use TranslatorAwareTrait;

  /**
   * January
   */
  const JAN = 1;

  /**
   * February
   */
  const FEB = 2;

  /**
   * March
   */
  const MAR = 3;

  /**
   * April
   */
  const APR = 4;

  /**
   * April
   */
  const MAY = 5;

  /**
   * June
   */
  const JUN = 6;

  /**
   * July
   */
  const JUL = 7;

  /**
   * August
   */
  const AUG = 8;

  /**
   * September
   */
  const SEP = 9;

  /**
   * October
   */
  const OCT = 10;

  /**
   * November
   */
  const NOV = 11;

  /**
   * December
   */
  const DEC = 12;

  /**
   * month names in english
   *
   * @var array[string]
   */
  private static $months = [
      self::JAN => "January",
      self::FEB => "February",
      self::MAR => "March",
      self::APR => "April",
      self::MAY => "May",
      self::JUN => "June",
      self::JUL => "July",
      self::AUG => "August",
      self::SEP => "September",
      self::OCT => "October",
      self::NOV => "November",
      self::DEC => "December"];

  /**
   * monday
   */
  const MON = 1;

  /**
   * tuesday
   */
  const TUE = 2;

  /**
   * wednesday
   */
  const WED = 3;

  /**
   * thursday
   */
  const THU = 4;

  /**
   * friday
   */
  const FRI = 5;

  /**
   * saturday
   */
  const SAT = 6;

  /**
   * sunday
   */
  const SUN = 7;

  /**
   * wweek day names in english
   *
   * @var string[]
   */
  private static $weekdays = [
      self::MON => "Monday",
      self::TUE => "Tuesday",
      self::WED => "Wednesday",
      self::THU => "Thursday",
      self::FRI => "Friday",
      self::SAT => "Saturday",
      self::SUN => "Sunday"];

  /**
   * Constructs a new instance
   *
   * @param  Translator|null $translator the translator component
   */
  public function __construct(Translator $translator = null) {
    if ($translator !== null) {
      $this->setTranslator($translator);
    } else {
      $this->setTranslator(new Translator());
    }
  }

  /**
   * Returns the name or the abbreviation of the given weekday number
   *
   * @param  int $wd weekday number (1-7)
   * @param  int|null $length optional length of the weekday string
   * @return string the name or the abbreviation of the given weekday number
   */
  public function getWeekdayName($wd, $length = null) {
    $day = $this->getTranslator()->get(self::$weekdays[$wd]);
    if ($length > 0) {
      $day = substr($day, 0, $length);
    }
    return $day;
  }

  /**
   * Returns the names or the abbreviations of the weekday names
   *
   * **Note:** array structure is <var>[weekday number] => "Weekday name"</var>.
   *
   * @param  int|null $length optional length of a individual weekday string
   * @param  int $firstDay optional number of the first weekday
   * @return string[] the names or the abbreviations of the weekday names
   */
  public function getWeekdays($length = null, $firstDay = self::MON) {
    $days = Arrays::copy(self::$weekdays);
    if ($firstDay !== self::MON) {
      $first = array_slice(self::$weekdays, $firstDay - 1);
      $last = array_slice(self::$weekdays, 0, (7 - count($first)));
      $sequence = array_merge($first, $last);
      //$sequence = [];
      //print_r($sequence);
      foreach ($sequence as $name) {
        $key = array_search($name, self::$weekdays);
        $d[$key] = $name;
      }
      //print_r($d);
      $days = $d;
    }
    $translations = $this->getTranslator()->get($days);
    if ($length > 0) {
      foreach ($translations as $number => $day) {
        $translations[$number] = substr($day, 0, $length);
      }
    }
    return $translations;
  }

  /**
   * Returns the name or the abbreviation of the given month number
   *
   * @param  int $month month number (1-12)
   * @param  int|null $length optional length of the month string
   * @return string the name or the abbreviation of the given month number
   */
  public function getMonthName($month, $length = null) {
    $monthName = $this->getTranslator()->get(self::$months[$month]);
    if ($length > 0) {
      $monthName = substr($monthName, 0, $length);
    }
    return $monthName;
  }

  /**
   * Returns the names or the abbreviations of the month names
   *
   * **Note:** array structure is <var>[month number] => "month name"</var>.
   *
   * @param  int|null $length optional length of a individual month name string
   * @return string[] the names or the abbreviations of the month names
   */
  public function getMonths($length = null) {
    $months = $this->getTranslator()->get(self::$months);
    if ($length > 0) {
      foreach ($months as $number => $month) {
        $months[$number] = substr($month, 0, $length);
      }
    }
    return $months;
  }

}
