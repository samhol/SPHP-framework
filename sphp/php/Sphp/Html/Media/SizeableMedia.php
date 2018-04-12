<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
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
   * Checks if the component has width defined
   * 
   * @return boolean true if the width is set and false otherwise
   */
  public function hasWidth(): bool;

  /**
   * Returns the width of the component (in pixels)
   * 
   * *NOTE:* Check if the component has a width defined
   * 
   * @return int width of the component
   */
  public function getWidth(): int;

  /**
   * Sets the width of the component (in pixels)
   * 
   * @param  int $width the width of the component (in pixels))
   * @return $this for a fluent interface
   */
  public function setWidth(int $width);

  /**
   * Unsets the width of the component
   * 
   * @return $this for a fluent interface
   */
  public function unsetWidth();

  /**
   * Returns the height of the component (in pixels)
   * 
   * *NOTE:* Check if the component has a width defined
   * 
   * @return int height of the component
   */
  public function getHeight(): int;

  /**
   * Checks if the component has height defined
   * 
   * @return boolean true if the height is set and false otherwise
   */
  public function hasHeight(): bool;

  /**
   * Sets the height of the component (in pixels)
   * 
   * @param  int $height the height of the component (in pixels)
   * @return $this for a fluent interface
   */
  public function setHeight(int $height);

  /**
   * Unsets the height of the component
   * 
   * @return $this for a fluent interface
   */
  public function unsetHeight();
}
