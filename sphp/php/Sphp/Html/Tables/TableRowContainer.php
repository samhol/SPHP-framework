<?php

/**
 * TableRowContainer.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Html\AbstractContainerComponent;
use IteratorAggregate;
use ArrayAccess;
use Sphp\Html\TraversableInterface;

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
abstract class TableRowContainer extends AbstractContainerComponent implements IteratorAggregate, ArrayAccess, TraversableInterface, TableContentInterface {

  use \Sphp\Html\TraversableTrait;

  /**
   * Counts the {@link RowInterface} components in the table
   */
  const COUNT_NORMAL = 1;

  /**
   * Counts the {@link CellInterface} components in the table
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
   * @param AttributeManager $m
   * @param null|mixed|mixed[] $rows the row being appended
   */
  public function __construct($tagname, \Sphp\Html\Attributes\AttributeManager $m = null, array $rows = null) {
    parent::__construct($tagname, $m);
    if ($rows !== null) {
      $this->fromArray($rows);
    }
  }

  /**
   * 
   * @param  array $arr the row being appended
   * @return self for a fluent interface
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
   * @param  RowInterface $row the row being appended
   * @return self for a fluent interface
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
   * @return self for a fluent interface
   */
  public function appendHeaderRow($cells) {
    $this->append(Tr::fromThs($cells));
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
   * @return self for a fluent interface
   */
  public function appendBodyRow($cells) {
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
   * @return self for a fluent interface
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
   * @return self for a fluent interface
   */
  public function prependTr($row) {
    $this->prepend(new Tr($row));
    return $this;
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
  public function count($mode = 'tr') {
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

  public function offsetExists($offset) {
    return $this->getInnerContainer()->offsetExists($offset);
  }

  public function offsetGet($offset) {
    return $this->getInnerContainer()->offsetGet($offset);
  }

  public function offsetSet($offset, $value) {
    return $this->getInnerContainer()->offsetSet($offset, $value);
  }

  public function offsetUnset($offset) {
    
  }

}
