<?php

/**
 * ValidableInputTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Attributes\AttributeManager as AttributeManager;

/**
 * A trait implementation of the {@link ValidableInputInterface} 
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @link    http://www.w3schools.com/tags/att_input_required.asp required attribute
 * @filesource
 */
trait RequireableInputTrait {

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
   * @link   http://www.w3schools.com/tags/att_input_required.asp required attribute
   * @return self for PHP Method Chaining
   */
  public function setRequired($required = true) {
    $this->attrs()->set("required", (bool) $required);
    return $this;
  }

  /**
   * Checks whether the input must have a value before form submission
   *
   * @return boolean true if the input must have a value before form submission, 
   *         otherwise false
   * @link   http://www.w3schools.com/tags/att_input_required.asp required attribute
   */
  public function isRequired() {
    return $this->attrs()->exists("required");
  }

}
