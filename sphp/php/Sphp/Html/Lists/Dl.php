<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Lists;

use Sphp\Html\AbstractComponent;
use Sphp\Html\TraversableContent;
use IteratorAggregate;
use Sphp\Html\ContentIterator;
use Sphp\Stdlib\Arrays;

/**
 * Implements an HTML Description List
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_dl.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Dl extends AbstractComponent implements IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var DlContent[] 
   */
  private array $items;

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct('dl');
    $this->items = [];
  }

  public function __destruct() {
    unset($this->items);
    parent::__destruct();
  }

  public function __clone() {
    $this->items = Arrays::copy($this->items);
    parent::__clone();
  }

  public function getItem(int $index): ?DlContent {
    if (!array_key_exists($index, $this->items)) {
      return null;
    }
    return $this->items[$index];
  }

  /**
   * Appends elements to the object
   *
   * @param  DlContent $item list elements
   * @return $this for a fluent interface
   */
  public function append(DlContent $item) {
    $this->items[] = $item;
    return $this;
  }

  /**
   * Creates and appends a term to the list
   *
   * @param  mixed $content the term content
   * @return Dt appended instance
   */
  public function appendTerm(mixed $content): Dt {
    $dt = new Dt($content);
    $this->append($dt);
    return $dt;
  }

  /**
   * Creates and appends a description to the list
   *
   * @param  mixed $content the description content
   * @return Dd appended instance
   */
  public function appendDescription(mixed $content): Dd {
    $dd = new Dd($content);
    $this->append($dd);
    return $dd;
  }

  /**
   * Creates and appends a description to the list
   *
   * @param  iterable $content the description content
   * @return $this for a fluent interface
   */
  public function appendDescriptions(iterable $content) {
    foreach ($content as $dd) {
      $this->appendDescription($dd);
    }
    return $this;
  }

  /**
   * Prepends an item to the object
   * 
   * @param  DlContent $it list element
   * @return $this for a fluent interface
   */
  public function prepend(DlContent $it) {
    array_unshift($this->items, $it);
    return $this;
  }

  public function count(): int {
    return count($this->items);
  }

  /**
   * Returns a new iterator to iterate through the list items
   *
   * @return ContentIterator<int, DlContent> iterator
   */
  public function getIterator(): ContentIterator {
    return new ContentIterator($this->items);
  }

  public function contentToString(): string {
    return implode($this->items);
  }

}
