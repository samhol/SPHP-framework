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
use Sphp\Html\DateTime\TimeTag;
use Sphp\Html\Media\Icons\Svg;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;

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
    $leftCol = new \Sphp\Html\Div();
    $leftCol->addCssClass('left-column', 'show-for-medium');
    if ($date->getWeekDay() === 1) {
      $leftCol->append($this->diaryDay->getDate()->getWeek());
    } 
    $content->append($leftCol);
    $timeTag = new TimeTag($this->diaryDay->getDate()->getDateTime());
    if ($this->diaryDay->notEmpty()) {
     
      //$content->append(\Sphp\Html\Media\Icons\FA::flag()->setSize('xs')->pull('left')->addCssClass('fa-border'));
      if ($this->diaryDay->isFlagDay()) {
        //$timeTag->append('<span class="flag">' . Svg::fromUrl('http://data.samiholck.com/svg/flags/finland.svg') . '</span>');
      }
    }
    $timeTag->append($this->diaryDay->getDate()->format('j'));
    $timeTag->setAttribute('title', $this->diaryDay->getDate()->format('l jS \of F Y'));
    $content->append($timeTag);
    $content->append($this->createIcons());
    return $content;
  }

  public function createIcons() {
    $div = new \Sphp\Html\Div();
    $div->addCssClass('icons');

    if ($this->diaryDay->notEmpty()) {
      $div->append(\Sphp\Html\Media\Icons\FA::flag()->setSize('xs'));
      if ($this->diaryDay->isFlagDay()) {
        $div->append('<i class="flag svg-inline--fa fa-w-16">' . Svg::fromUrl('http://data.samiholck.com/svg/flags/finland.svg') . '</i>');
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
    $this->cssClasses()->protect('sphp', 'calendar-day', $dayName);
    if ($date->isCurrentDate()) {
      $this->cssClasses()->protect('today');
    }
    if ($this->diaryDay->notEmpty()) {
      $this->addCssClass('has-info');
      if ($this->diaryDay->isNationalHoliday()) {
        $this->cssClasses()->protect('holiday');
      }
      if ($this->diaryDay->isFlagDay()) {
        $this->cssClasses()->protect('flag-day');
      }
    }
  }

  public function contentToString(): string {
    return $this->generateContent()->getHtml();
  }

}
