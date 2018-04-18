<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use DateTimeInterface;
use DateTimeImmutable;

/**
 * Description of DateTimeWrapper
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DateTimeWrapper {

  /**
   * @var DateTimeInterface 
   */
  private $dateTime;

  public function __construct(DateTimeInterface $dateTime = null) {
    if ($dateTime === null) {
      $dateTime = new DateTimeImmutable();
    }
    $this->dateTime = $dateTime;
  }

  public function getWeekDay(): int {
    return (int) $this->dateTime->format('N');
  }

  public function getWeekDayName(): string {
    return $this->dateTime->format('l');
  }

  public function getMonth(): int {
    return (int) $this->dateTime->format('m');
  }

  public function getMonthName(): string {
    return $this->dateTime->format('F');
  }

  public function getMonthDay(): int {
    return (int) $this->dateTime->format('j');
  }

  public function getYear(): int {
    return (int) $this->dateTime->format('Y');
  }

  public function format(string $format): string {
    return $this->dateTime->format($format);
  }

}
