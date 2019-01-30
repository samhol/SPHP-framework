<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n\Datetime;

use Sphp\Config\Locale;
use DateTimeInterface;
use DateTime as PHPDateTime;
use IntlDateFormatter;
use DateTimeZone;

/**
 * Class localizes weekday and month names
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DateTime {

  /**
   * @var DateTimeInterface
   */
  private $date;

  /**
   * @var IntlDateFormatter
   */
  private $fmt;

  /**
   * Constructor
   * 
   * @param DateTimeInterface|null $dateTime
   */
  public function __construct(DateTimeInterface $dateTime = null) {
    if ($dateTime === null) {
      $dateTime = new PHPDateTime();
    }
    $this->setDate($dateTime);
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
   * Returns the name or the abbreviation of the weekday
   *
   * @param  int $length optional length of the result string
   * @param  string $lang optional name of the language used for translations
   * @return string the name or the abbreviation of the weekday
   */
  public function getWeekdayName(int $length = 0, string $lang = null): string {
    $day = $this->strftime('%A', $lang);
    if ($length > 0) {
      $day = mb_substr($day, 0, $length);
    }
    return $day;
  }

  /**
   * Returns the name or the abbreviation of the month
   *
   * @param  int $length optional length of the result string
   * @param  string $lang optional name of the language used for translations
   * @return string the name or the abbreviation of the month
   */
  public function getMonthName(int $length = 0, string $lang = null): string {
    $monthName = $this->strftime('%B', $lang);
    if ($length > 0) {
      $monthName = mb_substr($monthName, 0, $length);
    }
    return $monthName;
  }

  /**
   * Sets the class used for ICU date formatting functionality
   * 
   * @param IntlDateFormatter $fmt the class used for ICU date formatting functionality
   */
  public function setIntlDateFormatter(IntlDateFormatter $fmt) {
    $this->fmt = $fmt;
  }

  public function getIntlFormatter(): IntlDateFormatter {
    if ($this->fmt === null) {
      $this->fmt = new IntlDateFormatter(
              null, IntlDateFormatter::FULL, IntlDateFormatter::FULL, $this->getTimezone(), IntlDateFormatter::GREGORIAN
      );
    }
    return $this->fmt;
  }

  /**
   * ICU stands for: International Components for Unicode
   * 
   * @param  string $format
   * @param  string $lang optional name of the language used for translations
   * @return string
   * @link   http://userguide.icu-project.org/formatparse/datetime#TOC-Date-Time-Format-Syntax Internationalization patterns
   */
  public function formatICU(string $format, string $lang = null): string {
    if ($lang === null) {
      $lang = Locale::getDatetimeLocale();
    }
    $fmt = new IntlDateFormatter(
            $lang, IntlDateFormatter::FULL, IntlDateFormatter::FULL, $this->getTimezone(), IntlDateFormatter::GREGORIAN, $format
    );
    return $fmt->format($this->date);
  }

  /**
   * Returns a formatted string 
   * 
   * @param  string $format
   * @param  string $lang optional name of the language used for translations
   * @return string a formatted string 
   */
  public function strftime(string $format, string $lang = null): string {
    $oldLang = Locale::getDatetimeLocale();
    if ($lang === null) {
      $lang = $oldLang;
    }
    if ($lang !== $oldLang) {
      Locale::setLocale(LC_TIME, $lang);
    }
    $output = strftime($format, $this->getTimestamp());
    if ($lang !== $oldLang) {
      Locale::setLocale(LC_TIME, $oldLang);
    }
    return $output;
  }

  public function __toString(): string {
    return $this->date->format('Y-m-d H:i:s, T');
  }

  /**
   * Returns the week of year
   * 
   * @return int the week of year
   */
  public function getWeekOfYear(): int {
    return $this->formatICU('w');
  }

  public function diff($object, $absolute = null) {
    return $this->date->diff($object, $absolute);
  }

  /**
   * Returns the date formatted according to given format
   * 
   * @param  string $format the format of the outputted date string
   * @return string a formatted date string
   * @link   http://php.net/manual/en/function.date.php#refsect1-function.date-parameters formatting options
   */
  public function format(string $format): string {
    return $this->date->format($format);
  }

  /**
   * Returns the time zone offset
   * 
   * @return int the time zone offset
   */
  public function getOffset(): int {
    return $this->date->getOffset();
  }

  /**
   * Returns the Unix timestamp
   * 
   * @return int the Unix timestamp
   */
  public function getTimestamp(): int {
    return $this->date->getTimestamp();
  }

  /**
   * Return time zone relative to given DateTime
   * 
   * @return DateTimeZone time zone relative to given DateTime
   */
  public function getTimezone(): DateTimeZone {
    return $this->date->getTimezone();
  }

  /**
   * 
   * @param  int $timestamp
   * @param  DateTimeZone $timezone
   * @return DateTime new instance 
   */
  public static function fromTimestamp(int $timestamp, DateTimeZone $timezone = null): DateTime {
    return new static(new PHPDateTime("@$timestamp"), $timezone);
  }

  /**
   * 
   * @param  string $time the format that the passed in string should be in
   * @param  DateTimeZone $timezone
   * @return DateTime new instance 
   */
  public static function fromString(string $time = 'now', DateTimeZone $timezone = null): DateTime {
    return new static(new PHPDateTime($time, $timezone));
  }

  /**
   * 
   * **NOTE:** If time zone is omitted and time contains no time zone, the current time zone will be used.
   * 
   * @param  string $format
   * @param  string $time
   * @param  DateTimeZone $timezone
   * @return DateTime new instance 
   * @link   http://php.net/manual/en/datetime.createfromformat.php#refsect1-datetime.createfromformat-parameters
   */
  public static function fromFormat(string $format, string $time, DateTimeZone $timezone = null): DateTime {
    return new static(PHPDateTime::createFromFormat($format, $time, $timezone));
  }

}
