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
use Sphp\DateTime\Calendars\CalendarDate;
use Sphp\Html\Media\Icons\Svg;

/**
 * Description of WeekDay
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
   * @var CalendarDate
   */
  private $calendarDate;

  public function __construct(CalendarDate $date) {
    $this->calendarDate = $date;
    $this->container = new Div();
    $this->container->attributes()->classes()->protect('sphp', 'calendar-day');
  }

  public function cssClasses(): ClassAttribute {
    return $this->container->cssClasses();
  }

  protected function buildInfo() {
    if ($this->calendarDate->getEvents()->notEmpty()) {
      $dateInfo = new DateInfo($this->calendarDate, $this->container);
      $modal = $dateInfo->create();
      //$modal->getTrigger()->addCssClass('float-center');
      $this->container->append($modal);
    }

    if ($this->calendarDate->getEvents()->nationalHoliday()) {
      $this->container->cssClasses()->protect('holiday');
    }
    return $this;
  }

  protected function generateTimeTag(): TimeTag {
    $timeTag = new TimeTag($this->calendarDate->getDate()->getDateTime());
    if ($this->calendarDate->getEvents()->flagDay()) {
      $timeTag->append('<div class="flag" style="width:20px; display:inline-block;">' . Svg::fromUrl('http://data.samiholck.com/svg/flags/finland.svg') . "</div>");
    }$timeTag->append($this->calendarDate->format('j'));
    $timeTag->setAttribute('title', $this->calendarDate->format('l, Y-m-d'));


    return $timeTag;
  }

  protected function buildDate(): \Sphp\Html\Content {
    $container = new \Sphp\Html\Container;
    $container->append($this->container);
    $timeTag = new TimeTag($this->calendarDate->getDate()->getDateTime(), $this->calendarDate->format('j'));
    $timeTag->setAttribute('title', $this->calendarDate->format('l, Y-m-d'));
    if ($this->calendarDate->getWeekDay() === 1) {
      $this->container->append("<div class=\"week-nr\">{$this->calendarDate->getWeek()}</div>");
    }
    if ($this->calendarDate->isCurrent()) {
      $this->container->cssClasses()->protect('today');
    }
    $this->container->append($this->generateTimeTag());
    if ($this->calendarDate->getEvents()->notEmpty()) {
      $dateInfo = new DateInfo($this->calendarDate, $this->container);
      $modal = $dateInfo->create();
      //$modal->getTrigger()->addCssClass('float-center');
      //$this->container->append($modal);
      $container->append($modal->getPopup());
      $this->container->addCssClass('has-info');

      if ($this->calendarDate->getEvents()->nationalHoliday()) {
        $this->container->cssClasses()->protect('holiday');
      }

      if ($this->calendarDate->getEvents()->flagDay()) {
        $this->container->cssClasses()->protect('flag-day');
      }
    }
    $this->container->cssClasses()->protect(strtolower($this->calendarDate->format('l')));
    return $container;
  }

  public function getHtml(): string {
    return $this->buildDate()->getHtml();
  }

}
