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
use Traversable;

/**
 * Class is the base class for all HTML tag components acting as HTML component containers
 *
 * **Notes:**
 *
 * All containers follow these rules:
 *
 * 1. Any extending class act as a container for other HTML components.
 * 2. The type of the content depends solely on the container's
 *    purpose of use.
 * 3. Any extending class can be used in **PHP**'s `foreach` construct.
 * 4. Any extending class can be used with the **PHP**'s `count()` function.
 * 5. All container's content data can be reached by PHP's {@link \ArrayAccess}
 *    notation.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class AbstractContainerTag extends AbstractContainerComponent implements IteratorAggregate, ContainerComponentInterface, ContentParser {

  use ContentParsingTrait,
      TraversableTrait;

  public function append(...$content) {
    $this->getInnerContainer()->append($content);
    return $this;
  }

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
  public function count(): int {
    return $this->getInnerContainer()->count();
  }

  /**
   * Create a new iterator to iterate through inserted elements in the container
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return $this->getInnerContainer();
  }

  /**
   * Checks whether an offset exists
   *
   * @param  mixed $offset an offset to check for
   * @return boolean true on success or false on failure
   */
  public function offsetExists($offset): bool {
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
   * @param  mixed $offset the offset to assign the value to
   * @param  mixed $value the value to set
   * @return void
   */
  public function offsetSet($offset, $value) {
    $this->getInnerContainer()->offsetSet($offset, $value);
  }

  /**
   * Unsets an offset
   *
   * @param  mixed $offset offset to unset
   * @return void
   */
  public function offsetUnset($offset) {
    $this->getInnerContainer()->offsetUnset($offset);
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
   * @return $this for a fluent interface
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function replaceContent($content) {
    $this->getInnerContainer()->replaceContent($content);
    return $this;
  }

  public function toArray(): array {
    return $this->getInnerContainer()->toArray();
  }

  public function clear() {
    $this->getInnerContainer()->clear();
    return $this;
  }

  public function exists($value): bool {
    $this->getInnerContainer()->exists($value);
  }

}
