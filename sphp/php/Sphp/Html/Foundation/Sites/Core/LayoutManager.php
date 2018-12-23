<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Content;

/**
 * Defines a layout manager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface LayoutManager extends Content {

  /**
   * Sets the layouts
   *
   * @param  string|string[] $layouts layout parameters (CSS classes)
   * @return $this for a fluent interface
   */
  public function setLayouts(... $layouts);
}
