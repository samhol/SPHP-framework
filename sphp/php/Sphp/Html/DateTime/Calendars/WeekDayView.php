<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars;

use Sphp\Html\AbstractComponent;
use Sphp\Html\PlainContainer;
use Sphp\Html\Media\Icons\SvgLoader;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;
use Sphp\Html\Tags;
use Sphp\Html\DateTime\TimeTag;
use Sphp\Html\Foundation\Sites\Grids\Cell;
use Sphp\Html\Foundation\Sites\Grids\ContainerCell;
use Sphp\DateTime\DateInterface;

/**
 * Implements a weekday view for a calendar month
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class WeekDayView extends AbstractComponent {

  /**
   * @var DiaryDate
   */
  private $diaryDay;

  /**
   * Constructor
   * 
   * @param DiaryDate $diaryDate
   */
  public function __construct(DiaryDate $diaryDate) {
    parent::__construct('div');
    $this->diaryDay = $diaryDate;
    $this->setAttributes();
  }

  public function __destruct() {
    unset($this->diaryDay);
    parent::__destruct();
  }

  /**
   * 
   * @return PlainContainer
   */
  private function generateContent(): PlainContainer {
    $date = $this->diaryDay->getDate();
    $content = new PlainContainer;

    $hg = '<div class="grid-x">
     ' . $this->createWeekNumberCell($date) . '<div class="cell auto right-column">' .
            $this->createDateDetails() . '</div></div>';
    $content->append($hg);
    return $content;
  }

  private function createDateDetails() {
    $date = $this->diaryDay->getDate();
    $topCell = new ContainerCell('', ['small-4']);
    if ($this->diaryDay->isFlagDay()) {
      $topCell->appendContent(Tags::span(SvgLoader::fileToObject('/home/int48291/public_html/playground/manual/svg/flags/fi.svg'))->addCssClass('flag'));
    }
    $timeTag = Tags::time($date);
    $timeTag->append(Tags::span($date->format('j'))->addCssClass('day-number'));
    $timeTag->setAttribute('title', $date->format('l jS \of F Y'));
    $dayNumberCell = new ContainerCell($timeTag, ['small-8']);

    $vg = '<div class="grid-y">';
    $vg .= $topCell . $dayNumberCell . '</div>';
    return $vg;
  }

  private function createWeekNumberCell(DateInterface $date): Cell {
    $week = TimeTag::weekNumber($date);
    if ($date->getWeekDay() !== 1) {
      $week->addCssClass('not-monday');
    }
    if ($date->isCurrentWeek()) {
      $week->addCssClass('current-week');
    }
    $cell = ContainerCell::create($week);
    $cell->shrink()->hideOnlyFor('small');
    $cell->addCssClass('left-column');
    return $cell;
  }

  protected function setAttributes() {
    $date = $this->diaryDay->getDate();
    $dayName = strtolower($date->format('l'));
    $weekNumber = $date->getWeek();
    $this->setAttribute('data-week-day', $dayName);
    $this->setAttribute('data-date', $date->format('Y-m-d'));
    $this->setAttribute('data-week', $weekNumber);
    $this->cssClasses()->protectValue('sphp', 'calendar', 'date', $dayName);
    if ($date->isCurrentDate()) {
      $this->cssClasses()->protectValue('today');
    }
    if ($this->diaryDay->notEmpty()) {
      $this->addCssClass('has-info');
      if ($this->diaryDay->isNationalHoliday()) {
        $this->cssClasses()->protectValue('holiday');
      }
      if ($this->diaryDay->isFlagDay()) {
        $this->cssClasses()->protectValue('flag-day');
      }
    }
  }

  public function contentToString(): string {
    return $this->generateContent()->getHtml();
  }

}
