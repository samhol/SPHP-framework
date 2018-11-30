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
 * Defines a duration of time
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Duration {

  /**
   * Returns the string representation of the object
   * 
   * @return string the string representation of the object
   */
  public function __toString(): string;

  /**
   * Formats the Duration
   * 
   * @param string $format
   * @return string the formatted duration
   */
  public function format(string $format): string;

  /**
   * Creates an interval object representing the duration
   * 
   * @return Interval created instance
   */
  public function toInterval(): Interval;

  /**
   * Adds duration from string to the duration
   * 
   * @param  string $time
   * @return Duration new immutable instance
   */
  public function addFromString(string $time): Duration;

  /**
   * Adds another duration object to the duration
   * 
   * @param  Duration $d the duration to add
   * @return Duration new immutable instance
   */
  public function add(Duration $d): Duration;

  /**
   * Adds seconds to the duration
   * 
   * @param  int $seconds the seconds to add
   * @return Duration new immutable instance
   */
  public function addSeconds(int $seconds): Duration;

  /**
   * Adds minutes to the duration
   * 
   * @param  float $minutes the seconds to add
   * @return Duration new immutable instance
   */
  public function addMinutes(float $minutes): Duration;

  /**
   * Adds hours to the duration
   * 
   * @param  float $hours the hours to add
   * @return Duration new immutable instance
   */
  public function addHours(float $hours): Duration;

  /**
   * Adds days to the duration
   * 
   * @param  float $days the days to add
   * @return Duration new immutable instance
   */
  public function addDays(float $days): Duration;

  /**
   * Converts the duration to seconds
   * 
   * @return float duration as seconds
   */
  public function toSeconds(): float;

  /**
   * Converts the duration to minutes
   * 
   * @return float duration as minutes
   */
  public function toMinutes(): float;

  /**
   * Converts the duration to hours
   * 
   * @return float duration as hours
   */
  public function toHours(): float;

  /**
   * Converts the duration to days
   * 
   * @return float duration as days
   */
  public function toDays(): float;

  /**
   * Returns the difference between this and another duration
   * 
   * @param  mixed $duration duration data
   * @return int the difference
   * @throws InvalidArgumentException if duration cannot be parsed from input
   */
  public function compareTo($duration): int;
}
