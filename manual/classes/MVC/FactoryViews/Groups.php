<?php

/**
 * Groups.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\FactoryViews;

use Iterator;

/**
 * Description of Groups
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Groups implements Iterator {

  /**
   * @var Group[] 
   */
  private $data = [];

  public function __construct(array $raw) {
    $this->parseFactory($raw);
  }

  public function __destruct() {
    unset($this->data);
  }

  public function parseFactory(array $raw) {
    foreach ($raw as $factoryClass => $groups) {
      $this->parseGroupsFor($factoryClass, $groups);
    }
  }

  public function parseGroupsFor(string $factoryClass, array $groups) {
    foreach ($groups as $groupName => $data) {
      $this->createGroupFor($factoryClass, $groupName, $data);
    }
  }

  public function groupExists($offset): bool {
    return isset($this->data[$offset]);
  }

  public function createGroupFor(string $factoryClass, string $groupName, array $value) {
    $this->data[] = new Group($factoryClass, $groupName, $value);
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
