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
use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\PlainContainer;
use Traversable;
use Sphp\Exceptions\RuntimeException;

/**
 * Abstract implementation of both ordered and unordered HTML-list
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link http://www.w3schools.com/html/html_lists.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class StandardList extends AbstractComponent implements IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var PlainContainer 
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
    $this->items = new PlainContainer();
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
   * Clears the contents
   *
   * @return $this for a fluent interface
   */
  public function clear() {
    $this->items->clear();
    return $this;
  }

  /**
   * Prepends a new list item to the list
   * 
   * @param  mixed $item the item or the content of it
   * @return StandardListItem prepended instance
   */
  public function prepend($item): StandardListItem {
    if (!$item instanceof StandardListItem) {
      $item = new Li($item);
    }
    $this->items->prepend($item);
    return $item;
  }

  /**
   * Appends a new list item to the list
   * 
   * @param  mixed $item the item or the content of it
   * @return StandardListItem appended instance
   */
  public function append($item): StandardListItem {
    if (!$item instanceof StandardListItem) {
      $item = new Li($item);
    }
    $this->items->append($item);
    return $item;
  }

  /**
   * Appends a parsed inline Mark Down string to the list
   * 
   * @param  string $md inline Mark Down string
   * @return StandardListItem appended instance
   * @throws RuntimeException if the parsing fails for any reason
   */
  public function appendMd(string $md): StandardListItem {
    try {
      $li = new Li();
      $li->appendMd($md);
      $item = $this->append($li);
      return $item;
    } catch (\Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
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
  public function appendLink(string $href, $content = null, string $target = null): HyperlinkListItem {
    $item = new HyperlinkListItem($href, $content, $target);
    $this->append($item);
    return $item;
  }

  public function contentToString(): string {
    return $this->items->getHtml();
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
