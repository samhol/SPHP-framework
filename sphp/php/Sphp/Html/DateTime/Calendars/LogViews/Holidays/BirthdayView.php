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
use Sphp\Html\Content;

use Sphp\Html\DateTime\Calendars\LogViews\ViewFactory;
/**
 * Description of BirthdayView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class BirthdayView implements Content {

  use \Sphp\Html\ContentTrait;

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
    $date = $this->birthday->getDate();
    $output = "Birthday of {$this->birthday->getName()}";
    $year = $date->getYear();
    $age = $curr->getYear() - $year;
    if ($age === 0) {
      $output .= " (was born this day)";
    } else {
      $output .= " (was born $age years ago)";
    }
    //$output .= $this->getDate()->format('l, Y-m-d');
    if ($this->birthday->isNationalHoliday()) {
      $output .= " (national holiday)";
    }
    if ($this->birthday->isFlagDay()) {
      $output .= ViewFactory::flag('finland');
    }
    return $output;
  }

  public function getHtml(): string {
    return "{$this->build()}";
  }

}
