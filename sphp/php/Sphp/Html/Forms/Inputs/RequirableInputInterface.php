<?php

/**
 * RequirableInputInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Interface defines required operations for all validable input components used in {@link FormInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-02-15
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://www.w3schools.com/tags/att_input_required.asp required attribute
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface RequirableInputInterface extends InputInterface {

  /**
   * Sets whether the input must have a value or not before form submission
   * 
   * @param  boolean $required true if the input must have a value before form 
   *         submission, otherwise false
   * @link   http://www.w3schools.com/tags/att_input_required.asp required attribute
   * @return self for PHP Method Chaining
   */
  public function setRequired($required = true);

  /**
   * Checks whether the input must have a value before form submission
   *
   * @return boolean true if the input must have a value before form submission, 
   *         otherwise false
   * @link   http://www.w3schools.com/tags/att_input_required.asp required attribute
   */
  public function isRequired();
}
