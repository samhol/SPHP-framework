<?php

/**
 * Attribute.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

/**
 * Implements a regular expression validable attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
