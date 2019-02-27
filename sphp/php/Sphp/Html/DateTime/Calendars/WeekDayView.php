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

  /**
   * 
   * @return PlainContainer
   */
  private function generateContent(): PlainContainer {
    $content = new PlainContainer;
    $date = $this->diaryDay->getDate();

    $timeTag = Tags::time($this->diaryDay->getDate()->getDateTime());
    if ($this->diaryDay->notEmpty()) {
      if ($this->diaryDay->isFlagDay()) {
        $timeTag->append(Tags::span(SvgLoader::fileToObject('/home/int48291/public_html/playground/manual/svg/flags/fi.svg'))->addCssClass('flag'));
      }
    }
    $timeTag->append(Tags::span($this->diaryDay->getDate()->format('j'))->addCssClass('day-number'));
    $timeTag->setAttribute('title', $this->diaryDay->getDate()->format('l jS \of F Y'));
    //$verticalGrid = Tags::div()->addCssClass('grid-y')->inlineStyles('height', '90px');
    //$verticalGrid->append(new \Sphp\Html\Foundation\Sites\Grids\DivCell($this->diaryDay->getDate()->format('j'),['small-4']));
    $vg = '<div class="grid-y">
  <div class="cell small-4">' .
            $date->format('j')
            . '</div><div class="cell small-8">
' . $timeTag . '</div></div>';
    $hg = '<div class="grid-x cont">
      <div class="cell shrink show-for-medium left-column">';
    $week = TimeTag::weekNumber($date);
    if ($date->getWeekDay() !== 1) {
      $week->addCssClass('not-monday');
    }
    if ($date->isCurrentWeek()) {
      $week->addCssClass('current-week');
    }
    $hg .= $week . '</div><div class="cell auto">' .
            $vg . '</div></div>';
    $content->append($hg);
    return $content;
    $leftCol = Tags::div()->addCssClass('left-column', 'show-for-medium');
    if ($date->getWeekDay() === 1) {
      $leftCol->append($this->diaryDay->getDate()->getWeek());
    }
    $content->append($leftCol);

    $content->append($timeTag);
    $content->append($this->createIcons());
    return $content;
  }

  /**
   * 
   * @return PlainContainer
   */
  private function generateContent1(): PlainContainer {
    $content = new PlainContainer;
    $date = $this->diaryDay->getDate();
    $leftCol = Tags::div()->addCssClass('left-column', 'show-for-medium');
    if ($date->getWeekDay() === 1) {
      $leftCol->append($this->diaryDay->getDate()->getWeek());
    }
    $content->append($leftCol);
    $timeTag = Tags::time($this->diaryDay->getDate()->getDateTime());
    if ($this->diaryDay->notEmpty()) {
      if ($this->diaryDay->isFlagDay()) {
        $timeTag->append(Tags::span(SvgLoader::fileToObject('/home/int48291/public_html/playground/manual/svg/flags/fi.svg'))->addCssClass('flag'));
      }
    }
    $timeTag->append(Tags::span($this->diaryDay->getDate()->format('j'))->addCssClass('day-number'));
    $timeTag->setAttribute('title', $this->diaryDay->getDate()->format('l jS \of F Y'));
    $content->append($timeTag);
    $content->append($this->createIcons());
    return $content;
  }

  public function createIcons() {
    $div = Tags::div();
    $div->addCssClass('icons');

    if ($this->diaryDay->notEmpty()) {
      $div->append(\Sphp\Html\Media\Icons\FA::flag()->setSize('xs'));
      if ($this->diaryDay->isFlagDay()) {
        $div->append('<i class="flag svg-inline--fa fa-w-16">' . SvgLoader::fileToObject('/home/int48291/public_html/playground/manual/svg/flags/fi.svg') . '</i>');
      }
    }
    return $div;
  }

  protected function setAttributes() {
    $date = $this->diaryDay->getDate();
    $dayName = strtolower($date->format('l'));
    $weekNumber = $date->getWeek();
    $this->setAttribute('data-week-day', $dayName);
    $this->setAttribute('data-date', $date->format('Y-m-d'));
    $this->setAttribute('data-week', $weekNumber);
    $this->cssClasses()->protectValue('sphp', 'calendar-day', $dayName);
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
