<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites;

use Sphp\Html\Foundation\Sites\Media\ProgressBar;

/**
 * Description of Foundation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Foundation {

  /**
   * @param  int $progress
   * @param  string|null $name the name of the bar
   * @return ProgressBar
   */
  public static function progressBar(int $progress, string $name = null): ProgressBar {
    return new ProgressBar($progress, $name);
  }

}
