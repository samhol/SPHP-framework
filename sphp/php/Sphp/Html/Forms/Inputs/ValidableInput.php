<?php

/**
 * Validable.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Defines basic functionality of all validable inputs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ValidableInput extends Input {

  /**
   * Sets whether the input must have a value or not before form submission
   * 
   * @param  boolean $required true if the input must have a value before form 
   *         submission, otherwise false
   * @return $this for a fluent interface
   */
  public function setRequired(bool $required = true);

  /**
   * Checks whether the input must have a value before form submission
   *
   * @return boolean true if the input must have a value before form submission, 
   *         otherwise false
   */
  public function isRequired(): bool;
}


