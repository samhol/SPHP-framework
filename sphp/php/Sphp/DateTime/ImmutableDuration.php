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
 * Implements an immutable duration of time
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ImmutableDuration implements Duration {

  /**
   * @var int
   */
  private $seconds;

  /**
   * Constructor
   * 
   * @param int $seconds length of the duration
   */
  public function __construct(int $seconds = 0) {
    $this->seconds = $seconds;
  }

  public function __toString(): string {
    return "{$this->toInterval()}";
  }

  public function format(string $format): string {
    $interval = $this->toInterval();
    return $interval->format($format);
  }

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

  public function addFromString(string $time): Duration {
    return $this->add(static::from($time));
  }

  public function add(Duration $d): Duration {
    return $this->addSeconds($d->toSeconds());
  }

  public function addSeconds(int $seconds): Duration {
    return new static($this->seconds + $seconds);
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

  public function compareTo($duration): int {
    try {
      return $this->toSeconds() <=> static::from($duration)->toSeconds();
    } catch (\Exception $ex) {
      throw new InvalidArgumentException('the duration cannot be parsed from input', $ex->getCode(), $ex);
    }
  }

  /**
   * 
   * @param  mixed $time
   * @return ImmutableDuration
   */
  public static function from($time): ImmutableDuration {
    return new static(Intervals::create($time)->toSeconds());
  }

}
