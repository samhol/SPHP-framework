<?php

/**
 * ButtonTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\Attributes\ClassAttribute;

/**
 * Trait implements {@link ButtonInterface} functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/buttons.html Foundation Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ButtonTrait {

  use \Sphp\Html\Foundation\Sites\Core\ColourableTrait;

  /**
   * Sets the button style as disabled
   * 
   * This is purely a visual style
   *
   * @param  boolean $disabled true if the button is disabled, otherwise false
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/sites/docs/button.html#dropdown-arrows
   */
  public function disable(bool $disabled = true) {
    $this->setBoolean($disabled, 'disabled');
    return $this;
  }

  /**
   * Sets/unsets dropdown style
   * 
   * @param  boolean $dropdown
   * @return $this for a fluent interface
   */
  public function isDropdown(bool $dropdown = true) {
    $this->setBoolean($dropdown, 'dropdown');
    return $this;
  }

  /**
   * Sets/unsets hollow style
   * 
   * @param  boolean $hollow
   * @return $this for a fluent interface
   */
  public function isHollow(bool $hollow = true) {
    $this->setBoolean($hollow, 'hollow');
    return $this;
  }

  /**
   * CSS classes corresponding to the size constants
   *
   * @var string[]
   */
  private static $sizes = [
      'tiny', 'small', 'large'
  ];

  /**
   * Returns the class attribute object
   * 
   * @return ClassAttribute the class attribute object
   */
  abstract public function cssClasses(): ClassAttribute;

  /**
   * Sets the size of the button 
   * 
   * Predefined values of <var>$size</var> parameter:
   * 
   * * `null´ for "medium" (default) size
   * * `'tiny'` for tiny size
   * * `'small'` for small size
   * * `'large'` for large size
   * 
   * @param  string $size optional CSS class name defining button size. 
   *         `medium` value corresponds to no explicit size definition.
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-sizing Button Sizing
   */
  public function setSize(string $size = null) {
    $this->setOneOf(static::$sizes, $size);
    return $this;
  }

  public function setExtended(bool $extended = true) {
    $this->setBoolean($extended, 'expanded');
    return $this;
  }

}
