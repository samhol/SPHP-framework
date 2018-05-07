<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n\Datetime;

use Sphp\I18n\Gettext\Translator;
use Sphp\I18n\TranslatorInterface;

/**
 * Class localizes weekday and month names
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CalendarUtils {

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
      self::JAN => 'January',
      self::FEB => 'February',
      self::MAR => 'March',
      self::APR => 'April',
      self::MAY => 'May',
      self::JUN => 'June',
      self::JUL => 'July',
      self::AUG => 'August',
      self::SEP => 'September',
      self::OCT => 'October',
      self::NOV => 'November',
      self::DEC => 'December'];

  /**
   * Monday
   */
  const MON = 1;

  /**
   * Tuesday
   */
  const TUE = 2;

  /**
   * Wednesday
   */
  const WED = 3;

  /**
   * Thursday
   */
  const THU = 4;

  /**
   * Friday
   */
  const FRI = 5;

  /**
   * saturday
   */
  const SAT = 6;

  /**
   * Sunday
   */
  const SUN = 7;

  /**
   * week day names in English
   *
   * @var string[]
   */
  private static $weekdays = [
      self::MON => 'Monday',
      self::TUE => "Tuesday",
      self::WED => 'Wednesday',
      self::THU => 'Thursday',
      self::FRI => 'Friday',
      self::SAT => 'Saturday',
      self::SUN => 'Sunday'];

  /**
   * @var Translator|null 
   */
  private $translator;

  /**
   * @var int 
   */
  private $fwd = self::MON;

  /**
   * Constructor
   *
   * @param  Translator|null $translator the translator component
   */
  public function __construct(TranslatorInterface $translator = null) {
    if ($translator !== null) {
      $this->translator = $translator;
    } else {
      $this->translator = new Translator();
    }
  }

  /**
   * Sets the translator
   * 
   * @param  Translator|null $translator the translator or `null` for no translator
   * @return $this for a fluent interface
   */
  public function setTranslator(Translator $translator = null) {
    $this->translator = $translator;
    return $this;
  }

  /**
   * 
   * @return bool
   */
  public function hasTranslator(): bool {
    return $this->translator !== null;
  }

  protected function translate($items) {
    if ($this->hasTranslator()) {
      if (is_array($items)) {
        $items = $this->translator->translateArray($items);
      } else if (is_string($items)) {
        $items = $this->translator->get($items);
      }
    }
    return $items;
  }

  /**
   * 
   * 
   * @param  int $wd optional number of the first weekday
   * @return $this for a fluent interface
   */
  public function setFirstDayOfWeek(int $wd = self::MON) {
    $this->fwd = $wd;
    return $this;
  }

  /**
   * Returns the name or the abbreviation of the given weekday number
   *
   * @param  int $wd weekday number (1-7)
   * @param  int|null $length optional length of the weekday string
   * @return string the name or the abbreviation of the given weekday number
   */
  public function getWeekdayName($wd, $length = null) {
    $day = $this->translate(self::$weekdays[$wd]);
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
   * @return string[] the names or the abbreviations of the weekday names
   */
  public function getWeekdays(int $length = null) {
    $sequence = static::$weekdays;
    if ($this->fwd !== self::MON) {
      $first = array_slice(self::$weekdays, $this->fwd - 1);
      $last = array_slice(self::$weekdays, 0, (7 - count($first)));
      $sequence = array_merge($first, $last);
      //$sequence = [];
      //print_r($sequence);
      //print_r($d);
      //$days = $d;
    }
    $translations = $this->translate($sequence);
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
  public function getMonthName(int $month = null, int $length = null) {
    if ($month === null) {
      $month = (int) date('m');
    }
    $monthName = $this->translate(self::$months[$month]);
    if ($length > 0) {
      $monthName = mb_substr($monthName, 0, $length);
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
  public function getMonths(int $length = null) {
    $months = $this->translate(self::$months);
    if ($length > 0) {
      foreach ($months as $number => $month) {
        $months[$number] = substr($month, 0, $length);
      }
    }
    return $months;
  }

}
