<?php

/**
 * MonthView.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Calendars;

use Sphp\Html\Tables\Tbody;
use Sphp\Html\Tables\Tr;
use Sphp\Html\Tables\Td;
use Sphp\Html\Tables\Thead;
use Sphp\Html\Tables\Table;
use Sphp\I18n\Calendar;
use DateTimeInterface;

/**
 * */
class MonthView extends \Sphp\Html\AbstractComponent {

  use \Sphp\Html\ContentTrait;

  /**
   *
   * @var Table 
   */
  private $table;

  public function __construct($year = null, $month = null) {
    parent::__construct('div');
    $this->cssClasses()->lock('calendar');
    if ($year === null) {
      $year = (int) date("Y", time());
    }
    if ($month === null) {
      $month = (int) date("m", time());
    }
    $this->month = $month;
    echo "$year-$month-1";
    $dt = new \DateTimeImmutable("$year-$month-1");
    $this->weeks = new \Sphp\Html\Container();
    $this->table = $this->createTable($dt);
  }

  protected function createTable($dt) {
    $table = new Table();
    $table->thead($this->createThead());
    $table->tbody($this->parseWeeks($dt));
    return $table;
  }

  protected function parseWeeks(DateTimeInterface $dt) {
    $body = new Tbody();
    $monday = $this->getMonday($dt);
    $week = $monday->format('W');
    $body[$week] = $this->createWeekRow($monday);
    $next = $monday->modify('+ 7 days');
    while ($next->format('m') == $this->month) {
      $week = $next->format('W');
      $body[$week] = $this->createWeekRow($next);
      $next = $next->modify('+ 7 day');
    }
    return $body;
  }

  protected function createThead() {
    $thead = new Thead();
    $c = new Calendar();
    $tr = new Tr();
    $tr->appendTh('Week');
    $tr->appendThs($c->getWeekdays());
    $thead->append($tr);
    return $thead;
  }

  private function createWeekRow(DateTimeInterface $date) {
    $monday = $this->getMonday($date);
    $tr = new Tr();
    //$this->week = (int) $monday->format('W');
    //$this->dayCells = (new Ul())->addCssClass('week');
    $tr->appendTh($monday->format('W'));
    $day = $monday->format('j');
    $tr->appendTd($day);
    $next = $monday->modify('+ 1 day');
    while ($next->format('N') != 1) {
      $day = $next->format('j');
      $tr->append($this->createDayCell($next));
      $next = $next->modify('+ 1 day');
    }
    return $tr;
  }

  protected function createDayCell(DateTimeInterface $day) {
    $td = new Td($day->format('j'));
    $td->cssClasses()->lock($day->format('l'));
    return $td;
  }

  public function getMonday(DateTimeInterface $date) {
    if ($date->format('N') != 1) {
      return $date->modify('last monday');
    } else {
      return clone $date;
    }
  }

  public function contentToString(): string {
    return $this->table->getHtml();
  }

}
