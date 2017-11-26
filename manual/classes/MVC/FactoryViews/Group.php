<?php

/**
 * Group.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\FactoryViews;

/**
 * Description of Groups
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Group implements \Iterator {

  /**
   * @var string 
   */
  private $name;

  /**
   * @var Group[] 
   */
  private $data = [];

  public function __construct(string $factoryClass, string $name, array $raw) {
    $this->f = $factoryClass;
    $this->setName($name);
    $this->parse($raw);
  }

  private function parse(array $raw) {
    foreach ($raw as $offset => $value) {
      $this->setFactoryMethodData($this->f, $offset, $value);
    }
  }

  public function __destruct() {
    unset($this->data);
  }

  public function getName(): string {
    return $this->name;
  }

  public function setName(string $name) {
    $this->name = $name;
    return $this;
  }

  public function hasGroup($offset): bool {
    return isset($this->data[$offset]);
  }

  public function offsetGet($offset) {
    if ($this->hasGroup($offset)) {
      return $this->data[$offset];
    }
    throw new \Exception('data does not exist');
  }

  public function setFactoryMethodData($factoryClass,$offset, $value) {
    $this->data[$offset] = new FactoryMethodData($factoryClass, $offset, $value);
  }

  public function offsetUnset($offset) {
    if ($this->hasGroup($offset)) {
      unset($this->data[$offset]);
    }
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->data);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->data);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->data);
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    reset($this->data);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->data);
  }

}
