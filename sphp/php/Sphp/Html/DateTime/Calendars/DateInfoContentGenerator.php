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
use Sphp\Html\Media\Icons\SvgLoader;

/**
 * Implements an info section for all events and logs of a calendar day
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
   * @param LogViewBuilder $logViewBuilder
   */
  public function __construct(LogViewBuilder $logViewBuilder = null) {
    if ($logViewBuilder === null) {
      $logViewBuilder = LogViewBuilder::instance();
    }
    $this->logLayoutBuilder = $logViewBuilder;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->logLayoutBuilder);
  }

  public function generate(DiaryDate $date): Section {
    $section = new Section();
    $section->addCssClass('date-info-content');
    $heading = $section->appendH2($date->getDate()->format('l, F jS, Y'));
    if ($date->isFlagDay()) {
      $heading->prepend('<span class="national-flag">' . SvgLoader::fileToObject('/home/int48291/public_html/playground/manual/svg/flags/fi.svg') . '</span>');
    }

    $section->append($this->logLayoutBuilder->build($date));
    return $section;
  }

}
