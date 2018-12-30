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
use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;
use Sphp\DateTime\Calendars\Diaries\Schedules\Task;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;

/**
 * Description of EventViewBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class EventViewBuilder {

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
    $events = $date->getByType(\Sphp\DateTime\Calendars\Diaries\BasicLog::class);
    //print_R($events);
    $output = new Ul();
    foreach ($events as $event) {
      $output->append($event);
    }

    $tasks = $date->getByType(Task::class);
    if ($tasks->notEmpty()) {
      foreach ($tasks as $task) {
        $output->append($task);
      }
      $acc = new Accordion();
      $acc->appendPane('Tasks', $output);
      return "$acc";
    } else {
      return '';
    }
  }

  /**
   * Builds exercise pane
   * 
   * @param  Exercise $exercise
   * @return Pane exercise pane
   */
  public function buildPane(Exercise $exercise): Pane {
    $pane = new Pane();
    $pane->setPaneTitle($this->buildTitleContent($exercise));
    $pane->append($this->buildContent($exercise));
    return $pane;
  }

  /**
   * Builds a Foundation based accordion component containing the example
   * 
   * @param  Workouts $workouts
   * @return Accordion a Foundation based accordion component containing the example
   */
  public function buildAccordion(Workouts $workouts): Accordion {
    $accordion = new Accordion();
    $accordion->allowAllClosed(true)->allowMultiExpand(true);
    $doer = new WeighhtLiftingPaneBuilder();
    $doer1 = new DistanceAndTimePaneBuilder();
    $doer2 = new TimedExercisePaneBuilder();
    $doer3 = new WorkoutPaneBuilder();
    foreach ($workouts as $exercise) {
      if ($exercise instanceof WeightLiftingExercise) {
        $accordion->append($doer->buildPane($exercise));
      } else if ($exercise instanceof DistanceAndTimeExercise) {
        $accordion->append($doer1->buildPane($exercise));
      } else if ($exercise instanceof TimedExercise) {
        $accordion->append($doer2->buildPane($exercise));
      } else {
        $accordion->append($doer3->buildPane($exercise));
      }
    }
    return $accordion;
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
  public static function instance(): EventViewBuilder {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
