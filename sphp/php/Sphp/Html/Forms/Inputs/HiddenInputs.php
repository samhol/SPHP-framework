<?php

/**
 * HiddenInputs.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\AbstractComponentGenerator;
use Sphp\Html\ContentInterface;
use ArrayAccess;
use Iterator;
use Sphp\Html\Container;

/**
 * Description of HiddenInputs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-05-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HiddenInputs extends AbstractComponentGenerator implements ContentInterface, ArrayAccess, Iterator {

  /**
   *
   * @var array
   */
  private $inputs;

  public function __construct() {
    $this->inputs = [];
  }

  public function generate() {
    $output = new Container();
    foreach ($this->inputs as $name => $value) {
      $output->offsetSet($name, new HiddenInput($name, $value));
    }
    return $output;
  }

  /**
   * Sets a hidden variable to the form
   *
   * The <var>$name => $value</var> pair is stored into a {@link HiddenInput} component.
   *
   * @param  string $name th name of the hidden variable
   * @param  scalar $value the value of the hidden variable
   * @return self for a fluent interface
   * @see    HiddenInput
   */
  public function setVariable($name, $value) {
    $this->inputs[$name] = $value;
    return $this;
  }

  /**
   * Sets the hidden data to the form
   *
   * Appended <var>$key => $value</var> pairs are stored into 
   *  {@link HiddenInput} components.
   *
   * @param  string[] $vars name => value pairs
   * @return self for a fluent interface
   * @see    HiddenInput
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
      $result = $this->components[$name];
    }
    return $result;
  }

  public function offsetSet($offset, $value) {
    $this->inputs[$offset] = $value;
  }

  public function offsetUnset($offset): void {
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
  public function valid() {
    return false !== current($this->inputs);
  }

}
