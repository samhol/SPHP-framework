<?php

declare(strict_types=1);

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
use Sphp\Html\Attributes\AttributeContainer;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\ContentIterator;
use Traversable;
use Sphp\Html\Exceptions\HtmlException;
use Sphp\Stdlib\Arrays;

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
   * @var StandardListItem[] 
   */
  private $items;

  /**
   * Constructor
   * 
   * @param  string $tagName the tag name of the component
   * @param  iterable|null $items the content of the component
   * @param  AttributeContainer|null $attrManager the attribute manager of the component
   * @throws InvalidArgumentException if the tag name of the component is not valid
   */
  public function __construct(string $tagName, iterable $items = null, AttributeContainer $attrManager = null) {
    parent::__construct($tagName, $attrManager);
    $this->items = [];
    if ($items !== null) {
      if ($items instanceof StandardListItem) {
        $items = [$items];
      }
      foreach ($items as $item) {
        $this->append($item);
      }
    }
  }

  public function __destruct() {
    unset($this->items);
    parent::__destruct();
  }

  public function __clone() {
    $this->items = Arrays::copy($this->items);
    parent::__clone();
  }

  /**
   * Clears the contents
   *
   * @return $this for a fluent interface
   */
  public function clear() {
    $this->items = [];
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
    array_unshift($this->items, $item);
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
    $this->items[] = $item;
    return $item;
  }

  /**
   * Appends a parsed inline Markdown string to the list
   * 
   * @param  string $md inline Markdown string
   * @param  bool $inlineOnly
   * @return Li appended instance
   */
  public function appendMarkdown(string $md, bool $inlineOnly = false): Li {
    $li = new Li();
    $li->appendMarkdown($md, $inlineOnly);
    $item = $this->append($li);
    return $item;
  }

  /**
   * Appends a parsed inline Markdown string to the list
   * 
   * @param  string $path inline Markdown string
   * @param  bool $inlineOnly
   * @return Li appended instance
   * @throws HtmlException
   */
  public function appendMarkdownFile(string $path, bool $inlineOnly = false): Li {
    $li = new Li();
    $li->appendMarkdownFile($path, $inlineOnly);
    $item = $this->append($li);
    return $item;
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
    return implode('', $this->items);
  }

  /**
   * Create a new iterator to iterate through the list items
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return new ContentIterator($this->items);
  }

}
