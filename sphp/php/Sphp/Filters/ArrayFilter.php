<?php

/**
 * ArrayFilter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Filters;

/**
 * Filter converts a numeric input value to a corresponding roman numeral
 * 
 * * All non negative integer values remain unchanged. 
 * * value is considered as an integer if it contains only numbers
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @link    http://php.net/manual/en/filter.filters.php filter_var
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ArrayFilter extends AbstractFilter {

  /**
   *
   * @var mixed[]  
   */
  private $definition;

  /**
   *
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
   * @param type $key
   * @param type $min
   * @param type $max
   * @param type $default
   * @param type $flags
   * @return $this
   */
  public function validateInt($key, $min = null, $max = null, $default = null, $flags = 0) {
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

}
