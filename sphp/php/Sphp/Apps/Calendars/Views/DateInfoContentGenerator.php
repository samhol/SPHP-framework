<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Views;

use Sphp\Html\Div;
use Sphp\Apps\Calendars\Diaries\DiaryDate;
use Sphp\Apps\Calendars\Views\LogViews\LogViewBuilder;

/**
 * Implements an info section for all events and logs of a calendar day
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DateInfoContentGenerator {

  private LogViewBuilder $logLayoutBuilder;

  /**
   * Constructor
   *
   * @param LogViewBuilder|nll $logViewBuilder
   */
  public function __construct(?LogViewBuilder $logViewBuilder = null) {
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

  public function generate(DiaryDate $date): Div {
    $section = new Div();
    $section->addCssClass('date-info-content');
    //$heading = $section->appendH2($date->getDate()->format('l, F jS, Y'));
    if ($date->isFlagDay()) {
     // $section->prepend('<span class="national-flag">' . SvgLoader::instance()->fileToObject('/home/int48291/public_html/playground/manual/svg/flags/fi.svg') . '</span>');
    }
    $section->append($this->logLayoutBuilder->build($date));
    return $section;
  }

}
