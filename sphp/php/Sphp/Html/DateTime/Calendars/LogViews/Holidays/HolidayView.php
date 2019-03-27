<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews\Holidays;

use Sphp\DateTime\Calendars\Diaries\Holidays\Holiday;
use Sphp\Html\DateTime\Calendars\LogViews\ViewFactory;
use Sphp\Html\Tags;

/**
 * Implements a holiday view builder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class HolidayView {

  /**
   * Implements function call
   * 
   * @param  Holiday $holiday
   * @return string
   */
  public function __invoke(Holiday $holiday): string {
    return $this->build($holiday);
  }

  /**
   * Creates a section containing holidays (not birthdays)
   * 
   * @param  Holiday $holiday
   * @return string
   */
  public function build(Holiday $holiday): string {
    $strong = Tags::span($holiday->getName())->addCssClass('strong');
    $description = Tags::span(' ' . $holiday->getDescription());
    //$output .= $this->getDate()->format('l, Y-m-d');
    if ($holiday->isNationalHoliday()) {
      $description->append(" (national holiday)");
    }
    if ($holiday->isFlagDay()) {
      $strong->prepend(ViewFactory::flag('fi'));
    }
    return $strong . $description;
  }

}
