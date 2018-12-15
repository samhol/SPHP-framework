<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars;

use Sphp\Html\Div;
use Sphp\Html\DateTime\TimeTag;
use Sphp\Html\Attributes\ClassAttribute;
use Sphp\Html\CssClassifiableContent;
use Sphp\Html\Media\Icons\Svg;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;
use Sphp\Html\PlainContainer;

/**
 * Implements a weekday vire for a calendar month
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class WeekDayView implements CssClassifiableContent {

  use \Sphp\Html\ContentTrait,
      \Sphp\Html\CssClassifiableTrait;

  /**
   * @var Div
   */
  private $container;

  /**
   * @var DiaryDate
   */
  private $diaryDay;

  /**
   * Constructor
   * 
   * @param DiaryDate $date
   */
  public function __construct(DiaryDate $date) {
    $this->diaryDay = $date;
    $this->container = new Div();
    $this->container->attributes()->classes()->protect('sphp', 'calendar-day');
  }

  public function cssClasses(): ClassAttribute {
    return $this->container->cssClasses();
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

  protected function buildDate(): PlainContainer {
    $container = new PlainContainer;
    $container->append($this->container);
    $timeTag = new TimeTag($this->diaryDay->getDate()->getDateTime(), $this->diaryDay->getDate()->format('j'));
    $timeTag->setAttribute('title', $this->diaryDay->getDate()->format('l, Y-m-d'));
    if ($this->diaryDay->getDate()->getWeekDay() === 1) {
      $this->container->append("<div class=\"week-nr\">{$this->diaryDay->getDate()->getWeek()}</div>");
    }
    if ($this->diaryDay->getDate()->isCurrentDate()) {
      $this->container->cssClasses()->protect('today');
    }
    $this->container->append($this->generateTimeTag());
    if ($this->diaryDay->notEmpty()) {
      $dateInfo = new DateInfo($this->diaryDay, $this->container);
      $modal = $dateInfo->create();
      //$modal->getTrigger()->addCssClass('float-center');
      //$this->container->append($modal);
      $container->append($modal->getPopup());
      $this->container->addCssClass('has-info');

      if ($this->diaryDay->isNationalHoliday()) {
        $this->container->cssClasses()->protect('holiday');
      }

      if ($this->diaryDay->isFlagDay()) {
        $this->container->cssClasses()->protect('flag-day');
      }
    }
    $this->container->cssClasses()->protect(strtolower($this->diaryDay->getDate()->format('l')));
    return $container;
  }

  public function getHtml(): string {
    return $this->buildDate()->getHtml();
  }

}
