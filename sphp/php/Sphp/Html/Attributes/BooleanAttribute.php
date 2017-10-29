<?php

/**
 * BooleanAttribute.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

/**
 * Implements a boolean attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-10-24
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BooleanAttribute extends AbstractScalarAttribute {

  /**
   * Constructs a new instance
   * 
   * @param string $name
   * @param type $value
   */
  public function __construct(string $name, $value = true) {
    parent::__construct($name);
    $this->set($value);
  }

  public function filterValue($value) {
    $filtered = filter_var($value, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE);
    if ($filtered === null) {
      throw new InvalidAttributeException("Invalid value for '{$this->getName()}' boolean attribute");
    }
    return $filtered;
  }

}
