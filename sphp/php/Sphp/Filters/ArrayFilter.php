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
class ArrayFilter extends AbstractFilter {

  /**
   * @var mixed[]  
   */
  private $definition;

  /**
   * @var boolean
   */
  private $addEmpty;

  /**
   * Constructs a new instance
   * 
   * @param mixed[] $definition an array defining the arguments
   * @param boolean $add_empty
   * @link  http://php.net/manual/en/function.filter-var-array.php filter_var_array
   * @link  http://php.net/manual/en/filter.filters.php Types of filters
   */
  public function __construct(array $definition = [], $add_empty = true) {
    $this->definition = $definition;
    $this->addEmpty = $add_empty;
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

  public function setFilter($key, $filter, $flags = 0, $options = []) {
    $def = array('filter' => $filter,
        'flags' => $flags,
        'options' => $options
    );
    $this->definition[$key] = $def;
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

  public function setCallable($key, $filter) {
    if (is_callable($filter)) {
      $definition = array('filter' => FILTER_CALLBACK,
          'options' => $filter);
      $this->setFilter($key, $definition);
    }
    return $this;
  }

  public function filter($variable) {
    if (!is_array($variable)) {
      $variable = [];
    }
    return filter_var_array($variable, $this->definition, $this->addEmpty);
  }

  public function filterGet(): array {
    return filter_input_array(INPUT_GET, $this->definition, $this->addEmpty);
  }

  public function filterPost(): array {
    return filter_input_array(INPUT_POST, $this->definition, $this->addEmpty);
  }

}
