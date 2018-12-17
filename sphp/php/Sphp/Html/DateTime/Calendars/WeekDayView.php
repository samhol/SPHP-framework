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
 * Implements a weekday vire for a calendar month
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
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
    $date = $this->diaryDay->getDate();
    $this->cssClasses()->protect('sphp', 'calendar-day', strtolower($date->format('l')));
    $this->setAttribute('data-date', $date->format('Y-m-d'));
    $this->setCssClasses();
  }

  private function generateContent(): PlainContainer {
    $content = new PlainContainer;
    $date = $this->diaryDay->getDate();
    if ($date->getWeekDay() === 1) {
      $content->append("<div class=\"week-nr\">{$this->diaryDay->getDate()->getWeek()}</div>");
    }
    $timeTag = new TimeTag($this->diaryDay->getDate()->getDateTime());
    if ($this->diaryDay->isFlagDay()) {
      $timeTag->append('<span class="flag">' . Svg::fromUrl('http://data.samiholck.com/svg/flags/finland.svg') . '</span>');
    }
    $timeTag->append($this->diaryDay->getDate()->format('j'));
    $timeTag->setAttribute('title', $this->diaryDay->getDate()->format('l jS \of F Y'));
    $content->append($timeTag);
    return $content;
  }

  protected function setCssClasses() {
    $date = $this->diaryDay->getDate();
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
