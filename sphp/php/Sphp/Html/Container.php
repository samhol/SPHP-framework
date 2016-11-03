<?php

/**
 * Container.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use IteratorAggregate;
use Sphp\Core\Types\Arrays;
use ArrayIterator;
use Traversable;

/**
 * Class implements a container for HTML components and other textual content
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-09
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Container implements IteratorAggregate, ContainerInterface, ContentParserInterface {

  use ContentTrait,
      ContentParsingTrait,
      TraversableTrait;

  /**
   * container's content
   *
   * @var mixed[]
   */
  private $components;

  /**
   * Constructs a new instance
   *
   * @param  mixed $content added content
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($content = null) {
    $this->components = [];
    if ($content !== null) {
      $this->append($content);
    }
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->components);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->components = Arrays::copy($this->components);
  }

  public function append($content) {
    $this->components[] = $content;
    return $this;
  }

  public function prepend($content) {
    array_unshift($this->components, $content);
    return $this;
  }

  /**
   * Count the number of inserted elements in the container
   *
   * @return int number of elements in the html component
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count() {
    return count($this->components);
  }

  /**
   * Create a new iterator to iterate through inserted elements in the html component
   *
   * @return Traversable iterator
   */
  public function getIterator() {
    return new ArrayIterator($this->components);
  }

  /**
   * Checks whether an offset exists
   *
   * @param  mixed $offset an offset to check for
   * @return boolean true on success or false on failure
   */
  public function offsetExists($offset) {
    return array_key_exists($offset, $this->components);
  }

  /**
   * Returns the content element at the specified offset
   *
   * @param  mixed $offset the index with the content element
   * @return mixed content element or null
   */
  public function offsetGet($offset) {
    $result = null;
    if ($this->offsetExists($offset)) {
      $result = $this->components[$offset];
    }
    return $result;
  }

  /**
   * Assigns content to the specified offset
   *
   * @param  mixed $offset the offset to assign the value to
   * @param  mixed $value the value to set
   * @return self for PHP Method Chaining
   */
  public function offsetSet($offset, $value) {
    if (is_null($offset)) {
      $this->components[] = $value;
    } else {
      $this->components[$offset] = $value;
    }
    return $this;
  }

  /**
   * Unsets an offset
   *
   * @param  mixed $offset offset to unset
   * @return self for PHP Method Chaining
   */
  public function offsetUnset($offset) {
    if ($this->offsetExists($offset)) {
      unset($this->components[$offset]);
    }
    return $this;
  }

  public function toArray() {
    return $this->components;
  }

  /**
   * Replaces the content of the component
   *
   * @param  mixed $content new tag content
   * @return self for PHP Method Chaining
   */
  public function replaceContent($content) {
    return $this->clear()->append($content);
  }

  public function clear() {
    $this->components = [];
    return $this;
  }

  public function getHtml() {
    return Arrays::implode($this->components);
  }

  public function exists($value) {
    $result = false;
    foreach ($this->components as $component) {
      if ($component === $value || (($component instanceof ContainerInterface)) && $component->exists($value)) {
        $result = true;
        break;
      }
    }
    return $result;
  }

}
