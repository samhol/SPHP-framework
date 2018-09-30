<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

/**
 * Filter converts value to an integer
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class IntegerFilter extends VariableFilter {

  private $round = \PHP_ROUND_HALF_UP;

  /**
   * Constructor
   * 
   * @param int|null $default optional default value
   * @param int|null $min optional minimum value
   * @param int|null $max optional maximum value
   */
  public function __construct($default = null, int $min = null, int $max = null) {
    parent::__construct(\FILTER_VALIDATE_INT);
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

  public function setRounding($round = PHP_ROUND_HALF_UP) {
    $this->round = $round;
    return $this;
  }

  /**
   * 
   * @param  int $min the  minimum value of the integer
   * @return $this for a fluent interface
   */
  public function setMin(int $min = null) {
    $this['options']['min_range'] = $min;
    return $this;
  }

  /**
   * 
   * @param  int $max the  maximum value of the integer
   * @return $this for a fluent interface
   */
  public function setMax(int $max = null) {
    $this['options']['max_range'] = $max;
    return $this;
  }

  /**
   * 
   * @param  mixed $default
   * @return $this for a fluent interface
   */
  public function setDefault($default) {
    $this->setOption('default', $default);
    return $this;
  }

  public function filter($variable) {
    if (is_object($variable) && method_exists($variable, '__toString')) {
      $variable = strval($variable);
    }
    if (!is_numeric($variable)) {
      $variable = null;
      echo "\nperkele:" . $variable . "\n";
    } else {
      $variable = round($variable, 0, $this->round);
    }
    return parent::filter($variable);
  }

}
