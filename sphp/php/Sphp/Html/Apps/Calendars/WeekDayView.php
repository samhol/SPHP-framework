<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Apps\Calendars;

use Sphp\Html\Content;
use DateTimeInterface;
use Sphp\Html\Div;
use Sphp\Html\TimeTag;

/**
 * Description of WeekDay
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class WeekDayView implements Content, \Sphp\Html\CssClassifiableContent {

  use \Sphp\Html\ContentTrait, \Sphp\Html\CssClassifiableTrait;

  /**
   * @var DateTimeInterface
   */
  private $date;

  /**
   * @var Div
   */
  private $container;

  public function __construct(DateTimeInterface $date) {
    $this->date = $date;
    $this->container = new Div();
    $this->container->attributes()->classes()->protect('sphp', 'calendar-day');
  }
public function cssClasses(): \Sphp\Html\Attributes\ClassAttribute {
  return $this->container->cssClasses();
}

protected function buildDate() {
    $timeTag = new TimeTag($this->date, $this->date->format('j'));
    $timeTag->setAttribute('title', $this->date->format('l, Y-m-d'));
    $this->container->append($timeTag);
    $this->container->cssClasses()->protect($this->date->format('l'));
    return $this;
  }

  public function getHtml(): string {
    $this->buildDate();
    return $this->container->getHtml();
  }

}
