<?php

/**
 * VariableFilter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Filters;

/**
 * Filters a variable with a specified filter
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @link    http://php.net/manual/en/filter.filters.php filter_var
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class VariableFilter extends AbstractFilter {

  /**
   *
   * @var int 
   */
  private $filter;

  /**
   *
   * @var mixed[] 
   */
  private $options;

  /**
   * Constructs a new instance
   * 
   * @param int $filter
   * @param mixed[] $options
   * @link  http://php.net/manual/en/filter.filters.php filter_var
   * @link  http://php.net/manual/en/filter.filters.php Types of filters
   */
  public function __construct($filter, $options = []) {
    $this->filter = $filter;
    $this->options['options'] = $options;
  }

  public function getFilter() {
    return $this->filter;
  }

  public function getOptions() {
    return $this->options['options'];
  }

  /**
   * 
   * @return int
   */
  public function getFlags() {
    return $this->options['flags'];
  }

  /**
   * 
   * @param  int $filter
   * @return self for a fluent interface
   */
  protected function setFilter($filter) {
    $this->filter = $filter;
    return $this;
  }

  /**
   * Sets the option name value pair
   * 
   * @param  string $optName option name
   * @param  mixed $value
   * @return self for a fluent interface
   */
  protected function setOption($optName, $value) {
    $this->options['options'][$optName] = $value;
    return $this;
  }

  /**
   * Sets the option name value pair
   * 
   * @param  string $optName option name
   * @param  mixed $value
   * @return self for a fluent interface
   */
  protected function setFlags($flags) {
    $this->options['flags'] = $flags;
    return $this;
  }

  /**
   * 
   * @param  array $options
   * @return self for a fluent interface
   */
  protected function setOptions($options) {
    $this->options['options'] = $options;
    return $this;
  }

  public function filter($variable) {
    //print_r($this->options);
    
    return filter_var($variable, $this->filter, $this->options);
  }

}
