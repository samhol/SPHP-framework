<?php

/**
 * IntegerAttribute.php (UTF-8)
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
class IntegerAttribute extends Attribute {

  /**
   * @var AttributeValueValidatorInterface|null 
   */
  private $range = [];

  /**
   * Constructs a new instance
   *
   * @param string $name the name of the attribute
   * @param int|null $min
   * @param int|null $max
   */
  public function __construct(string $name, int $min = null, int $max = null) {
    parent::__construct($name);
    if ($min !== null) {
      $this->range['options']['min_range'] = $min;
    }
    if ($max !== null) {
      $this->range['options']['max_range'] = $max;
    }
  }

  public function isValidValue($value): bool {
    return filter_var($value, \FILTER_VALIDATE_INT, $this->range) !== false;
  }

}
