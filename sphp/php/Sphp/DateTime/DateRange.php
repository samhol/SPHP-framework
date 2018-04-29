<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\DateTime;

/**
 * Description of DateRange
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DateRange {

  private $start, $strop;

  public function __construct(Date $start = null, Date $stop = null) {
    $this->setStart($start);
    $this->setStrop($stop);
  }

  public function getStart() {
    return $this->start;
  }

  public function getStrop() {
    return $this->strop;
  }

  public function setStart($start) {
    $this->start = $start;
    return $this;
  }

  public function setStrop($strop) {
    $this->strop = $strop;
    return $this;
  }

  public function isInRange($date): bool {
    $result = false;
    if ($this->start === null && $this->stop === null) {
      $result =  true;
    } else if($this->start !== null) {
      $result = $this->start
    }
    return $result;
  }

}
