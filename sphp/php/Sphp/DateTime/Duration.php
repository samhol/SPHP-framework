<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

/**
 * Implements a duration
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Duration {

  /**
   * @var int
   */
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
    return "{$this->toInterval()}";
  }

  public function format(string $format): string {
    $interval = $this->toInterval();
    return $interval->format($format);
  }

  /**
   * Recalculates the values
   * 
   * @return Interval created instance
   */
  public function toInterval(): Interval {
    $interval = new Interval();
    $seconds = $this->toSeconds();
    $interval->d = floor($seconds / 60 / 60 / 24);
    $seconds -= $interval->d * 86400;
    $interval->h = floor($seconds / 60 / 60);
    $seconds -= $interval->h * 3600;
    $interval->i = floor($seconds / 60);
    $seconds -= $interval->i * 60;
    $interval->s = $seconds;
    return $interval;
  }

  public function addFromString(string $time) {
    $this->add(static::from($time));
    return $this;
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
    $this->addSeconds($minutes * 60);
    return $this;
  }

  public function addHours(float $hours) {
    $this->addMinutes($hours * 60);
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

  public function getFullHours(): int {
    return floor($this->toHours());
  }

  public function toDays(): float {
    return ($this->toSeconds() / 86400);
  }

  public function getFullDays(): int {
    return floor($this->toDays());
  }

  public function compareTo($interval): int {
    $i = Intervals::create($interval);
    return $this->toSeconds() <=> $i->toSeconds();
  }

  public static function from($time): Duration {
    return new static(Intervals::create($time)->toSeconds());
  }

}
