<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Apps\Calendars;

use Sphp\Html\Lists\Ul;
use Sphp\Html\Tables\Table;

/**
 * @author  Xu Ding
 * @email   thedilab@gmail.com
 * @website http://www.StarTutorial.com
 * */
class MonthView extends \Sphp\Html\AbstractComponent {

  use \Sphp\Html\ContentTrait;

  private $weeks;

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
    $table->tbody($this->parseWeeks($dt));
    return $table;
  }

  protected function parseWeeks(\DateTimeImmutable $dt) {
    $body = new \Sphp\Html\Tables\Tbody();
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

  private function createWeekRow(\DateTimeImmutable $date) {
    $monday = $this->getMonday($date);
    $tr = new \Sphp\Html\Tables\Tr();
    //$this->week = (int) $monday->format('W');
    //$this->dayCells = (new Ul())->addCssClass('week');
    $tr->appendTh($monday->format('W'));
    $day = $monday->format('j');
    $tr->appendTd($day);
    $next = $monday->modify('+ 1 day');
    while ($next->format('N') != 1) {
      $day = $next->format('j');
      $tr->appendTd($day);
      $next = $next->modify('+ 1 day');
    }
    return $tr;
  }

  public function getMonday(\DateTimeImmutable $date) {
    if ($date->format('N') != 1) {
      return $date->modify('last monday');
    } else {
      return clone $date;
    }
  }

  public function contentToString() {
    return $this->table->getHtml();
  }

}
