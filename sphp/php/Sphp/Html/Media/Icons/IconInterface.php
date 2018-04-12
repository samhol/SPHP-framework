<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;

use Sphp\Html\Content;

/**
 * Defines an accessible icon based on fonts or SVG
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface IconInterface extends Content {

  /**
   * 
   * @param  string $sreenreaderLabel 
   * @return $this for a fluent interface
   */
  public function setSreenreaderText(string $sreenreaderLabel = null);
}
