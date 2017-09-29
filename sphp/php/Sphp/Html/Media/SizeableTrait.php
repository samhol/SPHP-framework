<?php

/**
 * SizeableTrait.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Trait implements the {@link SizeableInterface} interface for a {@link \Sphp\Html\ComponentInterface}
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait SizeableTrait {

  /**
   * Returns the attribute manager attached to the component
   * 
   * @return HtmlAttributeManager the attribute manager
   */
  abstract public function attrs(): HtmlAttributeManager;

  /**
   * Checks if the component has width defined
   * 
   * @return boolean true if the width is set and false otherwise
   */
  public function hasWidth(): bool {
    return $this->attrs()->exists('width');
  }

  /**
   * Returns the width of the component (in pixels)
   * 
   * *NOTE:* Check if the component has a width defined
   * 
   * @return int width of the component
   */
  public function getWidth(): int {
    return (int) $this->attrs()->get('width');
  }

  /**
   * Sets the width of the component (in pixels)
   * 
   * @param  int $width the width of the component (in pixels))
   * @return $this for a fluent interface
   */
  public function setWidth(int $width) {
    $this->attrs()->set('width', $width);
    return $this;
  }

  /**
   * Unsets the width of the component
   * 
   * @return $this for a fluent interface
   */
  public function unsetWidth() {
    $this->attrs()->remove('width');
    return $this;
  }

  /**
   * Returns the height of the component (in pixels)
   * 
   * *NOTE:* Check if the component has a width defined
   * 
   * @return int height of the component or `false` if not set
   */
  public function getHeight(): int {
    return (int) $this->attrs()->get('height');
  }
  /**
   * Checks if the component has height defined
   * 
   * @return boolean true if the height is set and false otherwise
   */
  public function hasHeight(): bool {
    return $this->attrs()->exists('height');
  }

  /**
   * Sets the height of the component (in pixels)
   * 
   * @param  int $height the height of the component (in pixels)
   * @return $this for a fluent interface
   */
  public function setHeight(int $height) {
    $this->attrs()->set('height', $height);
    return $this;
  }

  /**
   * Unsets the height of the component
   * 
   * @return $this for a fluent interface
   */
  public function unsetHeight() {
    $this->attrs()->remove('height');
    return $this;
  }

}
