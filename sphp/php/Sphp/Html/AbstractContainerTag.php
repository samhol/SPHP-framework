<?php

/**
 * AbstractContainerTag.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Data\ArrayAccessExtensionTrait as ArrayAccessExtensionTrait;

/**
 * Class is the base class for all HTML tag components acting as HTML component containers
 *
 * **Notes:**
 *
 * Any class extending {@link self} follows these rules:
 *
 * 1. Any extending class act as a container for other components like
 *    {@link ContentInterface}, other objects, text, ...etc.
 * 2. The type of the content in such container depends solely on the container's
 *    purpose of use.
 * 3. Any extending class can be used in **PHP**'s `foreach` construct.
 * 4. Any extending class can be used with the **PHP**'s `count()` function.
 * 5. All container's content data can be reached by PHP's {@link \ArrayAccess}
 *    notation.
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-05-03
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractContainerTag extends AbstractContainerComponent implements ContainerComponentInterface, ContentParserInterface {

  use ArrayAccessExtensionTrait,
      ContentParsingTrait,
      TraversableTrait;

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * 1. Parameter `mixed $content` can be of any type that converts to a string
   *    or to an array of strigs. So also objects of any type that implement magic
   *    method `__toString()` are allowed.
   *
   * @param  string $tagName the name of the tag
   * @param  mixed $content the content of the component
   * @param  AttributeManager|null $attrManager the attribute manager of the component
   * @param  ContainerInterface|null $contentContainer the inner content container of the component
   * @throws \InvalidArgumentException if the tagname is not valid
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($tagName, AttributeManager $attrManager = null, ContainerInterface $contentContainer = null) {
    parent::__construct($tagName, $attrManager, $contentContainer);
  }

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
   * @return self for PHP Method Chaining
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function append($content) {
    $this->content()->append($content);
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
   * @return self for PHP Method Chaining
   */
  public function prepend($content) {
    $this->content()->prepend($content);
    return $this;
  }

  /**
   * Counts the number of elements in the container
   *
   * @return int the number of elements in the container
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count() {
    return $this->content()->count();
  }

  /**
   * Create a new iterator to iterate through inserted elements in the container
   *
   * @return \ArrayIterator iterator
   */
  public function getIterator() {
    return $this->content()->getIterator();
  }

  /**
   * {@inheritdoc}
   */
  public function offsetExists($offset) {
    return $this->content()->offsetExists($offset);
  }

  /**
   * Returns the content element at the specified offset
   *
   * @param  mixed $offset the index with the content element
   * @return mixed content element or null
   */
  public function offsetGet($offset) {
    return $this->content()->offsetGet($offset);
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
    $this->content()->offsetSet($offset, $value);
  }

  /**
   * Unsets an offset
   *
   * @param mixed $offset offset to unset
   */
  public function offsetUnset($offset) {
    $this->content()->offsetUnset($offset);
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
   * @return self for PHP Method Chaining
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function replaceContent($content) {
    $this->content()->replaceContent($content);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function toArray() {
    return $this->content()->toArray();
  }

  /**
   * {@inheritdoc}
   */
  public function clear() {
    $this->content()->clear();
    return $this;
  }

}
