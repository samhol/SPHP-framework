<?php

/**
 * Tr.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Html\AbstractContainerComponent;
Use IteratorAggregate;
use Sphp\Html\TraversableContent;
use Traversable;

/**
 * Implements an HTML &lt;tr&gt; tag
 *
 *  This component represents a row of {@link CellInterface}
 *  components in a {@link Table}.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_tr.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-tr-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Tr extends AbstractContainerComponent implements IteratorAggregate, TraversableContent, Row {

  use \Sphp\Html\TraversableTrait;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('tr');
  }

  /**
   * Appends a cell component to the row
   *
   * @param  Cell $cell new cell object
   * @return $this for a fluent interface
   */
  public function append(Cell $cell) {
    $this->getInnerContainer()->append($cell);
    return $this;
  }

  /**
   * Creates and appends a new &lt;th&gt; component to the row
   *
   * @precondition  $scope == row|col|rowgroup|colgroup
   * @precondition  $colspan >= 1
   * @precondition  $rowspan >= 1
   * @param mixed $content the content of the tag
   * @param string|null $scope the value of the scope attribute or null for none
   * @param int $colspan solun colspan attribute value
   * @param int $rowspan solun rowspan attribute value
   * @link  http://www.w3schools.com/tags/att_th_scope.asp scope attribute
   * @link  http://www.w3schools.com/tags/att_th_colspan.asp colspan attribute
   * @link  http://www.w3schools.com/tags/att_th_rowspan.asp rowspan attribute
   * @return Th appended table cell component
   */
  public function appendTh($content, string $scope = null, int $colspan = 1, int $rowspan = 1): Th {
    $th = new Th($content, $scope, $colspan, $rowspan);
    $this->append($th);
    return $th;
  }

  /**
   * Creates and appends &lt;th&gt; components to the row
   *
   * @param  mixed[] $cells cells of the table row
   * @return $this for a fluent interface
   */
  public function appendThs(array $cells) {
    foreach ($cells as $th) {
      $this->appendTh($th);
    }
    return $this;
  }

  /**
   * Creates and appends a new &lt;td&gt; component to the row
   *
   * @precondition  $colspan >= 1
   * @precondition  $rowspan >= 1
   * @param mixed $content the content of the component
   * @param int $colspan the value of the colspan attribute
   * @param int $rowspan the value of the rowspan attribute
   * @link  http://www.w3schools.com/tags/att_td_colspan.asp colspan attribute
   * @link  http://www.w3schools.com/tags/att_td_rowspan.asp rowspan attribute
   * @return Td appended table cell component
   */
  public function appendTd($content, int $colspan = 1, int $rowspan = 1): Td {
    $td = new Td($content, $colspan, $rowspan);
    $this->append($td);
    return $td;
  }

  /**
   * Creates and appends &lt;td&gt; components to the row
   *
   * @param  mixed[] $cells cells of the table row
   * @return $this for a fluent interface
   */
  public function appendTds(array $cells) {
    foreach ($cells as $td) {
      $this->appendTd($td);
    }
    return $this;
  }

  /**
   * Prepends a cell component to the row
   *
   * @param  Cell $cell new cell object
   * @return $this for a fluent interface
   */
  public function prepend(Cell $cell) {
    $this->getInnerContainer()->prepend($cell);
    return $this;
  }

  /**
   * Create a new iterator to iterate through cells in the row
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return $this->getInnerContainer();
  }

  /**
   * Counts of the cells in the row
   *
   * @return int number of the cells in the row
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
    return $this->getInnerContainer()->count();
  }

  /**
   * Creates a new &lt;tr&gt; component
   * 
   * @param  array $tds 
   * @return Tr created &lt;tr&gt; component
   */
  public static function fromTds(array $tds): Tr {
    return (new static())->appendTds($tds);
  }

  /**
   * Creates a new &lt;tr&gt; component
   * 
   * @param  array $ths
   * @return Tr created &lt;tr&gt; component
   */
  public static function fromThs(array $ths): Tr {
    return (new static())->appendThs($ths);
  }

}
