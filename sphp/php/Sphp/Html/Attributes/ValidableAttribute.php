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
class ValidableAttribute extends AbstractAttribute implements LockableAttributeInterface {

  const INT = 0b000001;
  const FLOAT = 0b000011;
  const STRING = 0b000100;
  const BOOL = 0b001000;
  const SIGNED = 0b010000;
  const UNSSIGNED = 0b100000;
  CONST SCALAR = 0b111111;
  CONST REGEXP = 'regexp';

  /**
   * @var mixed 
   */
  private $value;

  /**
   * @var bool 
   */
  private $locked = false;

  /**
   * @var mixed
   */
  private $options;
  private $type;

  /**
   * Constructs a new instance
   *
   * @param string $name the name of the attribute
   * @param mixed $value value to set
   * @param array $settings
   */
  public function __construct(string $name, $type = self::SCALAR, $options = null) {
    $this->type = $type;
    $this->options = $options;
    parent::__construct($name);
  }

  public function isValidValue($value): bool {
    switch ($this->type) {
      case self::REGEXP:
        $isValid = \Sphp\Stdlib\Strings::match($value, $this->options);
        break;

      default:
        $isValid = is_scalar($value) || is_null($value);
        break;
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
      throw new InvalidAttributeException("Value '$value' is invalid for '{$this->getName()}' attribute");
    }
    $this->value = $value;
    return $this;
  }

  public static function regexp(string $name, string $pattern): AttributeInterface {
    return new static($name, self::REGEXP, $pattern);
  }

}
