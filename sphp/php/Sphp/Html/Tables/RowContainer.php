<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

use Sphp\Html\AbstractComponent;
use IteratorAggregate;
use ArrayAccess;
use Sphp\Html\ContentIterator;
use Sphp\Html\TraversableContent;
use Sphp\Html\Attributes\AttributeContainer;

/**
 * Abstract implementation of an HTML table row container
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class RowContainer extends AbstractComponent implements IteratorAggregate, TraversableContent, TableContent, ArrayAccess {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var Row[]
   */
  private array $rows;

  /**
   * Constructor
   * 
   * @param string $tagname
   * @param AttributeContainer|null $attrs
   */
  public function __construct(string $tagname, AttributeContainer $attrs = null) {
    parent::__construct($tagname, $attrs);
    $this->rows = [];
  }

  public function __destruct() {
    unset($this->rows);
    parent::__destruct();
  }

  /**
   * Appends a Row object to the container object
   *
   * @param  Row $row the row being appended
   * @return $this for a fluent interface
   */
  public function append(Row $row) {
    $this->rows[] = $row;
    return $this;
  }

  /**
   * Appends a tr object containing &lt;th&gt; objects
   *
   * **Notes:**
   * 
   *  * A `$cells` array can contain anything that converts to a PHP string
   *
   * @param  array $cells the row being appended
   * @return Tr appended table row component
   */
  public function appendHeaderRow(array $cells): Tr {
    $row = Tr::fromThs($cells);
    $this->append($row);
    return $row;
  }

  /**
   * Appends a tr object containing &lt;td&gt; objects
   *
   * **Notes:**
   * 
   *  * A `$cells` array can contain anything that converts to a PHP string
   *
   * @param  array $cells the row being appended
   * @return Tr appended table row component
   */
  public function appendBodyRow(array $cells): Tr {
    $row = Tr::fromTds($cells);
    $this->append($row);
    return $row;
  }

  /**
   * Prepends a &lt;tr&gt object
   *
   * @param  Row $row the row(s) being appended
   * @return $this for a fluent interface
   */
  public function prepend(Row $row) {
    array_unshift($this->rows, $row);
    return $this;
  }

  /**
   * Returns the row at given position
   * 
   * **Important:** Rows are numbered sequentially starting from 0
   * 
   * @param  int $position
   * @return Row|null the row at given position
   */
  public function getRow(int $position): ?Row {
    $row = null;
    if (array_key_exists($position, $this->rows)) {
      $row = $this->rows[$position];
    }
    return $row;
  }

  /**
   * Checks whether an offset exists
   *
   * @param mixed $offset an offset to check for
   * @return bool true on success or false on failure
   */
  public function offsetExists($offset): bool {
    return array_key_exists($offset, $this->rows);
  }

  /**
   * Returns the content element at the specified offset
   *
   * @param  mixed $offset the index with the content element
   * @return Row|null content element or null
   */
  public function offsetGet($offset): ?Row {
    if ($this->offsetExists($offset)) {
      return $this->rows[$offset];
    }
    return null;
  }

  /**
   * Assigns content to the specified offset
   *
   * @param  mixed $offset the offset to assign the value to
   * @param  mixed $value the value to set
   * @return void
   */
  public function offsetSet($offset, $value): void {
    if (!$value instanceof Row) {
      $value = new Tr($value);
    }
    if ($offset === null) {
      $this->rows[] = $value;
    } else {
      $this->rows[$offset] = $value;
    }
  }

  /**
   * Unsets an offset
   *
   * @param  mixed $offset offset to unset
   * @return void
   */
  public function offsetUnset($offset): void {
    if ($this->offsetExists($offset)) {
      unset($this->rows[$offset]);
    }
  }

  public function contentToString(): string {
    return implode($this->rows);
  }

  /**
   * Returns an external iterator
   *
   * @return ContentIterator<Row> external iterator
   */
  public function getIterator(): ContentIterator {
    return new ContentIterator($this->rows);
  }

}
