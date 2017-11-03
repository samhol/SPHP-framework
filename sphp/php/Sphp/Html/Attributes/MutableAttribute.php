<?php

/**
 * MutableAttribute.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

/**
 * Defines an HTML attribute object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface MutableAttribute extends AttributeInterface {

  /**
   * Sets the value of the attribute
   *
   * @param  mixed $value value to set
   * @return $this for a fluent interface
   * @throws AttributeException if the attribute value is invalid for the type of the attribute
   * @throws ImmutableAttributeException if the attribute value is unmodifiable
   */
  public function set($value);

  /**
   * Removes all non locked values from the attribute
   *
   * @return $this for PHP Method Chaining
   */
  public function clear();

  /**
   * Sets the attribute as required
   *  
   * **A required attribute cannot be removed** but its value is still mutable.
   * 
   * @return $this for a fluent interface
   */
  public function demand();

  /**
   * Checks whether the attribute is required or not
   * 
   * **Note:** a required attribute either has locked value or the attribute 
   * name is required.
   *
   * @return boolean true if the attribute is required and false otherwise
   */
  public function isDemanded(): bool;
}
