<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Media\Icons;

use Sphp\Html\Content;

/**
 * Defines an accessible icon based on fonts or SVG an JavaScript
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Icon extends Content {
  /**
   * Sets the title for the icon
   * 
   * @param  string|null $title the ARIA label text for the icon
   * @return $this for a fluent interface
   */
  public function setTitle(?string $title = null);
  /**
   * Set whether the icon is for decoration only
   * 
   * @param  bool $decorative
   * @return $this for a fluent interface
   */
  public function setDecorative(bool $decorative);
}
