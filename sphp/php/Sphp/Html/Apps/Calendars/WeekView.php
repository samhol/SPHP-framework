<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Apps\Calendars;

use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\Li;
use DateTimeImmutable;

/**
 * Description of WeekView
 *
 * @author Sami
 */
class WeekView implements \Sphp\Html\ContentInterface {

  use \Sphp\Html\ContentTrait;

  /**
   *
   * @var Ul
   */
  private $dayCells;

  public function __construct(DateTimeImmutable $date = null) {

    if ($date === null) {
      $date = new \DateTimeImmutable();
    } 
    $monday = $this->getMonday($date);
    
    $this->week = (int) $monday->format('W');
    $this->dayCells = (new Ul())->addCssClass('week');
    $this->dayCells['week'] = (new Li($monday->format('W')))->addCssClass('number');
    $day = $monday->format('j');
    $this->dayCells[$day] = new Li($day);
    $next = $monday->modify('+ 1 day');
    while ($next->format('N') != 1) {
      $day = $next->format('j');
      $this->dayCells[$day] = new Li($day);
      $next = $next->modify('+ 1 day');
    }
  }
  
  public function getMonday(DateTimeImmutable $date) {
    if ($date->format('N') != 1) {
      return $date->modify('last monday');
    } else {
      return clone $date;
    }
  }


  public function getHtml() {
    return $this->dayCells->getHtml();
  }

}
