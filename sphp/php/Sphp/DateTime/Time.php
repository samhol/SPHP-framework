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

use Sphp\DateTime\Exceptions\InvalidArgumentException;

/**
 * Implements a time of a day 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Time {

  private int $h;
  private int $m;
  private float $s;
  private int $u = 0;

  /**
   * Constructor
   * 
   * @param int $hours
   * @param int $minutes
   * @param float $seconds
   */
  public function __construct(int $hours, int $minutes, float $seconds = 0) {
    $this->setHours($hours)->setMinutes($minutes)->setSeconds($seconds);
  }

  public function __toString(): string {
    $out = sprintf('%02d:%02d', $this->h, $this->m);
    if ($this->s > 0) {
      $out .= sprintf(':%02d', (int) $this->s);
      if ($this->u > 0) {
        $out .= sprintf('.%d', (int) $this->u);
      }
    }
    return $out;
  }

  /**
   * Sets the hours
   * 
   * @param int $hours the hours
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if 0 <= $hours < 24
   */
  public function setHours(int $hours) {
    if (0 > $hours || $hours > 23) {
      throw new InvalidArgumentException("Hours must be between 0-23 ($hours given)");
    }
    $this->h = $hours;
    return $this;
  }

  /**
   * Sets the minutes
   * 
   * @param  int $minutes the minutes
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if 0 <= $minutes < 60
   */
  public function setMinutes(int $minutes) {
    if (0 > $minutes || $minutes > 59) {
      throw new InvalidArgumentException("Minutes must be between 0-59 ($minutes given)");
    }
    $this->m = $minutes;
    return $this;
  }

  /**
   * Sets the seconds
   * 
   * @param  int $seconds
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if 0 <= $seconds < 60
   */
  public function setSeconds(float|int $seconds) {
    if (0 > $seconds || $seconds >= 60) {
      throw new InvalidArgumentException("Seconds must be between 0-59 ($seconds given)");
    }
    $this->s = $seconds;
    $decimal = strrchr((string) $this->s, '.');
    if ($decimal !== false) {
      $this->u = (int) str_replace('.', '', $decimal);
    }
    return $this;
  }

  public function getHours(): int {
    return $this->h;
  }

  public function getMinutes(): int {
    return $this->m;
  }

  public function getSeconds(): float {
    return $this->s;
  }

  public function getMicroSeconds(): int {
    return $this->u;
  }

  /**
   * 
   * @param  mized $input
   * @return Time
   * @throws InvalidArgumentException if the input parameter cannot be converted to a time object
   */
  public static function from($input = null): Time {
    if ($input === null) {
      $input = new \DateTimeImmutable();
    }
    if (is_string($input)) {
      $out = static::fromString($input);
    } else if ($input instanceof \DateTimeInterface || $input instanceof DateInterface) {
      $out = new static((int) $input->format('H'), (int) $input->format('i'), (float) $input->format('s.u'));
    } else {
      throw new InvalidArgumentException("Invalid string given");
    }
    return $out;
  }

  /**
   * 
   * @param  string $input
   * @return Time
   * @throws InvalidArgumentException if the input parameter cannot be converted to a time object
   */
  public static function fromString(string $input): Time {
    $parts = explode(':', $input);
    $lenght = count($parts);
    if ($lenght > 3) {
      throw new InvalidArgumentException("Invalid input string ($input)");
    }
    $params = [];
    foreach ($parts as $index => $value) {
      if (!is_numeric($value)) {
        throw new InvalidArgumentException("Invalid input string part ($value)");
      }
      if ($index < 2) {
        $value = (int) $value;
      } else if ($index === 2) {
        $value = (float) $value;
      }
      $params[$index] = $value;
    }
    return new static(...$params);
  }

}
