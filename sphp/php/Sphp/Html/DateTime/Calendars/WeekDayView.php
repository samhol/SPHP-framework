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
  private $content;

  /**
   * Constructor
   * 
   * @param DiaryDate $date
   */
  public function __construct(DiaryDate $date) {
    parent::__construct('div');
    $this->diaryDay = $date;
    $this->attributes()->classes()->protect('sphp', 'calendar-day');
    $this->buildDate();
  }

  protected function generateTimeTag(): TimeTag {
    $timeTag = new TimeTag($this->diaryDay->getDate()->getDateTime());
    if ($this->diaryDay->isFlagDay()) {
      $timeTag->append('<span class="flag">' . Svg::fromUrl('http://data.samiholck.com/svg/flags/finland.svg') . '</span>');
    }
    $timeTag->append($this->diaryDay->getDate()->format('j'));
    $timeTag->setAttribute('title', $this->diaryDay->getDate()->format('l, Y-m-d'));
    return $timeTag;
  }

  protected function buildDate() {
    $this->content = new PlainContainer;
    //$container->append($this->container);
    $timeTag = new TimeTag($this->diaryDay->getDate()->getDateTime(), $this->diaryDay->getDate()->format('j'));
    $timeTag->setAttribute('title', $this->diaryDay->getDate()->format('l, Y-m-d'));
    if ($this->diaryDay->getDate()->getWeekDay() === 1) {
      $this->content->append("<div class=\"week-nr\">{$this->diaryDay->getDate()->getWeek()}</div>");
    }
    if ($this->diaryDay->getDate()->isCurrentDate()) {
      $this->cssClasses()->protect('today');
    }
    $this->content->append($this->generateTimeTag());
    if ($this->diaryDay->notEmpty()) {
      //$dateInfo = new DateInfo($this->diaryDay, $this->container);
      //$modal = $dateInfo->create();
      //$modal->getTrigger()->addCssClass('float-center');
      //$this->container->append($modal);
      //$container->append($modal->getPopup());
      $this->addCssClass('has-info');

      if ($this->diaryDay->isNationalHoliday()) {
        $this->cssClasses()->protect('holiday');
      }

      if ($this->diaryDay->isFlagDay()) {
        $this->cssClasses()->protect('flag-day');
      }
    }
    $this->cssClasses()->protect(strtolower($this->diaryDay->getDate()->format('l')));
  }

  public function contentToString(): string {
    return "$this->content";
  }

}
