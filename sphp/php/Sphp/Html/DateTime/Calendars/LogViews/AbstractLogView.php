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
use Sphp\Html\Flow\Section;

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
