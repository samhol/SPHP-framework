<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Views\LogViews\Events;

use Sphp\Apps\Calendars\Diaries\Events\SingleEvent;
use Sphp\Html\AbstractContent;
use Sphp\Html\Tags;
use Sphp\DateTime\DateTime;
use Sphp\DateTime\Date;

/**
 * The SingleEventView class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SingleEventView extends AbstractContent {

  /**
   * @var SingleEvent
   */
  private SingleEvent $event;

  public function __construct(SingleEvent $event) {
    $this->event = $event;
  }

  public function __destruct() {
    unset($this->event);
  }

  public function getHtml(): string {
    $container = Tags::div()->addCssClass('container');
    $container->append(Tags::div($this->event->getName())->addCssClass('strong'));
    if ($this->event->isSingleDayEvent()) {
      $container->append($this->builSingleDay());
    } else {
      $container->append(Tags::div($this->buildMultiday()));
    }
    $container->append(Tags::div($this->event->getDescription()));
    $container->appendHr();
    return $container->getHtml();
  }

  protected function buildMultiday(): ?string {
    $out = null;
    $out .= $this->getTimes();
    $out .= (string) Tags::div('Duration: ' . $this->durationToString($this->event->getDuration()));

    return $out;
  }

  private function durationToString(\Sphp\DateTime\Duration $duration): string {
    $item = [];
     if ($duration->d > 0) {
      $item[] = "{$duration->d} days";
    }
    if ($duration->h > 0) {
      $item[] = "{$duration->h} hrs";
    }
    if ($duration->i > 0) {
      $item[] = "{$duration->i} min";
    }
    if ($duration->s > 0) {
      $item[] = "{$duration->s} sec";
    }
    return \implode(' ', $item);
  }

  public function builSingleDay(): string {
    $out = $this->getTimes();
    if ($this->event->getDuration()->toSeconds() > 0) {
      $out = (string) Tags::div('Duration: ' . $this->durationToString($this->event->getDuration()));
      $out .= $this->getTimesForSingleDay();
    }
    return $out;
  }

  protected function getTimesForSingleDay(): ?string {
    $start = $this->event->getStart();
    $end = $this->event->getEnd();
    $out = Tags::div()->addCssClass('row');
    $out->append($this->getTime('Starts:', $this->event->getStart()));
    if ($start->diff($end)) {
      $out->append($this->getTime('Ends:', $this->event->getEnd()));
    }
    return $out->getHtml();
  }

  protected function getTimes(): ?string {
    $out = Tags::div()->addCssClass('row gx-1');
    $out->append($this->getTime('Starts:', $this->event->getStart()));
    $out->append($this->getTime('Ends:', $this->event->getEnd()));
    return $out->getHtml();
  }

  protected function getTime(string $description, Date $d): ?string {
    $cell = Tags::div()->addCssClass('col small-12 col-md-auto');
    $cont = $cell->appendDiv()->addCssClass('date-info m-1 p-1');
    $cont->append(Tags::div($description)->addCssClass('description'));
    $cont->append(Tags::div($this->parseDateTime($d)));
    return $cell->getHtml();
  }

  protected function parseDateTime(Date $d): string {
    $container = Tags::div()->addCssClass('date-cell p-2');
    $container->append(Tags::div('<i class="far fa-calendar"></i> ' . $d->format('jS \o\f F Y')));
    if ($d instanceof DateTime) {
      $clock = Tags::div(' <i class="far fa-clock"></i> ' . $d->format('H:i'));
      if (!$d->isCurrentTimezone()) {
        $clock->append($d->format('e'));
      }
      $container->append($clock);
    }
    return $container->getHtml();
  }

}
