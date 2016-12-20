<?php

/**
 * Datetime.php (UTF-8)
 * Copyright (c) 2008 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Types;

use DateTimeZone;
use Sphp\Core\Comparable;

/**
 * Representation of date and time
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2008-05-22
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @link    http://www.php.net/manual/en/class.datetime.php The DateTime class (PHP manual)
 * @filesource
 */
class Datetime extends \DateTime implements Comparable {

  /**
   * describes the format of the Finnish date
   */
  const FI_DATE = 'd.m.Y';

  /**
   * describes the format of the SQL-formatted datetime
   */
  const SQL_DATETIME = 'Y-m-j H:i:s';

  /**
   * Constructs a new instance of the {@link self} object
   *
   * @param  string $time a date/time string
   * @param  \DateTimeZone $timezone an object representing the timezone of $time
   * @link   http://www.php.net/manual/en/datetime.construct.php DateTime::__construct (PHP manual)
   * @link   http://www.php.net/manual/en/class.datetimezone.php The DateTimeZone class (PHP manual)
   */
  function __construct($time = 'now', DateTimeZone $timezone = null) {
    if (is_numeric($time)) {
      $time = date('Y-m-d H:i:s', $time);
    }
    parent::__construct($time, $timezone);
  }

  /**
   * Returns the month name
   * 
   * @return string the month name
   */
  public function getMonthName() {
    return $this->format('F');
  }

  /**
   * Returns the weekday name
   * 
   * @return string the weekday name
   */
  public function getWeekdayName() {
    return $this->format('l');
  }

  /**
   * Compares this datetime object to another one
   *
   * 1. RESULT == 1: $other->getTimestamp() &lt; $this->getTimestamp()
   * 2. RESULT == -1: $other->getTimestamp() &gt; $this->getTimestamp()
   * 3. RESULT == 0: $other->equals($this)
   * 
   * @param  mixed $other compared object
   * @return int result of the comparison
   * @throws \InvalidArgumentException if the <var>$other</var> is not instance of {@link \DateTime}
   */
  public function compareTo($other) {
    if (!($other instanceof Datetime)) {
      throw new \InvalidArgumentException('Compared instance mustbe of type ' . Datetime::class);
    }
    if ($this->equals($other)) {
      return 0;
    }
    $div = $this->getTimestamp() - $other->getTimestamp();
    if ($div > 0) {
      return 1;
    } else {
      return -1;
    }
  }

  /**
   * Checks whether the datetime is in the past
   * 
   * @return boolean true if the datetime is in the past, false otherwise
   */
  public function past() {
    return $this->compareTo(new Datetime()) < 0;
  }

  /**
   * Checks whether the datetime is the current datetime
   * 
   * @return boolean true if the datetime is the current datetime, false otherwise
   */
  public function now() {
    return $this->compareTo(new Datetime()) === 0;
  }

  /**
   * Checks whether the datetime is in the future
   * 
   * @return boolean true if the datetime is in the future, false otherwise
   */
  public function future() {
    return $this->compareTo(new Datetime()) > 0;
  }

  /**
   * Returns object as a datetime string
   *
   * **Note:** PHP formatting string used for outputting is "Y-m-d H:i:s T"
   *
   * @return string object as a datetime string
   */
  public function __toString() {
    return $this->format('Y-m-d H:i:s T');
  }

  /**
   * Returns object as a datetime string
   *
   * **Note:** PHP formatting string used for outputting is "Y-m-d H:i:s T"
   * 
   * @return string as a datetime string
   */
  public function toScalar() {
    return $this->format('Y-m-d H:i:s T');
  }

  public function equals($object) {
    return $object == $this;
  }

}
