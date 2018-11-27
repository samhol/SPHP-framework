<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use Sphp\Stdlib\Strings;

/**
 * Implements a date interval
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Duration {

  private $seconds;

  /**
   * Constructor
   * 
   * @param string $seconds an interval specification.
   */
  public function __construct(int $seconds) {
    $this->seconds = $seconds;
  }

  /**
   * Returns the string representation of the object
   * 
   * @return string the string representation of the object
   */
  public function __toString(): string {
    $format = 'P';
    if ($this->y > 0) {
      $format .= $this->y . 'Y';
    }
    if ($this->m > 0) {
      $format .= $this->m . 'M';
    }
    if ($this->d > 0) {
      $format .= $this->d . 'D';
    }
    $time = '';
    if ($this->h > 0) {
      $time .= $this->h . 'H';
    }
    if ($this->i > 0) {
      $time .= $this->i . 'M';
    }
    if ($this->s > 0) {
      $time .= $this->s . 'S';
    }
    if ($time !== '') {
      $format .= "T$time";
    }
    return $format;
  }

  public function add(Duration $d) {
    $this->addSeconds($d->toSeconds());
    return $this;
  }

  public function addSeconds(int $seconds) {
    $this->seconds += $seconds;
    return $this;
  }

  public function addMinutes(int $minutes) {
    $this->seconds += $minutes * 60;
    return $this;
  }

  public function addHours(int $hours) {
    $this->seconds += $hours * 60 * 60;
    return $this;
  }

  /**
   * Recalculates the values
   * 
   * @return $this for a fluent interface
   */
  public function recalculate() {
    $seconds = $this->toSeconds();
    $this->d = floor($seconds / 60 / 60 / 24);
    $seconds -= $this->d * 86400;
    $this->h = floor($seconds / 60 / 60);
    $seconds -= $this->h * 3600;
    $this->i = floor($seconds / 60);
    $seconds -= $this->i * 60;
    $this->s = $seconds;
    return $this;
  }

  public function toSeconds(): int {
    return $this->seconds;
  }

  public function toMinutes(): float {
    return ($this->toSeconds() / 60);
  }

  public function toHours(): float {
    return ($this->toMinutes() / 60);
  }

  public function toDays(): float {
    return ($this->toSeconds() / 86400);
  }

  public function compareTo($interval): int {
    $i = Intervals::create($interval);
    return $this->toSeconds() <=> $i->toSeconds();
  }

  /**
   * 
   * 
   * @param  string $time
   * @return Interval new instance
   */
  public static function createFromDateString($time) {
    $di = parent::createFromDateString($time);
    return Intervals::FromDateInterval($di);
  }

  /**
   * Constructor
   * 
   * @param string $interval an interval specification.
   */
  public static function fromTime(int $hours, int $minutes, int $seconds): Duration {
    $seconds += $hours * 3600 + $minutes * 60;
    return new Duration($seconds);
  }

  public static function fromString(string $time): Duration {
    $parts = explode(':', $time);
    if (count($parts) < 3) {
      $parts = array_unshift($parts, 0);
    }
    return  Duration::fromTime($parts[0], $parts[1], $parts[2]);
  }

}
