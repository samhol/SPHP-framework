<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Containers\OffCanvas;

use Sphp\Html\Component;

/**
 * An abstract implementation of on Off-canvas area
 * 
 * This component is the panel that slides in and out of the {@link OffCanvas} when activated. 
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation 6
 * @link    https://foundation.zurb.com/sites/docs/off-canvas.html Foundation 6 Off-canvas
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface OffCanvasPane extends Component, \Sphp\Foundation\Sites\Adapters\VisibilityToggler {

  public function getSide(): int;

  /**
   * Sets the pane position
   * 
   * @param  string $position the pane position
   * @return $this for a fluent interface
   */
  public function setPosition(string $position = 'fixed');

  /**
   * 
   * @param Component $content
   */
  public function createToggleButton(Component $content = null);
}
