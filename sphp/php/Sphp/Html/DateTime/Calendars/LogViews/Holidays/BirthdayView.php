<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews\Holidays;

use Sphp\DateTime\Calendars\Diaries\Holidays\HolidayInterface;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;
use Sphp\DateTime\Calendars\Diaries\Holidays\BirthDay;
use Sphp\Html\PlainContainer;
use Sphp\Html\Lists\Ul;

/**
 * Description of BirthdayView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class BirthdayView {

  /**
   * @var BirthDay 
   */
  private $birthday;

  public function __construct(BirthDay $birthday) {
    $this->birthday = $birthday;
  }

  public function __destruct() {
    unset($this->birthday);
  }

  /**
   * Creates a section containing holidays (not birthdays)
   * 
   * @return string
   */
  public function build(): string {
    $curr = new \Sphp\DateTime\Date;
    $date = $this->birthday->getDay();
    $output = "Birthday of {$this->birthday->getName()}";
    $year = $curr->getYear();
    $age = $year - $date->getYear();
    if ($age === 0) {
      $output .= " (was born this day)";
    } else {
      $output .= " (was born $age years ago)";
    }
    //$output .= $this->getDate()->format('l, Y-m-d');
    if ($date->isNationalHoliday()) {
      $output .= " (national holiday)";
    }
    if ($date->isFlagDay()) {
      $output .= ViewFactory::flag('finland');
    }
    return $output;
  }

}
