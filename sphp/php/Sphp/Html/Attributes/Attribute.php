<?php

/**
 * IdentityAttribute.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;
use Sphp\Html\Attributes\Utils\AttributeValueValidatorInterface;

/**
 * Description of IdentityAttribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Attribute extends AbstractAttribute implements LockableAttributeInterface {

  /**
   * @var mixed 
   */
  private $value;

  /**
   * @var bool 
   */
  private $locked = false;

  /**
   * @var AttributeValueValidatorInterface|null 
   */
  private $validator;

  /**
   * Constructs a new instance
   *
   * @param  string $name the name of the attribute
   * @param  AttributeValueValidatorInterface $validator
   */
  public function __construct(string $name, $value = null, AttributeValueValidatorInterface $validator = null) {
    $this->validator = $validator;
    parent::__construct($name);
    if ($value !== null) {
      $this->set($value);
    }
  }

  public function isValidValue($value): bool {
    if ($this->validator !== null) {
      $isValid = $this->validator->isValidValue($value);
    } else {
      $isValid = is_scalar($value) || is_null($value);
    }
    return $isValid;
  }

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
    if (!$this->isValidValue($value)) {
      throw new InvalidAttributeException("Invalid value for '{$this->getName()}' attribute");
    }
    $this->value = $value;
    return $this;
  }

}
