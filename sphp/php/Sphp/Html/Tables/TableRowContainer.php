<?php

/**
 * TableRowContainer.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Html\AbstractContainerComponent;

/**
 * Implements an HTML table row collection namely (&lt;thead&gt;, &lt;tbody&gt; or &lt;tfoot&gt;)
 *
 * {@inheritdoc}
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-03
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class TableRowContainer extends AbstractContainerComponent implements \IteratorAggregate, \Sphp\Html\TraversableInterface, TableContentInterface {

  use \Sphp\Html\TraversableTrait;
  /**
   * Counts the {@link RowInterface} components in the table
   */
  const COUNT_NORMAL = 1;

  /**
   * Counts the {@link CellInterface} components in the table
   */
  const COUNT_CELLS = 2;

  abstract public function fromArray(array $arr);

  /**
   * Wraps any non {@link RowInterface} input within a {@link Tr} object
   *
   * **Notes:**
   * 
   *  * A mixed `$row` can be of any type that converts to a PHP string
   *  * Any `$row` not implementing {@link RowInterface} is wrapped within a {@link Tr} component
   *
   * @param  mixed|mixed[] $row the row being appended
   * @return RowInterface wrapped input
   */
  private function trWrapper($row) {
    if (!($row instanceof RowInterface)) {
      return new Tr($row, $this->getDefaultCellType());
    } else {
      return $row;
    }
  }

  /**
   * Appends a {@link RowInterface} object to the container object
   *
   * **Notes:**
   * 
   *  * A mixed `$row` can be of any type that converts to a PHP string
   *  * Any `$row` not implementing {@link RowInterface} is wrapped within a {@link Tr} component
   *
   * @param  RowInterface $row the row being appended
   * @return self for PHP Method Chaining
   */
  public function append(RowInterface $row) {
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
   * @param  mixed|mixed[] $cells the row being appended
   * @return self for PHP Method Chaining
   */
  public function appendHeaderRow($cells) {
    $this->append(new HeaderRow($cells));
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
   * @param  mixed|mixed[] $cells the row being appended
   * @return self for PHP Method Chaining
   */
  public function appendBodyRow($cells) {
    $this->append(new BodyRow($cells));
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
   * @return self for PHP Method Chaining
   */
  public function prepend(RowInterface $row) {
    $this->getInnerContainer()->prepend($row);
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
   * @return self for PHP Method Chaining
   */
  public function prependTr($row) {
    $this->prepend(new Tr($row));
    return $this;
  }

  /**
   * Assigns a table row {@link RowInterface} to the specified offset
   *
   * **Notes:**
   *
   *  * A mixed `$row` can be of any type that converts to a PHP string
   *  * Any `$row` not implementing {@link RowInterface} is wrapped within a {@link Tr} component
   *
   * @param mixed $offset the offset to assign the value to
   * @param mixed|mixed[]|RowInterface $row the value to set
   * @link  http://php.net/manual/en/arrayaccess.offsetset.php ArrayAccess::offsetGet
   */
  public function offsetSet($offset, $row) {
    parent::offsetSet($offset, $this->trWrapper($row));
  }

  /**
   * Count the number of inserted components in the table
   *
   * **`$mode` parameter values:**
   * 
   * * {@link self::COUNT_NORMAL} counts the {@link RowInterface} components in the table
   * * {@link self::COUNT_CELLS} counts the {@link CellInterface} components in the table
   *
   * @param  int $mode defines the type of the objects to count
   * @return int number of the components in the html table
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count($mode = self::COUNT_NORMAL) {
    if ($mode == self::COUNT_CELLS) {
      $count = 0;
      foreach ($this as $row) {
        $count += $row->count();
      }
      return $count;
    } else {
      return parent::count();
    }
  }

  public function getIterator() {
    
  }

}
