<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews;

use Sphp\DateTime\Calendars\Diaries\Holidays\HolidayInterface;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;
use Sphp\DateTime\Calendars\Diaries\Holidays\BirthDay;
use Sphp\Html\PlainContainer;
use Sphp\Html\Lists\Ul;

/**
 * Implements a holiday log viewer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HolidayLogView {

  public function build(DiaryDate $date): string {
    $output = '';
    if ($date->isHoliday()) {
      $output .= $this->buildSection($date);
    }
    return $output;
  }

  /**
   * Creates a section containing holidays (not birthdays)
   * 
   * @return PlainContainer new instance
   */
  public function buildSection(DiaryDate $date): PlainContainer {
    $section = new PlainContainer();
    //$section->addCssClass('holidays');
    //$section->appendH3('Holidays');
    $days = new Ul();
    foreach ($date->getByType(HolidayInterface::class) as $holiday) {
      $holidayText = $holiday;
      if ($holiday->isFlagDay()) {

        $holidayText .= ViewFactory::flag('finland');
      }
      if ($holiday instanceof BirthDay) {
        $days->append(new Holidays\BirthdayView($holiday, $date->getDate()));
      } else {
        $days->append(new Holidays\HolidayView($holiday));
      }
    }
    $section->append($days);
    return $section;
  }

  /**
   * @var LogViewBuilder|null 
   */
  private static $instance;

  /**
   * Returns a singleton instance of builder
   * 
   * @return LogViewBuilder a singleton instance of builder
   */
  public static function instance(): HolidayLogView {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
