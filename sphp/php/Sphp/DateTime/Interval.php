<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use DateInterval;
use Sphp\Stdlib\Strings;

/**
 * Implements a date interval
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Interval extends DateInterval implements IntervalInterface {

  /**
   * Constructor
   * 
   * @param string $interval an interval specification.
   */
  public function __construct(string $interval = 'P0D') {
    if (Strings::startsWith($interval, '-')) {
      $str = Strings::trimLeft($interval, '-');
      parent::__construct($str);
      $this->invert = true;
    } else {
      parent::__construct($interval);
    }
  }

  /**
   * Returns the string representation of the object
   * 
   * @return string the string representation of the object
   */
  public function __toString(): string {
    if ($this->invert === -1) {
      $format = '-P';
    } else {
      $format = 'P';
    }
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

  /**
   * Recalculates the values
   * 
   * @return $this for a fluent interface
   */
  public function recalculate() {
    $seconds = $this->toSeconds();
    $this->y = floor($seconds / 60 / 60 / 24 / 365.2525);
    $seconds -= $this->y * 31536000;
    $this->m = floor($seconds / 60 / 60 / 24 / 30.4167);
    $seconds -= $this->m * 2592000;
    $this->d = floor($seconds / 60 / 60 / 24);
    $seconds -= $this->d * 86400;
    $this->h = floor($seconds / 60 / 60);
    $seconds -= $this->h * 3600;
    $this->i = floor($seconds / 60);
    $seconds -= $this->i * 60;
    $this->s = $seconds;
    return $this;
  }

  public function toSeconds(): float {
    $days = $this->days;
    if ($days === false) {
      $days = floor($this->y * 365.2525);
      $days += floor($this->m * 30.4167);
      $days += $this->d;
    }
    return ($days * 24 * 60 * 60 +
            $this->h * 60 * 60 +
            $this->i * 60 +
            $this->s) * ($this->invert ? -1 : 1);
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

  public function isNegative(): bool {
    return $this->invert === 1;
  }

  public function compareTo($interval) {
    $i = Intervals::create($interval);
    return $this->toSeconds() <=> $i->toSeconds();
  }

  /**
   * 
   * @param DateInterval $interval
   * @return $this for a fluent interface
   */
  public function add(DateInterval $interval) {
    if ($interval->invert) {
      foreach (str_split('ymdhis') as $prop) {
        $this->$prop -= $interval->$prop;
      }
    } else {
      foreach (str_split('ymdhis') as $prop) {
        $this->$prop += $interval->$prop;
      }
    }
    $this->i += (int) ($this->s / 60);
    $this->s = $this->s % 60;
    $this->h += (int) ($this->i / 60);
    $this->i = $this->i % 60;
    return $this;
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

}
