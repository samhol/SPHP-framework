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
 * Filters a variable with a specified filter
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://php.net/manual/en/filter.filters.php filter_var
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class VariableFilter extends AbstractFilter implements \ArrayAccess {

  /**
   * @var int 
   */
  private $filter;

  /**
   * @var mixed[] 
   */
  private $options;

  /**
   * @var mixed[] 
   */
  private $flags;

  /**
   * Constructor
   * 
   * @param int $filter
   * @param mixed[] $options
   * @link  http://php.net/manual/en/filter.filters.php filter_var
   * @link  http://php.net/manual/en/filter.filters.php Types of filters
   */
  public function __construct(int $filter, $options = []) {
    $this->filter = $filter;
    $this->options = $options;
  }

  public function __get($name) {
    if ($name === 'options') {
      return $this->options;
    }
    if ($name === 'flags') {
      return $this->flags;
    }
    if ($name === 'filter') {
      return $this->filter;
    }
    throw new \Sphp\Exceptions\InvalidArgumentException;
  }

  public function __set($name, $value) {
    if ($name === 'options') {
      $this->options = $value;
    }
    if ($name === 'flags') {
      $this->flags = $value;
    }
    throw new \Sphp\Exceptions\InvalidArgumentException;
  }

  public function getFilter() {
    return $this->filter;
  }

  public function getOptions() {
    return $this->options;
  }

  /**
   * 
   * @return int
   */
  public function getFlags() {
    return $this->flags;
  }

  /**
   * Sets the option name value pair
   * 
   * @param  string $optName option name
   * @param  mixed $value
   * @return $this for a fluent interface
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
   * @return $this for a fluent interface
   */
  protected function setFlags($flags) {
    $this->options['flags'] = $flags;
    return $this;
  }

  /**
   * 
   * @param  array $options
   * @return $this for a fluent interface
   */
  protected function setOptions($options) {
    $this->options['options'] = $options;
    return $this;
  }

  public function filter($variable) {
    //print_r($this->options);
    $options = [];
    if (isset($this->options)) {
      $options['options'] = $this->options;
    }
    if (isset($this->flags)) {
      $options['flags'] = $this->flags;
    }
    return filter_var($variable, $this->filter, $options);
  }

  public function offsetExists($offset): bool {
    return array_key_exists($offset, $this->options['options']);
  }

  public function offsetGet($offset) {
    if ($this->offsetExists($offset)) {
      return $this->options[$offset];
    }
    throw new \Sphp\Exceptions\OutOfBoundsException("Option $offset is not set");
  }

  public function offsetSet($offset, $value): void {
    $this->options['options'][$offset] = $value;
  }

  public function offsetUnset($offset): void {
    if ($this->offsetExists($offset)) {
      unset($this->options['options'][$offset]);
    }
  }

}
