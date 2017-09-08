<?php

/**
 * Calendar.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\I18n\Datetime;

use Sphp\I18n\Translatable;
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
class CalendarDate implements Translatable {

  use \Sphp\I18n\TranslatorAwareTrait;

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
  public function __construct(DateTimeInterface $date = null, $lang = null) {
    if ($date === null) {
      $date = new DateTime();
    }
    $this->setDate($date);

    $t = new Translator('Sphp.Datetime');
    $this->setTranslator($t);
  }

  /**
   * 
   * @return DateTimeInterface
   */
  public function getDate(): DateTimeInterface {
    return $this->date;
  }

  /**
   * 
   * @param  DateTimeInterface $date
   * @return $this for a fluent interface
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
  public function getWeekdayName($length = null): string {
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
  public function getMonthName(int $length = null): string {
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
  public function getFiDate(): string {
    $stamp = $this->date->getTimestamp();
    $day = $this->date->format('j');
    $year = $this->date->format('Y');
    $monthName = $this->getTranslator()->get($this->date->format('F')) . "ta";
    $dayName = $this->getTranslator()->get($this->date->format('l'));
    return "$dayName $day. $monthName $year";
  }

  /**
   * Returns the name or the abbreviation of the given month number
   *
   * @return string the name or the abbreviation of the given month number
   */
  public function strftime(string $format, string $lang = null): string {
    $stamp = $this->date->getTimestamp();
    $oldLang = \Sphp\Config\Locale::getDatetimeLocale();
    if ($lang === null) {
      $lang = $oldLang;
    }
    if ($lang !== $oldLang) {
      \Sphp\Config\Locale::setLocale(LC_TIME, $lang);
    }

    $output = strftime($format, $stamp);
    if ($lang !== $oldLang) {
      \Sphp\Config\Locale::setLocale(LC_TIME, $oldLang);
    }
    /* switch ($lang) {
      case 'en':
      setlocale(LC_TIME, 'en_CA.UTF-8');
      echo strftime("%B %e, %G");
      break;
      case 'fr':
      setlocale(LC_TIME, 'fr_CA.UTF-8');
      echo strftime("%e %B %G %H:%M:%S");
      break;
      case 'fi':
      setlocale(LC_TIME, 'fi_FI.UTF-8');
      echo strftime("%A %e %B %G %H:%M:%S");
      break;
      } */
    return $output;
  }

  /**
   * Returns the name or the abbreviation of the given month number
   *
   * @return string the name or the abbreviation of the given month number
   */
  public function getFiDateTime(): string {
    $time = $this->date->format('H:i.s');
    $dayName = $this->getFiDate();
    return "$dayName kello $time";
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
  /**
   * 
   * @param  int $timestamp
   * @param  Translator $translator
   * @return self new instance 
   */
  public static function fromString($timestamp ) {
   // return new static(DateTime::("@$timestamp"));
  }

  public function __toString(): string {
    
  }

  public function translate(): string {
    
  }

  public function translateTo(string $lang): string {
    
  }

  public function diff($object, $absolute = null) {
    return $this->date->diff($object, $absolute);
  }

  public function format($format): string {
    return $this->date->format($format);
  }

  public function getOffset() {
    return $this->date->getOffset();
  }

  public function getTimestamp() {
    return $this->date->getTimestamp();
  }

  public function getTimezone(): string {
    return $this->date->getTimezone();
  }

}
