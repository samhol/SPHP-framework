<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\DateTime;

/**
 * Implements a date range
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DateRange {

  /**
   * @var Date
   */
  private $start;

  /**
   * @var Date
   */
  private $stop;

  /**
   * Constructor
   * 
   * @param Date $start
   * @param Date $stop
   */
  public function __construct(Date $start = null, Date $stop = null) {
    $this->setStart($start);
    $this->setStop($stop);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->start, $this->stop);
  }

  /**
   * Clone method
   */
  public function __clone() {
    $this->start = clone $this->start;
    $this->stop = clone $this->stop;
  }

  public function getStart() {
    return $this->start;
  }

  public function getStrop() {
    return $this->stop;
  }

  public function setStart(Date $start = null) {
    $this->start = $start;
    return $this;
  }

  /**
   * 
   * @param  Date|null $stop
   * @return $this
   */
  public function setStop(Date $stop = null) {
    $this->stop = $stop;
    return $this;
  }

  /**
   * Checks if the given date is in range
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date the date to match
   * @return bool true if given date is in range
   * @throws DateTimeException if date cannot be parsed from input
   */
  public function isInRange($date): bool {
    $start = $stop = false;
    if ($this->start !== null) {
      $start = $this->start->isEarlierThan($date, false);
    }
    if ($this->stop !== null) {
      $stop = $this->stop->isLaterThan($date, false);
    }
    return $start && $stop;
  }

}
