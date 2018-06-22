<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews;

use Sphp\Html\Content;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holiday;
use Sphp\DateTime\Calendars\Diaries\Holidays\HolidayInterface;
use Sphp\DateTime\Calendars\Diaries\Sports\WorkoutLog;
use Sphp\DateTime\Calendars\Diaries\Sports\Exercise;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;
use Sphp\DateTime\Calendars\Diaries\Holidays\BirthDay;
use Sphp\Html\Flow\Section;
use Sphp\Html\Lists\Ul;

/**
 * Implements a holiday log viewer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HolidayLogView implements Content {

  use \Sphp\Html\ContentTrait;

  /**
   * @var HolidayInterface[] 
   */
  private $holidays = [];

  /**
   * @var BirthDay[] 
   */
  private $birthdays = [];

  /**
   * Constructor
   */
  public function __construct($day = null) {
   
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->birthdays, $this->holidays);
  }

  /**
   * Inserts a new Holiday instance
   * 
   * @param  HolidayInterface $holiday
   * @return $this
   */
  public function insert(HolidayInterface $holiday) {
    if ($holiday instanceof BirthDay) {
      $this->birthdays[] = $holiday;
    } else {
      $this->holidays[] = $holiday;
    }
    return $this;
  }

  /**
   * Creates a section containing holidays (not birthdays)
   * 
   * @return Section new instance
   */
  public function createHolidaySection(): Section {
    $section = new Section();
    if (!empty($this->holidays)) {
      $section->appendH3('Holidays');
      $list = new Ul();
      foreach ($this->holidays as $exercise) {
        $list->append($exercise);
      }
      $section->append($list);
    }
    return $section;
  }

  /**
   * Creates a section containing birthdays
   * 
   * @return Section new instance
   */
  public function createBirthdaySection(): Section {
    $section = new Section();
    if (!empty($this->birthdays)) {
      $section->appendH3('Birthdays');
      $list = new Ul();
      foreach ($this->birthdays as $exercise) {
        $list->append($exercise);
      }
      $section->append($list);
    }
    return $section;
  }

  public function getHtml(): string {
    return $this->createHolidaySection() . $this->createBirthdaySection();
  }

}
