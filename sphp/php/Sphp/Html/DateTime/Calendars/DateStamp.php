<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars;

use Sphp\Html\DateTime\TimeTagInterface;
use Sphp\Html\AbstractComponent;
use Sphp\DateTime\DateTime;
use DateTimeInterface;
use DateTimeImmutable;
use DateTimeZone;

/**
 * Implements a HTML based stamp-element that describes a {@link DateTimeInterface} object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DateStamp extends AbstractComponent implements TimeTagInterface {

  /**
   * the datetime object
   *
   * @var DateTimeInterface 
   */
  private $dateTime;

  /**
   * @var string
   */
  private $format = self::DATE_TIME;

  /**
   * Constructor
   *
   * @param  mixed $datetime optional datetime object (defaults to current date and time)
   * @param  string $format the format of the outputted date string
   * @link   http://www.w3schools.com/tags/att_time_datetime.asp datetime attribute
   */
  public function __construct($datetime = null, string $format = self::DATE_TIME) {
    parent::__construct('time');
    $this->cssClasses()->protectValue('date-icon');
    $this->setFormat($format)->setDatetime($datetime, $format);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->dateTime);
  }

  public function setDateTime($dateTime, string $format = self::DATE_TIME) {
    $this->setFormat($format);
    if (!$dateTime instanceof DateTimeInterface && !$dateTime instanceof DateTime) {
      $dateTime = new DateTime($dateTime);
    }
    $this->dateTime = $dateTime;
    $this->attributes()->setAttribute('datetime', $this->dateTime->format($this->format));
    return $this;
  }

  public function setFormat(string $format = self::DATE_TIME) {
    $this->format = $format;
    return $this;
  }

  public function getFormat(): string {
    return $this->format;
  }

  public function getDateTime(): DateTimeInterface {
    return $this->dateTime;
  }

  public function contentToString(): string {
    $output = '<em>' . $this->dateTime->format('l') . '</em>';
    $output .= '<strong>' . $this->dateTime->format('F') . '</strong>';
    $output .= '<span>' . $this->dateTime->format('j') . '</span>';
    return $output;
  }

  /**
   * Creates a new object from given format
   * 
   * @param  string $time a date/time string
   * @param  DateTimeZone $timezone
   * @return DateStamp optional timezone object
   */
  public static function fromString(string $time = 'now', DateTimeZone $timezone = null): DateStamp {
    $date = new DateTimeImmutable($time, $timezone);
    return new static($date);
  }

}
