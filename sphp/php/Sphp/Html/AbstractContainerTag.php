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
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class AbstractContainerTag extends AbstractComponent implements IteratorAggregate, ContainerComponent, ContentParser {

  use ContentParserTrait,
      TraversableTrait;

  /**
   * the inner content container
   *
   * @var Container
   */
  private $content;

  /**
   * Constructor
   *
   * @param  string $tagname the name of the tag
   * @param  HtmlAttributeManager|null $attrManager the attribute manager of the component
   * @param  Container|null $contentContainer the inner content container of the component
   */
  public function __construct(string $tagname, HtmlAttributeManager $attrManager = null, Container $contentContainer = null) {
    parent::__construct($tagname, $attrManager);
    $this->setInnerContainer($contentContainer);
  }

  public function __destruct() {
    unset($this->content);
    parent::__destruct();
  }

  public function __clone() {
    $this->content = clone $this->content;
    parent::__clone();
  }

  /**
   * Sets the inner content container of the component
   *
   * @param  Container $contentContainer the inner content container of the component
   * @return $this for a fluent interface
   */
  protected function setInnerContainer(Container $contentContainer = null) {
    if (!$contentContainer instanceof Container) {
      $this->content = new PlainContainer();
    } else {
      $this->content = $contentContainer;
    }
    return $this;
  }

  /**
   * Returns the content container or an element pointed by an optional index
   *
   * @return Container the content container
   */
  protected function getInnerContainer(): Container {
    return $this->content;
  }

  public function contentToString(): string {
    return $this->content->getHtml();
  }

  public function append($content) {
    $this->getInnerContainer()->append($content);
    return $this;
  }

  public function prepend($content) {
    $this->getInnerContainer()->prepend($content);
    return $this;
  }

  public function resetContent($content) {
    $this->getInnerContainer()->resetContent($content);
    return $this;
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
  public function offsetSet($offset, $value): void {
    $this->getInnerContainer()->offsetSet($offset, $value);
  }

  /**
   * Unsets an offset
   *
   * @param  mixed $offset offset to unset
   * @return void
   */
  public function offsetUnset($offset): void {
    $this->getInnerContainer()->offsetUnset($offset);
  }

  public function clear() {
    $this->getInnerContainer()->clear();
    return $this;
  }

  public function exists($value): bool {
    $this->getInnerContainer()->exists($value);
  }

}
