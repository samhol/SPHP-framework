<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Apps\Calendars;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
/**
 * @author  Xu Ding
 * @email   thedilab@gmail.com
 * @website http://www.StarTutorial.com
 * */
class MonthView {
  /*   * ******************* PROPERTY ******************* */

  private $dayLabels = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
  private $year;
  private $month;
  private $currentDay = 0;
  private $currentDate = null;
  private $daysInMonth = 0;

  /**
   * Constructor
   */
  public function __construct($year = null, $month = null) {
    if ($year === null) {
      $this->year = (int) date("Y", time());
    }
    if ($month === null) {
      $this->month = (int) date("m", time());
    }
  }

  /**
   * print out the calenda
   */
  public function show() {


    $this->daysInMonth = $this->daysInMonth($this->month, $this->year);

    $content = '<div class="sphp-calendar">' .
            '<div class="box">' .
            '</div>' .
            '<div class="box-content">' .
            '<ul class="label">' . $this->_createLabels() . '</ul>';
    $content .= '<div class="clear"></div>';
    $content .= '<ul class="dates">';

    $weeksInMonth = $this->_weeksInMonth($this->month, $this->year);
    // Create weeks in a month
    for ($i = 0; $i < $weeksInMonth; $i++) {

      //Create days in a week
      for ($j = 1; $j <= 7; $j++) {
        $content .= $this->_showDay($i * 7 + $j);
      }
    }

    $content .= '</ul>';

    $content .= '<div class="clear"></div>';

    $content .= '</div>';

    $content .= '</div>';
    return $content;
  }

  /*   * ******************* PRIVATE ********************* */

  /**
   * create the li element for ul
   */
  private function _showDay($cellNumber) {

    if ($this->currentDay == 0) {

      $firstDayOfTheWeek = date('N', strtotime($this->year . '-' . $this->month . '-01'));

      if (intval($cellNumber) == intval($firstDayOfTheWeek)) {

        $this->currentDay = 1;
      }
    }

    if (($this->currentDay != 0) && ($this->currentDay <= $this->daysInMonth)) {

      $this->currentDate = date('Y-m-d', strtotime($this->year . '-' . $this->month . '-' . ($this->currentDay)));

      $cellContent = $this->currentDay;

      $this->currentDay++;
    } else {

      $this->currentDate = null;

      $cellContent = null;
    }


    return '<li id="li-' . $this->currentDate . '" class="' . ($cellNumber % 7 == 1 ? ' start ' : ($cellNumber % 7 == 0 ? ' end ' : ' ')) .
            ($cellContent == null ? 'mask' : '') . '">' . $cellContent . '</li>';
  }


  /**
   * create calendar week labels
   */
  private function _createLabels() {

    $content = '';

    foreach ($this->dayLabels as $index => $label) {

      $content .= '<li class="' . ($label == 6 ? 'end title' : 'start title') . ' title">' . $label . '</li>';
    }

    return $content;
  }

  /**
   * calculate number of weeks in a particular month
   */
  private function _weeksInMonth($month = null, $year = null) {

    if (null == ($year)) {
      $year = date("Y", time());
    }

    if (null == ($month)) {
      $month = date("m", time());
    }

    // find number of days in this month
    $daysInMonths = $this->daysInMonth($month, $year);

    $numOfweeks = ($daysInMonths % 7 == 0 ? 0 : 1) + intval($daysInMonths / 7);

    $monthEndingDay = date('N', strtotime($year . '-' . $month . '-' . $daysInMonths));

    $monthStartDay = date('N', strtotime($year . '-' . $month . '-01'));

    if ($monthEndingDay < $monthStartDay) {

      $numOfweeks++;
    }

    return $numOfweeks;
  }

  /**
   * calculate number of days in a particular month
   */
  private function daysInMonth($month = null, $year = null) {
    if ($year === null) {
      $year = (int) date("Y", time());
    }
    if ($month === null) {
      $month = (int) date("m", time());
    }
    return cal_days_in_month(CAL_GREGORIAN, $month, $year);
  }

}
