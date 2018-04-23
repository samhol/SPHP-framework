<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Fi;

use Sphp\DateTime\SpecialDays;
use Sphp\DateTime\Holidays\EasterDays;
use Sphp\DateTime\Holidays\Holiday;
use Sphp\DateTime\Date;
use Sphp\DateTime\Holidays\Holidays;
/**
 * Description of FinnishHolidays
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FinnishHolidays extends Holidays {

  public function __construct(int $year) {
    parent::__construct();
    $this->year = $year;
    $this->create();
  }

  protected function create() {
    $this->addHoliday("$this->year-1-1", "New Year's Day");
    $this->addHoliday("$this->year-1-6", 'Epiphany');
    $this->merge(new EasterDays($this->year));
    $this->addHoliday("$this->year-5-1", 'May Day');
    $this->addHoliday("$this->year-12-6", 'Independence Day');
    $this->addHoliday("$this->year-12-24", 'Christmas Eve');
    $this->addHoliday("$this->year-12-25", 'Christmas Day');
    $this->addHoliday("$this->year-12-26", 'Boxing Day');
    $this->addHoliday("$this->year-12-31", "New Year's Eve");
    $j = Date::fromString("$this->year-6-20")->modify('next Saturday');
    $this->addHoliday($j, "Midsummer's Eve");
    $this->add(new MothersDay($this->year));
    $this->add(new FathersDay($this->year));
  }

}
