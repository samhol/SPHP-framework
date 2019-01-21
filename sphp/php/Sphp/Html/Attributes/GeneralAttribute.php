<?php

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
 * Default implementation of an attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class GeneralAttribute extends AbstractAttribute {

  /**
   * @var scalar|null 
   */
  private $value = false;

  
  private $defaultValue = null;
  /**
   * Constructor
   *
   * @param string $name the name of the attribute
   * @param scalar|null $value optional value of the attribute
   */
  public function __construct(string $name, $value = false) {
    parent::__construct($name);
    if ($value !== false) {
      $this->setValue($value);
    }
  }

  public function setDefaultValue($defaultValue) {
    $this->defaultValue = $defaultValue;
    return $this;;
  }


  public function setValue($value) {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException("Attribute '{$this->getName()}' is immutable");
    }
    if (!is_scalar($value) && $value !== null) {
      throw new InvalidArgumentException("Invalid value for '{$this->getName()}' attribute");
    }
    $this->value = $value;
    return $this;
  }

  public function getValue() {
    return $this->value;
  }

  public function clear() {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException("Attribute '{$this->getName()}' is immutable");
    }
    $this->value = false;
    return $this;
  }

  public function isBoolean(): bool {
    return is_bool($this->value);
  }

}
