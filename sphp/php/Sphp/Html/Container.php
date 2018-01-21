<?php

/**
 * Container.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use IteratorAggregate;
use Sphp\Stdlib\Arrays;
use Traversable;

/**
 * Implements a container for HTML components and other textual content
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Container implements IteratorAggregate, ContainerInterface, ContentParser {

  use ContentTrait,
      ContentParsingTrait,
      TraversableTrait;

  /**
   * content
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

  public function append(...$content) {
    foreach (Arrays::flatten($content) as $cont) {
      $this->components[] = $cont;
    }

    return $this;
  }

  public function prepend($content) {
    array_unshift($this->components, $content);
    return $this;
  }

  public function setContent($content) {
    $this->clear()->append($content);
    return $this;
  }

  /**
   * Count the number of inserted elements in the container
   *
   * @return int number of elements in the html component
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
    return count($this->components);
  }

  /**
   * Checks whether an offset exists
   *
   * @param  mixed $offset an offset to check for
   * @return boolean true on success or false on failure
   */
  public function offsetExists($offset): bool {
    return isset($this->components[$offset]) || array_key_exists($offset, $this->components);
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
   * @return void
   */
  public function offsetSet($offset, $value) {
    if (is_null($offset)) {
      $this->components[] = $value;
    } else {
      $this->components[$offset] = $value;
    }
  }

  /**
   * Unsets an offset
   *
   * @param  mixed $offset offset to unset
   * @return void
   */
  public function offsetUnset($offset) {
    if ($this->offsetExists($offset)) {
      unset($this->components[$offset]);
    }
    return $this;
  }

  public function toArray(): array {
    return $this->components;
  }

  /**
   * Replaces the content of the component
   *
   * @param  mixed $content new tag content
   * @return $this for a fluent interface
   */
  public function replaceContent($content) {
    return $this->clear()->append($content);
  }

  public function clear() {
    $this->components = [];
    return $this;
  }

  public function getHtml(): string {
   $output = '';
    foreach ($this->components as $value) {
      if (is_scalar($value) || $value === null) {
        $output .=   $value;
      } else if (is_object($value)) {
        if (method_exists($value, '__toString')) {
          $output .=  $value;
        } else if ($value instanceof \Traversable) {
          $arr = iterator_to_array($value);
          $output .= Arrays::implode($arr);
        } else {
          throw new InvalidArgumentException('Object has no string representation');
        }
      } else if (is_array($value)) {
        $output .= Arrays::implode($value);
      } else {
        throw new InvalidArgumentException('value has no string representation');
      }
    }
    return $output;
  }

  public function exists($value): bool {
    $result = false;
    foreach ($this->components as $component) {
      if ($component === $value || (($component instanceof ContainerInterface)) && $component->exists($value)) {
        $result = true;
        break;
      }
    }
    return $result;
  }

  /**
   * Creates a new iterator to iterate through content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return new Iterator($this->components);
  }

}
