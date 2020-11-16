<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

/**
 * Defines a mutable HTML attribute object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface MutableAttribute extends Attribute {

  /**
   * Sets the value of the attribute
   *
   * @param  mixed $value value to set
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the attribute value is invalid for the type of the attribute
   * @throws ImmutableAttributeException if the attribute value is unmodifiable
   */
  public function setValue($value);

  /**
   * Protects the given value to the attribute
   *
   * @param  scalar $value the value to lock to the attribute
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the attribute value is invalid for the type of the attribute
   * @throws ImmutableAttributeException if the attribute value is unmodifiable
   */
  public function protectValue($value);

  /**
   * Checks whether the attribute is required or not
   * 
   * **Note:** a required attribute either has locked value or the attribute 
   * name is required.
   *
   * @return boolean true if the attribute is required and false otherwise
   */
  public function isDemanded(): bool;

  /**
   * Clears all unprotected values
   *
   * @return $this for a fluent interface
   */
  public function clear();
}
