<?php

/**
 * ContainerComponentTrait.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Traversable;

/**
 * Class is the base class for all HTML tag components acting as HTML component containers
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-10-03
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ContainerComponentTrait {

  /**
   * Returns the content container or an element pointed by an optional index
   *
   * @return ContainerInterface the inner content container
   */
  abstract protected function getInnerContainer();

  /**
   * Appends content to the component
   *
   * **Important!**
   *
   * Parameter `mixed $content` can be of any type and get converted to PHP
   * strings.
   *
   * **HOWEVER:** `$content` is bound by the
   * properties and purpose of the actual HTML structure the component
   * represents.
   *
   * @param  mixed|mixed[] $content added content
   * @return self for a fluent interface
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function append($content) {
    $this->getInnerContainer()->append($content);
    return $this;
  }

  /**
   * Prepends elements to the html component
   *
   * **Important!**
   *
   * Parameter `mixed $content` can be of any type that converts to a
   * string. So also an object of any class that implements magic method
   * `__toString()` is allowed.
   *
   * **HOWEVER:** `$content` is bound by the
   * properties and purpose of the actual HTML structure the component
   * represents.
   *
   * **Note:** the numeric keys of the content will be renumbered starting from zero
   *
   * @param  mixed|mixed[] $content added content
   * @return self for a fluent interface
   */
  public function prepend($content) {
    $this->getInnerContainer()->prepend($content);
    return $this;
  }
  public function setContent($content) {
    $this->getInnerContainer()->setContent($content);
    return $this;
  }

  /**
   * Counts the number of elements in the container
   *
   * @return int the number of elements in the container
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count() {
    return $this->getInnerContainer()->count();
  }

  /**
   * Create a new iterator to iterate through inserted elements in the container
   *
   * @return Traversable iterator
   */
  public function getIterator() {
    return $this->getInnerContainer();
  }

  public function offsetExists($offset) {
    return $this->getInnerContainer()->offsetExists($offset);
  }

  /**
   * Returns the content element at the specified offset
   *
   * @param  mixed $offset the index with the content element
   * @return mixed content element or null
   */
  public function offsetGet($offset) {
    return $this->getInnerContainer()->offsetGet($offset);
  }

  /**
   * Assigns content to the specified offset
   *
   * **Important!**
   *
   * Parameter `mixed $value` can be of any type that converts to a
   * string. So also an object of any class that implements magic method
   * `__toString()` is allowed.
   *
   * @param mixed $offset the offset to assign the value to
   * @param mixed $value the value to set
   */
  public function offsetSet($offset, $value) {
    $this->getInnerContainer()->offsetSet($offset, $value);
    return $this;
  }

  /**
   * Unsets an offset
   *
   * @param mixed $offset offset to unset
   */
  public function offsetUnset($offset) {
    $this->getInnerContainer()->offsetUnset($offset);
    return $this;
  }

  /**
   * Replaces the content of the component
   *
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a string or an array of strings.
   * So also an object of any class that implements magic method `__toString()` is allowed.
   *
   * @param  mixed $content new content
   * @return self for a fluent interface
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function replaceContent($content) {
    $this->getInnerContainer()->replaceContent($content);
    return $this;
  }

  public function toArray() {
    return $this->getInnerContainer()->toArray();
  }

  public function clear() {
    $this->getInnerContainer()->clear();
    return $this;
  }

  public function exists($value) {
    $this->getInnerContainer()->exists($value);
  }

}
