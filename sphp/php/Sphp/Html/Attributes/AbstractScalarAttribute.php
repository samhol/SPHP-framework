<?php

/**
 * Attribute.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;
use Sphp\Html\Attributes\Utils\AttributeValueValidatorInterface;

/**
 * Default implementation of an attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractScalarAttribute extends AbstractAttribute implements LockableAttributeInterface {

  /**
   * @var mixed 
   */
  private $value;

  /**
   * @var bool 
   */
  private $locked = false;

  abstract public function filterValue($value);

  public function clear() {
    if ($this->isLocked()) {
      throw new ImmutableAttributeException("Attribute '{$this->getName()}' is immutable");
    }
    $this->value = null;
    return $this;
  }

  public function getValue() {
    return $this->value;
  }

  public function isLocked(): bool {
    return $this->locked;
  }

  public function lock($value) {
    $this->set($value);
    $this->locked = true;
    return $this;
  }

  public function set($value) {
    if ($this->isLocked()) {
      throw new ImmutableAttributeException("Attribute '{$this->getName()}' is immutable");
    }
    $this->value = $this->filterValue($value);
    return $this;
  }

}
