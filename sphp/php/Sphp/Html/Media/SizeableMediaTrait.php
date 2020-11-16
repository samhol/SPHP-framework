<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media;

use Sphp\Html\Attributes\AttributeContainer;

/**
 * Trait implements the SizeableMedia interface
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
trait SizeableMediaTrait {

  /**
   * Returns the attribute manager attached to the component
   * 
   * @return AttributeContainer the attribute manager
   */
  abstract public function attributes(): AttributeContainer;

  /**
   * Sets the width and the height of the component (in pixels)
   * 
   * @param  int $width the width of the component (in pixels))
   * @param  int $height the height of the component (in pixels)
   * @return $this for a fluent interface
   */
  public function setSize(int $width = null, int $height = null) {
    $this->attributes()->setAttribute('width', $width);
    $this->attributes()->setAttribute('height', $height);
    return $this;
  }

}
