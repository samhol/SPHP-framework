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
 * Filter converts a numeric input value to a corresponding roman numeral
 * 
 * * All non negative integer values remain unchanged. 
 * * value is considered as an integer if it contains only numbers
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://php.net/manual/en/filter.filters.php filter_var
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ArraySamitizer extends AbstractFilter {

  /**
   * @var mixed[]  
   */
  private $definition;

  /**
   * @var array
   */
  private $rejectedValues = [];

  /**
   * @var array
   */
  private $allowedValues = [];

  /**
   * @var array
   */
  private $passUnchanged = [];

  /**
   * @var boolean
   */
  private $addEmpty;

  /**
   * Constructor
   * 
   * @param mixed[] $definition an array defining the arguments
   * @param boolean $addEmpty
   * @link  http://php.net/manual/en/function.filter-var-array.php filter_var_array
   * @link  http://php.net/manual/en/filter.filters.php Types of filters
   */
  public function __construct(array $definition = [], bool $addEmpty = true) {
    $this->definition = $definition;
    $this->addEmpty = $addEmpty;
  }

  public function rejectThese(...$value) {
    $this->rejectedValues = $value;
    return $this;
  }

  public function passUnchanged(...$key) {
    $this->passUnchanged = $key;
    return $this;
  }

  public function allowThese(...$value) {
    $this->allowedValues = $value;
    return $this;
  }

  public function getDefinition() {
    return $this->definition;
  }

  public function getAddEmpty() {
    return $this->addEmpty;
  }

  public function setDefinition($definition) {
    $this->definition = $definition;
    return $this;
  }

  public function setAddEmpty($addEmpty) {
    $this->addEmpty = $addEmpty;
    return $this;
  }

  public function setFilter($callable, ...$key) {
    foreach ($key as $k) {
      $this->definition[$k] = $callable;
    }
    return $this;
  }

  public function stringOnly(...$key) {
    $this->definition[$key] = $key;
    return $this;
  }

  /**
   * 
   * @param  type $key
   * @param  int $min
   * @param  int $max
   * @param  int $default
   * @param  type $flags
   * @return $this
   */
  public function validateInt($key, int $min = null, int $max = null, int $default = null, $flags = 0) {
    $opts = [];
    if (is_int($min)) {
      $opts['min_range'] = $min;
    } if (is_int($max)) {
      $opts['max_range'] = $max;
    } if (is_int($default)) {
      $opts['default'] = $default;
    }
    $this->setFilter($key, FILTER_VALIDATE_INT, $flags, $opts);
    return $this;
  }

  public function filter($variable) {
    $result = [];
    foreach ($variable as $key => $val) {
      if (in_array($key, $this->passUnchanged) || in_array($val, $this->allowedValues)) {
        $result[$key] = $val;
      } else if (array_key_exists($key, $this->definition) && !in_array($variable[$key], $this->rejectedValues)) {
        $filter = $this->definition[$key];
        $result[$key] = $filter($variable[$key]);
      }
    }
    return $result;
  }

  public function filterGet(): array {
    return filter_input_array(INPUT_GET, $this->definition, $this->addEmpty);
  }

  public function filterPost(): array {
    return filter_input_array(INPUT_POST, $this->definition, $this->addEmpty);
  }

}
