<?php

/**
 * ButtonTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

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

  use SizeableTrait,
      \Sphp\Html\Foundation\Sites\Core\ColourableTrait;


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
   * 
   * @param  boolean $dropdown
   * @return $this for a fluent interface
   */
  public function isDropdown(bool $dropdown = true) {
    $this->setBoolean($dropdown, 'dropdown');
    return $this;
  }

  /**
   * 
   * @param  boolean $hollow
   * @return $this for a fluent interface
   */
  public function isHollow(bool $hollow = true) {
    $this->setBoolean($hollow, 'hollow');
    return $this;
  }

}
