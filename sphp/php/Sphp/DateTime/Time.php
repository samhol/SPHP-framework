<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements a time of a day 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Time {

  private $hours, $minutes, $seconds;

  /**
   * Constructor
   * 
   * @param int $hours
   * @param int $minutes
   * @param int $seconds
   */
  public function __construct(int $hours = 0, int $minutes = 0, int $seconds = 0) {
    $this->setHours($hours)->setMinutes($minutes)->setSeconds($seconds);
  }

  public function __toString(): string {
    $output = sprintf("%s:%02d", $this->hours, $this->minutes);
    if ($this->seconds > 0) {
      $output .= sprintf("%02d", $this->seconds);
    }
    return $output;
  }

  /**
   * Sets the hours
   * 
   * @param int $hours the hours
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the hours are invalid
   */
  public function setHours(int $hours) {
    if (0 > $hours || $hours > 23) {
      throw new InvalidArgumentException("Hours must be between 0-23 ($hours given)");
    }
    $this->hours = $hours;
    return $this;
  }

  /**
   * Sets the minutes
   * 
   * @param  int $minutes the minutes
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function setMinutes(int $minutes) {
    if (0 > $minutes || $minutes > 59) {
      throw new InvalidArgumentException("Minutes must be between 0-59 ($minutes given)");
    }
    $this->minutes = $minutes;
    return $this;
  }

  /**
   * Sets the seconds
   * 
   * @param  int $seconds
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function setSeconds(int $seconds) {
    if (0 > $seconds || $seconds > 59) {
      throw new InvalidArgumentException("Seconds must be between 0-59 ($seconds given)");
    }
    $this->seconds = $seconds;
    return $this;
  }

  public function getHours(): int {
    return $this->hours;
  }

  public function getMinutes(): int {
    return $this->minutes;
  }

  public function getSeconds(): int {
    return $this->seconds;
  }

  public static function from(string $time = null): Time {
    $pats = explode(':', $time);
    $lenght = count($pats);
    if ($lenght === 2) {
      return new static((int) $pats[0], (int) $pats[1]);
    } else if ($lenght === 3) {
      return new static((int) $pats[0], (int) $pats[1], (int) $pats[2]);
    }
  }

}
