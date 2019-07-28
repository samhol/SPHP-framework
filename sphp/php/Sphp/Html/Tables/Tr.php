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
use IteratorAggregate;
use Traversable;
use Sphp\Html\Iterator;
use Sphp\Html\TraversableContent;

/**
 * Implements an HTML &lt;tr&gt; tag
 *
 *  This component represents a row of {@link CellInterface}
 *  components in a {@link Table}.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_tr.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-tr-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Tr extends AbstractComponent implements IteratorAggregate, TraversableContent, Row {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var Cell[]
   */
  private $cells = [];

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct('tr');
  }

  public function append(Cell $cell) {
    $this->cells[] = $cell;
    return $this;
  }

  public function appendTh($content, int $colspan = 1, int $rowspan = 1, string $scope = null): Th {
    $th = new Th($content, $colspan, $rowspan, $scope);
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
  public function prepend(Cell $cell): Cell {
    array_unshift($this->cells, $cell);
    return $cell;
  }

  /**
   * Returns the cell at given position
   * 
   * **Important:** Cells are numbered sequentially starting from 0
   * 
   * @param  int $position
   * @return Cell|null the cell at given position
   */
  public function getCell(int $position): ?Cell {
    if (array_key_exists($position, $this->cells)) {
      return $this->cells[$position];
    } else {
      return null;
    }
  }

  public function contentToString(): string {
    return implode($this->cells);
  }

  /**
   * Returns an external iterator
   *
   * @return Traversable external iterator
   */
  public function getIterator(): Traversable {
    return new Iterator($this->cells);
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
