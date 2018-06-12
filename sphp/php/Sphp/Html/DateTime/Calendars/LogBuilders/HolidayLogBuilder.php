<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogBuilders;

use Sphp\Html\Content;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holiday;
use Sphp\DateTime\Calendars\Diaries\Sports\WorkoutLog;
use Sphp\DateTime\Calendars\Diaries\Sports\Exercise;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;

/**
 * Description of HolidayLogBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HolidayLogBuilder implements Content {

  use \Sphp\Html\ContentTrait;

  /**
   * @var DiaryDate 
   */
  private $holiday = [];

  /**
   * Constructor
   *
   * @param WorkoutLog $workouts
   */
  public function __construct($workouts = null) {
    $this->holiday = $workouts;
  }

  public function insert($holiday) {
    $this->holiday[] = $holiday;
    return $this;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->holiday);
  }

  /**
   * Builds a Foundation based accordion component containing the example
   * 
   * @return Accordion a Foundation based accordion component containing the example
   */
  public function buildAccordion(): Accordion {
    $accordion = new Accordion();
    $pane = new Pane('BirthDays');
    foreach ($this->holiday as $exercise) {
      $pane->append($exercise);
    }
    $accordion->append($pane);
    return $accordion;
  }

  public function getHtml(): string {
    $h = '<h2>Birthdays:</h2>';
    if (!empty($this->holiday)) {
      $accordion = new \Sphp\Html\Lists\Ul();
      //$pane = new Pane('Birthdays:');
      foreach ($this->holiday as $exercise) {
        $accordion->append($exercise);
      }
      $h .= $accordion;
    }
    return $h;
  }

}
