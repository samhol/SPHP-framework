<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Views;

use Sphp\Html\AbstractContent;
use Sphp\Apps\Calendars\Diaries\DiaryDate;
use Sphp\DateTime\ImmutableDate;
use Sphp\Html\Text\Time;
use Sphp\Html\Layout\Div;
use Sphp\Apps\Sports\Workouts\Workout;

/**
 * Class DayView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DayCell extends AbstractContent {

  private DiaryDate $diary;

  public function __construct(DiaryDate $date) {
    $this->diary = $date;
  }

  public function __destruct() {
    unset($this->diary);
  }

  /**
   * Returns a HTML object containing log view for a given day
   * 
   * @return Div containing log view for a given day
   */
  public function build(): Div {
    $div = $this->buildContainer();
    $div->append($this->buildHeading());
    $div->append($this->buildWorkoutInfo());
    return $div;
  }

  protected function buildWorkoutInfo(): Div {
    $div = new Div();
    $workouts = $this->diary->getByType(Workout::class);
    $workoutCount = count($workouts);
    $div->addCssClass('workout-info');
    /* echo '<pre>';
      print_r($workouts);
      echo '</pre>'; */
    if ($workoutCount > 0) {
      $workout = array_pop($workouts);
      $div->append('<strong>+' . $workout->count() . '</strong> <span class="icon"><i class="fas fa-running fa-fw"></i></span>');
    }
    return $div;
  }

  protected function buildContainer(): Div {
    $date = $this->diary->getDate();
    $div = new Div();
    $dayName = strtolower($date->format('l'));
    $weekNumber = $date->getWeek();
    $div->setAttribute('data-week-day', $dayName);
    $div->setAttribute('data-date', $date->format('Y-m-d'));
    $div->setAttribute('data-week', $weekNumber);
    $div->addCssClass('date-cell-content', $dayName);
    if ($this->diary->isNationalHoliday()) {
      $div->addCssClass('holiday');
    }
    if ($date->isCurrentDate()) {
      $div->addCssClass('today');
    }
    if ($date->compareDateTo(ImmutableDate::now()) > 0) {
      $div->addCssClass('future');
    }
    return $div;
  }

  protected function buildHeading(): Time {
    $date = $this->diary->getDate();
    $heading = new Time();
    $heading->setDateTime($date, 'Y-m-d');
    $heading->addCssClass('date-heading');
    $heading->append('<span class="date-number">' . $date->format('j') . '</span>');
    if ($this->diary->notEmpty()) {
      $heading->append('<i class="far fa-flag"></i>');
    }
    if ($this->diary->isFlagDay()) {
      $heading->append(LogViews\ViewFactory::flag('finland'));
    }
    return $heading;
  }

  public function getHtml(): string {
    return $this->build()->getHtml();
  }

}
