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

/**
 * Implements an integer attribute with optional valid range
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class IntegerAttribute extends AbstractScalarAttribute {

  /**
   * @var array 
   */
  private $options = [];

  /**
   * Constructor
   *
   * @param string $name the name of the attribute
   * @param int|null $min optional minimum value
   * @param int|null $max optional maximum value
   */
  public function __construct(string $name, int $min = null, int $max = null) {
    parent::__construct($name);
    if ($min !== null) {
      $this->options['options']['min_range'] = $min;
    }
    if ($max !== null) {
      $this->options['options']['max_range'] = $max;
    }
  }

  public function filterValue($value) {
    if ($value === null || $value === false) {
      $filtered = null;
    } else {
      $filtered = filter_var($value, \FILTER_VALIDATE_INT, $this->options);
      if ($filtered === false) {
        throw new InvalidArgumentException("Invalid value for '{$this->getName()}' integer attribute");
      }
    }
    return $filtered;
  }

}
