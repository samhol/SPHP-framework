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
use Sphp\DateTime\Calendars\Diaries\Sports\WorkoutLog;
use Sphp\DateTime\Calendars\Diaries\Sports\Exercise;
use Sphp\Html\Flow\Section;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\Ol;

/**
 * Implements a workout log viewer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractLogView implements Content {

  use \Sphp\Html\ContentTrait;

  /**
   * 
   * @return Section
   */
  abstract public function buildSection(): Section;

  abstract public function hasLogs(): bool;

  public function getHtml(): string {
    $output = '';
    if ($this->hasLogs()) {
      $output .= $this->buildSection();
    }
    return $output;
  }

}
