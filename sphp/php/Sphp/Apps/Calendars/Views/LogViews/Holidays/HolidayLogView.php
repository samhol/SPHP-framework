<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Views\LogViews\Holidays;

use Sphp\Apps\Calendars\Diaries\DiaryDate;
use Sphp\Apps\Calendars\Diaries\Holidays\BirthDay;
use Sphp\Html\Layout\Section;
use Sphp\Html\Lists\Ul;
use Sphp\Apps\Calendars\Diaries\BasicLog;

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
   * @param Date  $viewedDate
   */
  public function __construct(Date $viewedDate = null) {
    $this->birthdayView = new BirthdayView($viewedDate);
    $this->holidayView = new HolidayView();
    $this->logView = new LogView();
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
    return (string) $this->buildSection($date);
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
    //print_r($date);
    $days = new Ul();
    foreach ($date->getByType(\Sphp\Apps\Calendars\Diaries\Log::class) as $holiday) {

      if ($holiday instanceof BirthDay) {
        $days->append($this->birthdayView->build($holiday));
      } else if ($holiday instanceof \Sphp\Apps\Calendars\Diaries\Holidays\Holiday) {
        $days->append($this->holidayView->build($holiday));
      } else if ($holiday instanceof BasicLog) {
        $days->append($this->logView->build($holiday));
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
