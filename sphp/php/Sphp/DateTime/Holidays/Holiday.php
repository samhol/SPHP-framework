<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Holidays;
use Sphp\DateTime\Date;
/**
 * Description of Holiday
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Holiday {

  private $flags;

  /**
   * @var Date 
   */
  private $date;

  /**
   * @var string 
   */
  private $name;

  /**
   *  
   * 
   * @param Date $date 
   * @param string $name
   */
  public function __construct(Date $date, string $name) {
    $this->date = $date;
    $this->name = $name;
  }

  public function getDate(): Date {
    return $this->date;
  }

  public function getName(): string {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  public function equals($date): bool {
    return $this->date->equals($date);
  }

  public function __toString(): string {
    return $this->date->format('l, Y-m-d') . ": " . $this->name;
  }

  public static function from($date, string $name): Holiday {
    if (is_string($date)) {
      return static::fromDateString($date, $name);
    } else if (is_int($date)) {
      return static::fromTimestamp($date, $name);
    } else if ($date instanceof Date) {
      return new static($date, $name);
    }
  }

  public static function fromTimestamp(int $unixtimestamp, string $name): Holiday {
    return new static(Date::fromTimestamp($unixtimestamp), $name);
  }

  public static function fromDateString(string $dateString, string $name): Holiday {
    return new static(Date::fromString($dateString), $name);
  }

  public function setFlags() {
    
  }

}
