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

  public function format(string $format): string;

  /**
   * Creates an interval object representing the duraion
   * 
   * @return Interval created instance
   */
  public function toInterval(): Interval;

  public function addFromString(string $time);

  public function add(Duration $d): Duration;

  public function addSeconds(int $seconds): Duration;

  public function addMinutes(float $minutes): Duration;

  public function addHours(float $hours): Duration;

  public function addDays(float $days): Duration;

  public function toSeconds(): float;

  public function toMinutes(): float;

  public function toHours(): float;

  public function toDays(): float;

  public function compareTo($interval): int;
}
