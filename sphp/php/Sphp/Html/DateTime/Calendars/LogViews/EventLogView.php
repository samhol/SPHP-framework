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
use Sphp\Html\Flow\Section;
use Sphp\Html\Lists\Ul;

/**
 * Implements a holiday log viewer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class EventLogView {

  /**
   * @var DiaryDate 
   */
  private $date;

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
   * @return Section new instance
   */
  public function buildSection(DiaryDate $date): Section {
    $section = new Section();
    //$section->addCssClass('holidays');
    $birthDays = new Ul();
    $otherHolidays = new Ul();
    $birthday = $other = false;
    foreach ($date->getByType(HolidayInterface::class) as $holiday) {
      if ($holiday instanceof BirthDay) {
        $birthDays->append($holiday);
        $birthday = true;
      } else {
        $otherHolidays->append($holiday);
        $other = true;
      }
    }
    if ($other) {
      $section->appendH3('Holidays');
      $section->append($otherHolidays);
      $section->addCssClass('holidays');
    }
    if ($birthday) {
      $section->appendH3('Birthdays');
      $section->append($birthDays);
      $section->addCssClass('birthdays');
    }
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
