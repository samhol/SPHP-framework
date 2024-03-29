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

use Sphp\Exceptions\BadMethodCallException;
use IteratorAggregate;
use ArrayAccess;
use Sphp\Stdlib\Arrays;
use Traversable;
use Sphp\Stdlib\Filesystem;
use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Html\Exceptions\HtmlException;
use Sphp\Html\Navigation\A;

/**
 * Implements a container for HTML components and other textual content
 * 
 * @method \Sphp\Html\Span appendSpan(mixed $content) Appends a span
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class PlainContainer extends AbstractContent implements IteratorAggregate, Container, ContentParser, ArrayAccess {

  /**
   * content
   *
   * @var mixed[]
   */
  private array $components;

  /**
   * Constructor
   */
  public function __construct() {
    $this->components = [];
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
   * @link https://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->components = Arrays::copy($this->components);
  }

  public function prepend($content) {
    array_unshift($this->components, $content);
    return $this;
  }

  public function append($content) {
    $this->components[] = $content;
    return $this;
  }

  public function __call(string $name, array $arguments) {
    if (!str_starts_with($name, 'append')) {
      throw new BadMethodCallException($name);
    }
    $tagName = strtolower(preg_replace("/^append/", '', $name));
    //echo $tagName.$name;
    $out = Tags::$tagName(...$arguments);
    //$out = 'foo';
    $this->append($out);
    return $out;
  }

  public function appendHyperlink(string $href = null, $content = null, string $target = null): A {
    $component = new A($href, $content, $target);
    $this->append($component);
    return $component;
  }

  /**
   * Appends a raw file to the container
   * 
   * @param  string $path path to the file
   * @return $this for a fluent interface
   * @throws HtmlException if the parsing fails for any reason
   */
  public function appendRawFile(string $path) {
    try {
      $this->append(Filesystem::toString($path));
    } catch (\Exception $ex) {
      throw new HtmlException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $this;
  }

  /**
   * Appends an executed PHP file to the container
   * 
   * @param  string $path  the path to the file
   * @return $this for a fluent interface
   * @throws HtmlException if the parsing fails for any reason
   */
  public function appendPhpFile(string $path) {
    try {
      $this->append(Filesystem::executePhpToString($path));
    } catch (\Throwable $ex) {
      throw new HtmlException($ex->getMessage(), (int) $ex->getCode(), $ex);
    }
    return $this;
  }

  /**
   * Appends a parsed Markdown string to the container
   * 
   * @param  string $markdown the path to the file
   * @return $this for a fluent interface
   * @throws HtmlException if the parsing fails for any reason
   */
  public function appendMarkdown(string $markdown, bool $inlineOnly = false) {
    $content = ParseFactory::md()->parseString($markdown, $inlineOnly);
    $this->append($content);
    return $this;
  }

  /**
   * Appends a parsed Markdown file to the container
   * 
   * @param  string $path the path to the file
   * @param  bool $executePhp
   * @return $this for a fluent interface
   * @throws HtmlException if the parsing fails for any reason
   */
  public function appendMarkdownFile(string $path, bool $executePhp = true) {
    try {
      if ($executePhp) {
        $this->appendMarkdown(Filesystem::executePhpToString($path));
      } else {
        $this->appendMarkdown(ParseFactory::md()->parseFile($path));
      }
    } catch (\Exception $ex) {
      throw new HtmlException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $this;
  }

  public function resetContent($content) {
    $this->clear()->append($content);
    return $this;
  }

  /**
   * Checks whether an offset exists
   *
   * @param  mixed $offset an offset to check for
   * @return bool true on success or false on failure
   */
  public function offsetExists(mixed $offset): bool {
    return isset($this->components[$offset]) || array_key_exists($offset, $this->components);
  }

  /**
   * Returns the content element at the specified offset
   *
   * @param  mixed $offset the index with the content element
   * @return mixed content element or null
   */
  public function offsetGet(mixed $offset): mixed {
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
  public function offsetSet(mixed $offset, $value): void {
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
  public function offsetUnset(mixed $offset): void {
    unset($this->components[$offset]);
  }

  public function clear() {
    $this->components = [];
    return $this;
  }

  public function getHtml(): string {
    return Arrays::recursiveImplode($this->components);
  }

  public function contains($value): bool {
    $result = false;
    foreach ($this->components as $component) {
      if ($component === $value || (($component instanceof Container)) && $component->contains($value)) {
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
    return new ContentIterator($this->components);
  }

  public function getComponentsBy(callable $rules): TraversableContent {
    return (new ContentIterator($this->components))->getComponentsBy($rules);
  }

  public function getComponentsByObjectType($type): TraversableContent {
    return (new ContentIterator($this->components))->getComponentsByObjectType($type);
  }

  public function toArray(): array {
    return $this->components;
  }

  /**
   * Count the number of contained items 
   *
   * @return int number of items contained
   * @link   https://www.php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
    return count($this->components);
  }

}
