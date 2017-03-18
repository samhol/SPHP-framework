<?php

/**
 * IntegerFilter.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Filters;

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
   * 
   * @param type $min
   * @param type $max
   * @param type $default
   */
  public function __construct($min = null, $max = null, $default = null) {
    parent::__construct(FILTER_VALIDATE_INT);
    if ($min !== null) {
      $this->setMin($min);
    }
    if ($max !== null) {
      $this->setMin($max);
    }
    if ($default !== null) {
      $this->setMin($default);
    }
  }


  /**
   * 
   * @param  int $min
   * @return $this
   */
  public function setMin($min) {
    $this->setOption('min_range', (int) $min);
    return $this;
  }

  /**
   * 
   * @param  int $max
   * @return $this
   */
  public function setMax($max) {
    $this->setOption('max_range', (int) $max);
    return $this;
  }

  /**
   * 
   * @param type $default
   * @return $this
   */
  public function setDefault($default) {
    $this->setOption('default', $default);
    return $this;
  }

}
