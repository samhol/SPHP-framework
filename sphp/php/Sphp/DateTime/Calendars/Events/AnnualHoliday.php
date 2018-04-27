<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events;

use Sphp\DateTime\DateInterface;

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
   * @param  DateInterface $date 
   * @param  string $name
   * @throws Exceptions\NoteException if constructor fails
   */
  public function __construct(int $month, int $day, string $name) {
    parent::__construct($name);
    if (0 > $month || $month > 12) {
      throw new Exceptions\NoteException("Parameter month must be between 1-12 ($month given)");
    } if (0 > $day || $day > 31) {
      throw new Exceptions\NoteException("Parameter day must be between 1-31 ($day given)");
    }
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


  /**
   * Creates a new instance from a date string
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @param  string $name name of the holiday 
   * @return Holiday new instance
   * @throws Exceptions\NoteException if creation fails
   */
  public static function from(int $month, int $day, string $name): AnnualHoliday {
    return new static($month, $day, $name);
  }

}
