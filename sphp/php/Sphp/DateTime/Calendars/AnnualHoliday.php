<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars;

use Sphp\DateTime\DateInterface;
use Sphp\DateTime\Exceptions\DateTimeException;

/**
 * Implements a holiday note for a calendar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class AnnualHoliday extends AbstractHoliday implements AnnualNote {

  /**
   * @var int 
   */
  private $day, $month;

  /**
   * Constructor
   * 
   * @param DateInterface $date 
   * @param string $name
   */
  public function __construct(int $month, int $day, string $name) {
    parent::__construct($name);
    $this->day = $day;
    $this->month = $month;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->day, $this->month);
    parent::__destruct();
  }

  public function getMonthDay(): int {
    return $this->day;
  }

  public function getMonth(): int {
    return $this->month;
  }

  public function dateMatchesWith(DateInterface $date): bool {
    return $this->month === $date->getMonth() && $this->day === $date->getMonthDay();
  }

  public function __toString(): string {
    $output = $this->noteAsString();
    return $output;
  }

  /**
   * Creates a new instance from a date string
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @param  string $name name of the holiday 
   * @return Holiday new instance
   * @throws DateTimeException if creation fails
   */
  public static function from(int $month, int $day, string $name): AnnualHoliday {
    try {
      return new static($month, $day, $name);
    } catch (\Exception $ex) {
      throw new DateTimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

}
