<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

use Sphp\Html\AbstractComponent;
use Iterator;
use Sphp\Html\TraversableContent;
use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Exceptions\OutOfBoundsException;

/**
 * Implements an HTML table row collection namely (&lt;thead&gt;, &lt;tbody&gt; or &lt;tfoot&gt;)
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TableRowContainer extends AbstractComponent implements Iterator, TraversableContent, TableContent {

  use \Sphp\Html\TraversableTrait;

  private $rows;

  /**
   * Constructor
   * 
   * @param string $tagname
   * @param HtmlAttributeManager|null $m
   */
  public function __construct(string $tagname, HtmlAttributeManager $m = null) {
    parent::__construct($tagname, $m);
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
   * Appends a &lt;tr&gt; object containing &lt;th&gt; objects
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
   * Appends a &lt;tr&gt; object containing &lt;td&gt; objects
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
   * @param  int $number
   * @return Row the row at given position
   * @throws OutOfBoundsException
   */
  public function getRow(int $number): Row {
    if (array_key_exists($number, $this->rows)) {
      return $this->rows[$number];
    } else {
      throw new OutOfBoundsException("Row $number does not exists");
    }
  }

  public function contentToString(): string {
    return implode($this->rows);
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->rows);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->rows);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->rows);
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    reset($this->rows);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->rows);
  }

}
