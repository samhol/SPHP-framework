<?php

/**
 * IdentityAttribute.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;
use Sphp\Html\Attributes\Utils\AttributeValueValidatorInterface;
use Sphp\Html\Attributes\Utils\AttributeValueValidator;

/**
 * Description of IdentityAttribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Attribute extends AbstractAttribute {

  /**
   * @var string 
   */
  private $value;

  /**
   * @var bool 
   */
  private $locked = false;

  /**
   * @var AttributeDataParser 
   */
  private $valueFilter;

  /**
   * Constructs a new instance
   *
   * @param  string $name the name of the attribute
   * @param  mixed $value 
   * @throws InvalidAttributeException if the attribute value is invalid for the type of the attribute
   */
  public function __construct(string $name, $value = null, AttributeValueValidatorInterface $parser = null) {
    if ($parser === null) {
      $parser = new AttributeValueValidator();
    }
    $this->valueFilter = $parser;
    parent::__construct($name);
    if ($value !== null) {
      $this->set($value);
    }
  }

  public function getValueFilter(): AttributeValueValidator {
    return $this->valueFilter;
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
    if (!$this->getValueFilter()->isValid($value)) {
      throw new InvalidAttributeException("Invalid value for Attribute '{$this->getName()}' Attribute");
    }
    $this->value = $value;
    return $this;
  }

}
