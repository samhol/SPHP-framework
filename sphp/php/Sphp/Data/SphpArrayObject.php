<?php

/**
 * SphpArrayObject.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Data;

use \ArrayObject as ArrayObject;

/**
 * Provides accessing objects as arrays
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-05-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SphpArrayObject extends ArrayObject implements CollectionInterface {

  use ArrayAccessExtensionTrait;

  /**
   * Constructs a new instance of {@link self} object
   *
   * **Note:** $value can be of any type
   *
   * @param mixed $value the value being appended
   */
  public function __construct($value = null) {
    if ($value !== null) {
      if (!is_array($value) && !is_object($value)) {
        parent::__construct(array($value));
      } else {
        parent::__construct($value);
      }
    } else {
      parent::__construct();
    }
  }

  /**
   * {@inheritdoc}
   */
  public function append($value) {
    parent::append($value);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function prepend($value) {
    $array = (array) $this;
    array_unshift($array, $value);
    $this->exchangeArray($array);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function clear() {
    $this->exchangeArray(array());
    return $this;
  }

  /**
   * Sets the value at the specified index
   *
   * @param  mixed $offset the offset to assign the value to
   * @param  mixed $value the value to set
   * @return self for PHP Method Chaining
   */
  public function offsetSet($offset, $value) {
    parent::offsetSet($offset, $value);
    return $this;
  }

  /**
   * Unset the value at a given offset
   *
   * @param  mixed $offset the offset to unset
   * @return self for PHP Method Chaining
   */
  public function offsetUnset($offset) {
    parent::offsetUnset($offset);
    return $this;
  }

  /**
   * Returns the value at the specified index
   *
   * @postcondition unlike the {@link \ArrayObject} no error messages gets
   *               produced when the specified index does not exist.
   * @param  mixed $offset the index with the content element
   * @return mixed|null content element or null if the offset does not exist
   */
  public function offsetGet($offset) {
    $result = null;
    if ($this->offsetExists($offset)) {
      $result = parent::offsetGet($offset);
    }
    return $result;
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    foreach ($this as $key => $content) {
      if (is_object($content)) {
        $this[$key] = clone $content;
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function toArray() {
    return (array) $this;
  }

}
