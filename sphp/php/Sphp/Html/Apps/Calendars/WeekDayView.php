<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Calendars;

use Sphp\Html\Content;
use DateTimeInterface;
use Sphp\Html\Div;
use Sphp\Html\TimeTag;
use Sphp\DateTime\Date;
use Sphp\DateTime\Holidays;
use Sphp\Html\Foundation\Sites\Containers\Modal;

/**
 * Description of WeekDay
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class WeekDayView implements Content, \Sphp\Html\CssClassifiableContent {

  use \Sphp\Html\ContentTrait,
      \Sphp\Html\CssClassifiableTrait;

  /**
   * @var Date
   */
  private $date;

  /**
   * @var Div
   */
  private $container;

  /**
   * @var Holidays
   */
  private $holidays;

  /**
   * @var Modal
   */
  private $modal;

  public function __construct(Date $date) {
    $this->date = $date;
    $this->container = new Div();
    $this->container->attributes()->classes()->protect('sphp', 'calendar-day');
    $this->modal = new Modal($this->container, '<h5>Date info</h5>');
    $this->modal->useOverLay(false);
  }

  public function useHolidays(Holidays $holidays = null) {
    $this->holidays = $holidays;
    return $this;
  }

  public function cssClasses(): \Sphp\Html\Attributes\ClassAttribute {
    return $this->container->cssClasses();
  }

  protected function buildHoliday() {
    if ($this->holidays instanceof Holidays) {
      $holidays = $this->holidays->get($this->date);
      $h = implode(', ', $holidays);
      $this->modal->getPopup()->append($h);
      if (!empty($holidays)) {
        $this->container->cssClasses()->protect('holiday');
      }
    }
    return $this;
  }

  protected function buildDate() {
    $timeTag = new TimeTag($this->date->getDateTime(), $this->date->format('j'));
    $timeTag->setAttribute('title', $this->date->format('l, Y-m-d'));
    if ($this->date->getWeekDay() === 1) {
      $this->container->append("<div class=\"week-nr\">{$this->date->getWeek()}</div>");
    }
    $this->container->append($timeTag);
    $this->buildHoliday();
    //$this->container->append(new DateInfo($this->date));
    $this->container->cssClasses()->protect(strtolower($this->date->format('l')));
    return $this;
  }

  public function getHtml(): string {
    $this->buildDate();
    return $this->container->getHtml() . $this->modal->getPopup();
  }

}
