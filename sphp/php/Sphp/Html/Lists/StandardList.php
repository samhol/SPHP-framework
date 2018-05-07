<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Lists;

use Sphp\Html\AbstractComponent;
use Sphp\Html\TraversableContent;
use IteratorAggregate;
use ArrayAccess;
use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\Container;
use Traversable;
use Sphp\Stdlib\Parser;
use Sphp\Html\Exceptions\RuntimeHtmlException;

/**
 * Abstract implementation of both ordered and unordered HTML-list
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link http://www.w3schools.com/html/html_lists.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class StandardList extends AbstractComponent implements IteratorAggregate, TraversableContent, ArrayAccess {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var Container 
   */
  private $items;

  /**
   * Constructor
   * 
   * @param  string $tagName the tag name of the component
   * @param  HtmlAttributeManager|null $attrManager the attribute manager of the component
   * @throws InvalidArgumentException if the tag name of the component is not valid
   */
  public function __construct(string $tagName, HtmlAttributeManager $attrManager = null) {
    parent::__construct($tagName, $attrManager);
    $this->items = new Container();
  }

  public function __destruct() {
    unset($this->items);
    parent::__destruct();
  }

  public function __clone() {
    $this->items = clone $this->items;
    parent::__clone();
  }

  /**
   * Prepends a new list item to the list
   * 
   * @param  mixed $item the item or the content of it
   * @return LiInterface prepended instance
   */
  public function prepend($item): LiInterface {
    if (!$item instanceof LiInterface) {
      $item = new Li($item);
    }
    $this->items->prepend($item);
    return $item;
  }

  /**
   * Appends a new list item to the list
   * 
   * @param  mixed $item the item or the content of it
   * @return LiInterface appended instance
   */
  public function append($item): LiInterface {
    if (!$item instanceof LiInterface) {
      $item = new Li($item);
    }
    $this->items->append($item);
    return $item;
  }

  /**
   * Appends a parsed inline Mark Down string to the list
   * 
   * @param  string $md inline Mark Down string
   * @return LiInterface appended instance
   * @throws RuntimeHtmlException if the parsing fails for any reason
   */
  public function appendMd(string $md): LiInterface {
    try {
      $p = Parser::md();
      $item = $this->append($p->parseInline($md));
      return $item;
    } catch (\Exception $ex) {
      throw new RuntimeHtmlException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

  /**
   * Appends a link object to the list
   *
   * @param  string $href the URL of the link
   * @param  mixed $content link content
   * @param  string $target the value of the target attribute
   * @return HyperlinkListItem appended instance
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendLink(string $href, $content = '', string $target = null): HyperlinkListItem {
    $item = new HyperlinkListItem($href, $content, $target);
    $this->append($item);
    return $item;
  }

  public function contentToString(): string {
    return $this->items->getHtml();
  }

  /**
   * Checks whether an offset exists
   *
   * @param  mixed $offset an offset to check for
   * @return boolean true on success or false on failure
   */
  public function offsetExists($offset): bool {
    return $this->items->offsetExists($offset);
  }

  /**
   * Returns the list element at the specified offset
   *
   * @param  mixed $offset the index with the content element
   * @return LiInterface content element or null
   */
  public function offsetGet($offset): LiInterface {
    return $this->items->offsetGet($offset);
  }

  /**
   * Assigns content to the specified offset
   *
   * @param  mixed $offset the offset to assign the value to
   * @param  mixed $value the value to set
   * @return void
   */
  public function offsetSet($offset, $value) {
    if (!$value instanceof LiInterface) {
      $value = new Li($value);
    }
    $this->items->offsetSet($offset, $value);
  }

  /**
   * Unsets an offset
   *
   * @param  mixed $offset offset to unset
   * @return void
   */
  public function offsetUnset($offset) {
    $this->items->offsetUnset($offset);
  }

  /**
   * Count the number of inserted items in the list
   *
   * @return int number of elements in the list
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
    return $this->items->count();
  }

  /**
   * Create a new iterator to iterate through the list items
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return $this->items->getIterator();
  }

}
