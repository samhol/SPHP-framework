<?php

/**
 * TableRowContainer.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Html\AbstractContainerComponent;
use IteratorAggregate;
use ArrayAccess;
use Sphp\Html\TraversableContent;
use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Implements an HTML table row collection namely (&lt;thead&gt;, &lt;tbody&gt; or &lt;tfoot&gt;)
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class TableRowContainer extends AbstractContainerComponent implements IteratorAggregate, TraversableContent, TableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * Counts the &lt;tr&gt; components in the table
   */
  const COUNT_NORMAL = 1;

  /**
   * Counts the &lt;td&gt; and &lt;th&gt; components in the table
   */
  const COUNT_CELLS = 2;

  /**
   * Constructs a new instance
   * 
   * **Notes:**
   * 
   *  * A mixed `$row` can be of any type that converts to a PHP string
   *  * Any `$row` not implementing {@link RowInterface} is wrapped within a {@link Tr} component
   *
   * @param string $tagname
   * @param HtmlAttributeManager $m
   * @param null|mixed|mixed[] $rows the row being appended
   */
  public function __construct(string $tagname, HtmlAttributeManager $m = null, array $rows = null) {
    parent::__construct($tagname, $m);
    if ($rows !== null) {
      $this->fromArray($rows);
    }
  }

  /**
   * 
   * @param  array $arr the row being appended
   * @return $this for a fluent interface
   */
  abstract public function fromArray(array $arr);

  /**
   * Appends a {@link RowInterface} object to the container object
   *
   * **Notes:**
   * 
   *  * A mixed `$row` can be of any type that converts to a PHP string
   *  * Any `$row` not implementing {@link RowInterface} is wrapped within a {@link Tr} component
   *
   * @param  Row $row the row being appended
   * @return $this for a fluent interface
   */
  public function append(Row $row) {
    $this->getInnerContainer()->append($row);
    return $this;
  }

  /**
   * Appends a {@link RowInterface} object to the container object
   *
   * **Notes:**
   * 
   *  * A mixed `$row` can be of any type that converts to a PHP string
   *  * Any `$row` not implementing {@link RowInterface} is wrapped within a {@link Tr} component
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
   * Appends a {@link RowInterface} object to the container object
   *
   * **Notes:**
   * 
   *  * A mixed `$row` can be of any type that converts to a PHP string
   *  * Any `$row` not implementing {@link RowInterface} is wrapped within a {@link Tr} component
   *
   * @param  array $cells the row being appended
   * @return $this for a fluent interface
   */
  public function appendBodyRow(array $cells) {
    $this->append(Tr::fromTds($cells));
    return $this;
  }

  /**
   * Prepends a {@link RowInterface} to the object
   *
   * **Notes:**
   * 
   *  * A mixed `$row` can be of any type that converts to a PHP string
   *  * Any `$row` not implementing {@link RowInterface} is wrapped within a {@link Tr} component
   *  * The numeric keys of the container will be renumbered starting from zero
   *
   * @param  mixed|mixed[] $row the row(s) being appended
   * @return $this for a fluent interface
   */
  public function prepend(Row $row) {
    $this->getInnerContainer()->prepend($row);
    return $this;
  }

  /**
   * Count the number of inserted elements in the table
   *
   * **`$mode` parameter values:**
   * 
   * * {@link self::COUNT_ROWS} counts the {@link RowInterface} components in the table
   * * {@link self::COUNT_CELLS} counts the {@link CellInterface} components in the table
   *
   * @param  int $mode defines the type of the objects to count
   * @return string number of elements in the html table
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count($mode = 'tr'): int {
    $num = 0;
    if ($mode === 'tr') {
      $num += $this->getInnerContainer()->count();
    } else if ($mode === 'td') {
      foreach ($this as $row) {
        $num += $row->count();
      }
    }
    return $num;
  }

  public function getIterator() {
    return $this->getInnerContainer();
  }

}
