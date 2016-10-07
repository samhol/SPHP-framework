<?php

/**
 * ValidableInputTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Attributes\AttributeManager;

/**
 * A trait implementation of the {@link ValidableInputInterface} 
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ValidableInputTrait {

  /**
   * Returns the attribute manager attached to the component
   * 
   * @return AttributeManager the attribute manager
   */
  abstract public function attrs();

  /**
   * Sets whether the input must have a value or not before form submission
   * 
   * @param  boolean $required true if the input must have a value before form 
   *         submission, otherwise false
   * @return self for PHP Method Chaining
   */
  public function setRequired($required = true) {
    return $this->setAttr('required', $required);
  }

  /**
   * Checks whether the input must have a value before form submission
   *
   * @return boolean true if the input must have a value before form submission, 
   *         otherwise false
   */
  public function isRequired() {
    return $this->attrExists('required');
  }

}
