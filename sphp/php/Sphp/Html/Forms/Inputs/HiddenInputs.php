<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\AbstractContent;
use ArrayAccess;
use Iterator;

/**
 * Implements hidden data component for HTML forms
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class HiddenInputs extends AbstractContent implements ArrayAccess, Iterator {

  /**
   * @var array
   */
  private $inputs;

  /**
   * Constructor
   */
  public function __construct() {
    $this->inputs = [];
  }
  
  public function __destruct() {
    unset($this->inputs);
  }

  public function getHtml(): string {
    $output = '';
    foreach ($this->inputs as $name => $value) {
      $output .= new HiddenInput($name, $value);
    }
    return $output;
  }

  /**
   * Sets a hidden variable to the form
   *
   * @param  string $name th name of the hidden variable
   * @param  scalar $value the value of the hidden variable
   * @return $this for a fluent interface
   */
  public function setVariable($name, $value) {
    $this->inputs[$name] = $value;
    return $this;
  }

  /**
   * Sets the hidden data to the form
   *
   * @param  string[] $vars name => value pairs
   * @return $this for a fluent interface
   */
  public function setVariables(array $vars) {
    foreach ($vars as $name => $value) {
      $this->setVariable($name, $value);
    }
    return $this;
  }

  public function offsetExists($offset): bool {
    return array_key_exists($offset, $this->inputs);
  }

  /**
   * Returns the value of the hidden variable
   *
   * @param  mixed $name the name of the hidden variable
   * @return mixed the value of the hidden variable or `null`
   */
  public function offsetGet($name) {
    $result = null;
    if ($this->offsetExists($name)) {
      $result = $this->inputs[$name];
    }
    return $result;
  }

  public function offsetSet($offset, $value) {
    $this->inputs[$offset] = $value;
  }

  public function offsetUnset($offset) {
    if ($this->offsetExists($offset)) {
      unset($this->inputs[$offset]);
    }
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->inputs);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->inputs);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->inputs);
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    reset($this->inputs);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->inputs);
  }

}
