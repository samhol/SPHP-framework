<?php

/**
 * IntegerFilter.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Filters;

/**
 * Filter converts value to an integer
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class IntegerFilter extends VariableFilter {

  /**
   * Constructs a new instance
   * 
   * @param int|null $default optional default value
   * @param int|null $min optional minimum value
   * @param int|null $max optional maximum value
   */
  public function __construct($default = null, $min = null, $max = null) {
    parent::__construct(FILTER_VALIDATE_INT);
    if ($min !== null) {
      $this->setMin($min);
    }
    if ($max !== null) {
      $this->setMax($max);
    }
    if ($default !== null) {
      $this->setDefault($default);
    }
  }

  /**
   * 
   * @param  int $min the  minimum value of the integer
   * @return self for a fluent interface
   */
  public function setMin($min) {
    $this->setOption('min_range', (int) $min);
    return $this;
  }

  /**
   * 
   * @param  int $max the  maximum value of the integer
   * @return self for a fluent interface
   */
  public function setMax($max) {
    $this->setOption('max_range', (int) $max);
    return $this;
  }

  /**
   * 
   * @param  mixed $default
   * @return self for a fluent interface
   */
  public function setDefault($default) {
    $this->setOption('default', $default);
    return $this;
  }

}
