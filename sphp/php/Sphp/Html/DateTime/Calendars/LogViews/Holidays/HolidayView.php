<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\DateTime\Calendars\LogViews\Holidays;

use Sphp\DateTime\Calendars\Diaries\Holidays\HolidayInterface;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holiday;
use Sphp\Html\PlainContainer;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Content;
use Sphp\Html\DateTime\Calendars\LogViews\ViewFactory;
/**
 * Description of HolidayView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HolidayView implements Content {

  use \Sphp\Html\ContentTrait;

  /**
   * @var Holiday 
   */
  private $holiday;

  public function __construct(Holiday $birthday) {
    $this->holiday = $birthday;
  }

  public function __destruct() {
    unset($this->holiday);
  }

  /**
   * Creates a section containing holidays (not birthdays)
   * 
   * @return string
   */
  public function build(): string {
    $output = $this->holiday->getName();
    $output .= $this->holiday->getDescription();
    //$output .= $this->getDate()->format('l, Y-m-d');
    if ($this->holiday->isNationalHoliday()) {
      $output .= " (national holiday)";
    }
    if ($this->holiday->isFlagDay()) {
      $output .= ViewFactory::flag('finland');
    }
    return $output;
  }

  public function getHtml(): string {
    return "{$this->build()}";
  }

}
