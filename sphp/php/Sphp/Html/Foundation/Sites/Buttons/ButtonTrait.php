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

  use SizeableTrait;

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
    if ($disabled) {
      $this->cssClasses()->add('disabled');
    } else {
      $this->cssClasses()->remove('disabled');
    }
    return $this;
  }

  /**
   * 
   * @param  boolean $dropdown
   * @return $this for a fluent interface
   */
  public function isDropdown(bool $dropdown = true) {
    if ($dropdown) {
      $this->cssClasses()->add('dropdown');
    } else {
      $this->cssClasses()->remove('dropdown');
    }
    return $this;
  }

  /**
   * 
   * @param  boolean $hollow
   * @return $this for a fluent interface
   */
  public function isHollow(bool $hollow = true) {
    if ($hollow) {
      $this->cssClasses()->add('hollow');
    } else {
      $this->cssClasses()->remove('hollow');
    }
    return $this;
  }

}
