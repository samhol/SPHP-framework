<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars;

use Sphp\Html\Flow\Section;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;
use Sphp\Html\DateTime\Calendars\LogViews\LogViewBuilder;

/**
 * Implements an info modal for all events and logs of a calendar day
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DateInfoContentGenerator {

  /**
   * @var LogViewBuilder
   */
  private $logLayoutBuilder;

  /**
   * Constructor
   * 
   */
  public function __construct() {
    $this->logLayoutBuilder = LogViewBuilder::instance();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->logLayoutBuilder);
  }

  public function generate(DiaryDate $date): Section {
    $section = new Section();
    $section->appendH2($date->getDate()->format('l, F jS, Y'));
    $section->append($this->logLayoutBuilder->build($date));
    return $section;
  }

}
