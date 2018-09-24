<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use IteratorAggregate;
use Sphp\Stdlib\Arrays;
use Traversable;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\InvalidStateException;

/**
 * Implements a container for HTML components and other textual content
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PlainContainer implements IteratorAggregate, Container, ContentParser {

  use ContentTrait,
      ContentParserTrait,
      TraversableTrait;

  /**
   * content
   *
   * @var mixed[]
   */
  private $components;

  /**
   * Constructor
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
   * Destructor
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
    foreach ($content as $cont) {
      $this->components[] = $cont;
    }

    return $this;
  }

  public function prepend($content) {
    array_unshift($this->components, $content);
    return $this;
  }

  public function resetContent($content) {
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

  public function clear() {
    $this->components = [];
    return $this;
  }

  public function getHtml(): string {
    $output = '';
    foreach ($this->components as $value) {
      if (is_scalar($value) || $value === null) {
        $output .= $value;
      } else if (is_object($value)) {
        if (method_exists($value, '__toString')) {
          $output .= $value;
        } else if ($value instanceof \Traversable) {
          $arr = iterator_to_array($value);
          $output .= Arrays::implode($arr);
        } else {
          throw new InvalidStateException('Content has no string representation');
        }
      } else if (is_array($value)) {
        $output .= Arrays::implode($value);
      } else {
        throw new InvalidStateException('Content has no string representation');
      }
    }
    return $output;
  }

  public function exists($value): bool {
    $result = false;
    foreach ($this->components as $component) {
      if ($component === $value || (($component instanceof Container)) && $component->exists($value)) {
        $result = true;
        break;
      }
    }
    return $result;
  }

  /**
   * Filters elements of a collection using a callback function
   *
   * @precondition $flag === {@link ARRAY_FILTER_USE_KEY} || $flag === {@link ARRAY_FILTER_USE_BOTH}
   * @param  callable $callback the callback function to use; If no callback is 
   *         supplied, all entries of array equal to `false` will be removed.
   * @param  int $flag flag determining what arguments are sent to callback
   * @return $this for a fluent interface
   */
  public function filter(callable $callback = null, $flag = 0) {
    $this->components = array_filter($this->components, $callback, $flag);
    return $this;
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
