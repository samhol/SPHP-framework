<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use IteratorAggregate;
use Traversable;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\Tag;
use Sphp\Html\Tags;
use Sphp\Exceptions\BadMethodCallException;

/**
 * The base class for all HTML tag components acting as HTML component containers
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
 * @method \Sphp\Html\Text\Span appendSpan(mixed $content = null) Appends a span tag
 * @method \Sphp\Html\Text\Strong appendStrong(mixed $content = null) Appends a strong tag
 * @method \Sphp\Html\Text\Small appendSmall(mixed $content = null) Appends a small tag
 * @method \Sphp\Html\Text\I appendI(mixed $content = null) Appends a i tag
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ContainerTag extends AbstractComponent implements IteratorAggregate, ContainerComponent, ContentParser {

  use ContentParserTrait,
      TraversableTrait;
 
  private PlainContainer $content;

  /**
   * Constructor
   *
   * **Important!**
   *
   * Parameter `mixed $content` can be of any type that converts to a string
   * or to an array of strings. So also objects of any type that implement magic
   * method `__toString()` are allowed.
   *
   * @param  string $tagName the name of the tag
   * @param  mixed $content optional content of the component
   * @throws InvalidArgumentException if the tag name is not valid
   */
  public function __construct(string $tagName, mixed $content = null) {
    parent::__construct($tagName);
    $this->content = new PlainContainer();
    if ($content !== null) {
      $this->append($content);
    }
  }

  /**
   * 
   * @param  string $name
   * @param  array $arguments
   * @return Tag
   * @throws BadMethodCallException if the method is not valid or does not exist
   */
  public function __call(string $name, array $arguments): Tag {
    if (str_starts_with($name, 'append')) {
      $tag = lcfirst(str_replace('append', '', $name));
      $this->append($content = Tags::create($tag, ...$arguments));
      return $content;
    } else {
      throw new BadMethodCallException("Method '$name' does not exist");
    }
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
   * Returns the content container or an element pointed by an optional index
   *
   * @return Container the content container
   */
  public function getContent(): Container {
    return $this->content;
  }

  public function contentToString(): string {
    return $this->content->getHtml();
  }

  public function append($content) {
    $this->getContent()->append($content);
    return $this;
  }

  public function prepend($content) {
    $this->getContent()->prepend($content);
    return $this;
  }

  public function resetContent($content) {
    $this->getContent()->resetContent($content);
    return $this;
  }

  /**
   * Create a new iterator to iterate through inserted elements in the container
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return $this->content->getIterator();
  }

  public function clear() {
    $this->getContent()->clear();
    return $this;
  }

  public function contains($value): bool {
    return $this->getContent()->contains($value);
  }

}
