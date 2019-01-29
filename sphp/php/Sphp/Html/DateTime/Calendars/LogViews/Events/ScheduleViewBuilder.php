<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews\Events;

use Sphp\DateTime\Calendars\Diaries\Holidays\BirthDay;
use Sphp\DateTime\DateInterface;
use Sphp\DateTime\Date;
use Sphp\Html\Lists\Ul;
use Sphp\Html\DateTime\Calendars\LogViews\ViewFactory;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;
use Sphp\Html\Foundation\Sites\Containers\Accordions\ContentPane;
use Sphp\DateTime\Calendars\Diaries\Schedules\Task;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;
use Sphp\Html\Flow\Section;

/**
 * Description of EventViewBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ScheduleViewBuilder {

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
    //$this->birthdayView = new BirthdayView($viewedDate);
    //$this->holidayView = new HolidayView();
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
    return $this->buildSectionFor($date);
  }

  public function buildSectionFor(DiaryDate $date): string {
    $tasks = $date->getByType(Task::class);
    if ($tasks->notEmpty()) {
      $section = new Section();
      $section->addCssClass('group', 'tasks');
      $output = new Ul();
      $section->appendH3('Tasks:');
      $section->append($output);
      foreach ($tasks as $task) {
        $output->append($task);
      }
      //$acc = new Accordion();
      //$acc->appendPane('Tasks', $output);
      return "$section";
    } else {
      return '';
    }
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
  public static function instance(): ScheduleViewBuilder {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
