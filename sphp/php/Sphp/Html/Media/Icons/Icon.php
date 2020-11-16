<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;

use Sphp\Html\Tag;

/**
 * Defines an accessible icon based on fonts or SVG an JavaScript
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Icon extends Tag {
  /**
   * Sets the title for the icon
   * 
   * @param string $title the ARIA label text for the icon
   * @return $this for a fluent interface
   */
  public function setTitle(string $title = null);
}
