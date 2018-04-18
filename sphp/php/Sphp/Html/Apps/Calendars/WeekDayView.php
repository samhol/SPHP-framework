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
    //$this->container->append(new DateInfo($this->date));
    $this->container->cssClasses()->protect(strtolower($this->date->format('l')));
    return $this;
  }

  public function getHtml(): string {
    $this->buildDate();
    return $this->container->getHtml();
  }

}
