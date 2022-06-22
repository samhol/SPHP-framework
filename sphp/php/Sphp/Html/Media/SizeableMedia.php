<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media;

use Sphp\Html\Content;

/**
 * Defines sizing of HTML media components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface SizeableMedia extends Content {

  /**
   * Sets the width and the height of the component (in pixels)
   * 
   * @param  int|null $width the width of the component (in pixels))
   * @param  int|null $height the height of the component (in pixels)
   * @return $this for a fluent interface
   */
  public function setSize(?int $width, ?int $height);
}
