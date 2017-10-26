<?php

/**
 * LockableAttributeInterface.php (UTF-8)
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
interface LockableAttributeInterface extends AttributeInterface {

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
   * Checks whether the attribute has a locked value or not
   * 
   * @return boolean true if the attribute has a locked value and false otherwise
   */
  public function isLocked(): bool;

  /**
   * Locks the given value to the attribute
   *
   * @param  scalar $value the value to lock to the attribute
   * @return $this for a fluent interface
   * @throws AttributeException if the attribute value is invalid for the type of the attribute
   * @throws ImmutableAttributeException if the attribute value is unmodifiable
   */
  public function lock($value);
}
