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
  public function __construct(int $seconds = 0) {
    $this->seconds = $seconds;
  }

  /**
   * Returns the string representation of the object
   * 
   * @return string the string representation of the object
   */
  public function __toString(): string {
    $format = 'PT' . $this->seconds . 'S';
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

  public function addMinutes(float $minutes) {
    $this->seconds += $minutes * 60;
    return $this;
  }

  public function addHours(float $hours) {
    $this->seconds += $hours * 60 * 60;
    return $this;
  }

  public function addDays(float $days) {
    $this->addHours(24 * $days);
    return $this;
  }

  public function toSeconds(): float {
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

  public static function from($time): Duration {
    return new static(Intervals::create($time)->toSeconds());
  }

}
