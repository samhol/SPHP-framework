<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars;

use Sphp\Html\AbstractComponent;
use Sphp\DateTime\DateTime;
use Sphp\Html\DateTime\TimeTag;
use Sphp\Html\Div;

/**
 * Class DayView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DayView extends AbstractComponent {

  /**
   * @var DateTime
   */
  private $date;

  /**
   * @var TimeTag
   */
  private $heading;

  /**
   * @var Div
   */
  private $content;

  public function __construct(DateTime $date) {
    $this->date = $date;
    parent::__construct('div');
    $this->addCssClass('day-block');
    $this->heading = new TimeTag($this->date);
    $this->heading->addCssClass('date-heading');
    $this->heading->append('<span class="date-number">'.$this->date->format('j').'</span>');
    $this->content = new Div();
    $this->content->addCssClass('content');
    $this->setAttributes();
  }

  public function __destruct() {
    unset($this->date, $this->heading, $this->content);
  }

  protected function setAttributes(): void {
    $date = $this->getDate();
    $dayName = strtolower($date->format('l'));
    $weekNumber = $date->getWeek();
    $this->setAttribute('data-week-day', $dayName);
    $this->setAttribute('data-date', $date->format('Y-m-d'));
    $this->setAttribute('data-week', $weekNumber);
    $this->cssClasses()->protectValue('sphp', 'date', $dayName);
    if ($date->isCurrentDate()) {
      $this->cssClasses()->protectValue('today');
    }
    if ($date->compareTo(time()) > 0) {
      $this->cssClasses()->protectValue('future');
    }
  }

  public function setHeading($content) {
    $this->heading->append($content);
    return $this;
  }

  public function getHeading(): TimeTag {
    return $this->heading;
  }

  public function getDate(): DateTime {
    return $this->date;
  }

  public function getContent(): Div {
    return $this->content;
  }

  public function setContent($content) {
    $this->getContent()->resetContent($content);
    return $this;
  }

  public function contentToString(): string {
    return $this->getHeading() . $this->getContent();
  }

}
