<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use DateInterval;
use Sphp\Stdlib\Strings;
use Sphp\DateTime\Exceptions\InvalidArgumentException;

/**
 * Implements a date interval
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Interval extends DateInterval implements Duration {

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
    if ($this->isNegative()) {
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

  public function format($format): string {
    return parent::format($format);
  }

  /**
   * Returns the interval as seconds
   * 
   * @return float the interval as seconds
   */
  public function toSeconds(): float {
    $days = $this->days;
    if ($days === false) {
      $days = floor($this->y * 365.2525);
      $days += floor($this->m * 30.4167);
      $days += $this->d;
    }
    $abs = ($days * 24 * 60 * 60 +
            $this->h * 60 * 60 +
            $this->i * 60 +
            $this->s) +
            $this->f;
    if ($this->invert) {
      $out = -$abs;
    } else {
      $out = $abs;
    }
    return $out;
  }

  /**
   * Returns the interval in minutes
   * 
   * @return float the interval in minutes
   */
  public function toMinutes(): float {
    return ($this->toSeconds() / 60);
  }

  /**
   * Returns the interval in minutes
   * 
   * @return float the interval in minutes
   */
  public function toHours(): float {
    return ($this->toMinutes() / 60);
  }

  /**
   * Returns the interval in days
   * 
   * @return float the interval in days
   */
  public function toDays(): float {
    return ($this->toSeconds() / 86400);
  }

  /**
   * Checks if the interval is inverted (negative)
   * 
   * @return bool true if the interval is inverted, false othervise
   */
  public function isNegative(): bool {
    return $this->invert === 1;
  }

  /**
   * 
   * @param  DateInterval $interval
   * @return int
   */
  public function compareTo(Duration $interval): int {
    $i = Intervals::fromDateInterval($interval);
    return $this->toSeconds() <=> $i->toSeconds();
  }

  public function add(DateInterval $interval): Duration {
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

  public function addFromString(string $time): Duration {
    return $this->add(Intervals::create($time));
  }

  public function addSeconds(float $seconds): Duration {
    $interval = new Interval;
    $totalSeconds = $this->toSeconds() + $seconds;
    $interval->f = (float) strstr((string) $totalSeconds, '.');
    $interval->invert = (int) ($totalSeconds < 0);
    $fullSeconds = ($totalSeconds < 0) ? abs(ceil($totalSeconds)) : floor($totalSeconds);
    $interval->d = floor($fullSeconds / 60 / 60 / 24);
    $fullSeconds -= $interval->d * 86400;
    $interval->h = floor($fullSeconds / 60 / 60);
    $fullSeconds -= $interval->h * 3600;
    $interval->i = floor($fullSeconds / 60);
    $fullSeconds -= $interval->i * 60;
    $interval->s = $fullSeconds;
    return $interval;
  }

  public function addMinutes(float $minutes): Duration {
    return $this->addSeconds($minutes * 60);
  }

  public function addHours(float $hours): Duration {
    return $this->addMinutes($hours * 60);
  }

  public function addDays(float $days): Duration {
    return $this->addHours(24 * $days);
  }

  /**
   * 
   * 
   * @param  string $input
   * @return Interval new instance
   * @throws InvalidArgumentException
   */
  public static function createFromDateString($input): Interval {
    $old = error_reporting(null);
    $phpInterval = DateInterval::createFromDateString($input);
    error_reporting($old);
    if ($phpInterval === false) {
      throw new InvalidArgumentException('Cannot parse Interval from given input');
    }
    return Intervals::FromDateInterval($phpInterval);
  }

}
