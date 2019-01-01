<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews\Holidays;

use Sphp\DateTime\Calendars\Diaries\Holidays\HolidayInterface;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;
use Sphp\DateTime\Calendars\Diaries\Holidays\BirthDay;
use Sphp\Html\Flow\Section;
use Sphp\Html\Lists\Ul;
use Sphp\Html\DateTime\Calendars\LogViews\Holidays\BirthdayView;

/**
 * Implements a holiday log viewer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class HolidayLogView {

  /**
   * @var BirthdayView
   */
  private $birthdayView;

  /**
   * @var HolidayView
   */
  private $holidayView;

  /**
   * Constructor
   * 
   * @param DateInterface $viewedDate
   */
  public function __construct(DateInterface $viewedDate = null) {
    $this->birthdayView = new BirthdayView($viewedDate);
    $this->holidayView = new HolidayView();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->birthdayView, $this->holidayView);
  }

  /**
   * Implements function call
   * 
   * @param DiaryDate $date
   * @return string
   */
  public function __invoke(DiaryDate $date): string {
    return $this->build($date);
  }

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
    $section->addCssClass('holidays');
    //$section->appendH3('Holidays');
    $this->birthdayView->setViewedDate($date->getDate());
   $other = $date->filterLogs(function($log) {
     return !$log instanceof BirthDay;});
    $days = new Ul();
    foreach ($date->getByType(HolidayInterface::class) as $holiday) {
      if ($holiday instanceof BirthDay) {
        $days->append($this->birthdayView->build($holiday));
      } else {
        $days->append($this->holidayView->build($holiday));
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
