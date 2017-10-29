<?php

/**
 * Attribute.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;
use Sphp\Html\Attributes\Utils\AttributeValueValidatorInterface;

/**
 * Default implementation of an attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Attribute extends AbstractScalarAttribute {

  /**
   * @var AttributeValueValidatorInterface|null 
   */
  private $validator;

  /**
   * Constructs a new instance
   *
   * @param string $name the name of the attribute
   * @param mixed $value value to set
   * @param AttributeValueValidatorInterface $validator
   */
  public function __construct(string $name, $value = null, AttributeValueValidatorInterface $validator = null) {
    $this->validator = $validator;
    parent::__construct($name);
    if ($value !== null) {
      $this->set($value);
    }
  }

  public function filterValue($value) {
    if ($this->validator !== null) {
      $isValid = $this->validator->isValidValue($value);
    } else {
      $isValid = is_scalar($value) || is_null($value);
    }
    if (!$isValid) {
      throw new InvalidAttributeException("Invalid value for '{$this->getName()}' attribute");
    }
    return $value;
  }

}
