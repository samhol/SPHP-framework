<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

/**
 * Implements a regular expression validable attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PatternAttribute extends AbstractScalarAttribute {

  /**
   * @var string
   */
  private $pattern;

  /**
   * Constructs a new instance
   *
   * @param string $name the name of the attribute
   * @param string $pattern 
   */
  public function __construct(string $name, string $pattern = '//') {
    $this->pattern = $pattern;
    parent::__construct($name);
  }

  public function filterValue($value) {
    $filtered = filter_var($value, \FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $this->pattern]]);
    if (!$filtered) {
      throw new InvalidAttributeException("Invalid value for '{$this->getName()}' pattern attribute");
    }
    return $value;
  }

}
