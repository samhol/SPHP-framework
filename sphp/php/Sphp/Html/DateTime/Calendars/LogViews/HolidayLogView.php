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
use Sphp\Html\Media\Icons\Svg;

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
   * @return Section new instance
   */
  public function buildSection(DiaryDate $date): Section {
    $section = new Section();
    if ($date->isFlagDay()) {
      $section->addCssClass('flag-day');
    }
    $section->addCssClass('holidays');
    //$section->addCssClass('holidays');
    $birthDays = new Ul();
    $otherHolidays = new Ul();
    $birthday = $other = false;
    foreach ($date->getByType(HolidayInterface::class) as $holiday) {
      $holidayText = $holiday;
      if ($holiday->isFlagDay()) {
        $holidayText .= '<div class="flag" style="width:20px; display:inline-block; margin-left:6px;">' . Svg::fromUrl('http://data.samiholck.com/svg/flags/finland.svg') . "</div>";
      }
      if ($holiday instanceof BirthDay) {
        $birthDays->append($holidayText);
        $birthday = true;
      } else {
        $otherHolidays->append($holidayText);
        $other = true;
      }
    }
    if ($other) {
      $section->appendH3('Holidays');
      $section->append($otherHolidays);
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
