<?php

/**
 * Groups.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\TagListing;

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
   *
   * @var Group[] 
   */
  private $data = [];

  public function __construct(array $raw) {
    $this->parseGroups($raw);
  }

  public function __destruct() {
    unset($this->data);
  }

  public function parseGroups(array $raw) {
    foreach ($raw as $offset => $value) {
      $this->offsetSet($offset, $value);
    }
  }

  public function groupExists($offset): bool {
    return isset($this->data[$offset]);
  }

  public function getGroup($offset) {
    if ($this->groupExists($offset)) {
      return $this->data[$offset];
    }
    return null;
  }

  public function offsetSet(string $offset, array $value) {
    $this->data[$offset] = new Group($offset, $value);
  }

  public function removeGroup(string $offset) {
    if ($this->groupExists($offset)) {
      unset($this->data[$offset]);
    }
    return $this;
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
