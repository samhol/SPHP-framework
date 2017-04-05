<?php

/**
 * AbstractRow.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\TraversableInterface;
use Sphp\Html\Attributes\AttributeManager;
use Sphp\Html\ContainerInterface;

/**
 * Implements an HTML &lt;tr&gt; tag
 *
 *  This component represents a row of {@link CellInterface}
 *  components in a {@link Table}.
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-03
 * @link    http://www.w3schools.com/tags/tag_tr.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-tr-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractRow extends AbstractContainerComponent implements \IteratorAggregate, TraversableInterface, RowInterface {

  use \Sphp\Html\TraversableTrait;

  /**
   * Constructs a new instance
   *
   * **Notes:**
   *
   *  mixed `$cells` can be of any type that converts to a PHP string or to a 
   *  PHP string[].
   *
   * @param  AttributeManager|null $attrManager the attribute manager of the component
   * @param  ContainerInterface|null $contentContainer the inner content container of the component
   */
  public function __construct(AttributeManager $attrManager = null, ContainerInterface $contentContainer = null) {
    parent::__construct('tr', $attrManager, $contentContainer);
  }

  /**
   * Appends a cell component to the row
   *
   * @param  CellInterface $cell new cell object
   * @return self for a fluent interface
   */
  public function append(CellInterface $cell) {
    $this->getInnerContainer()->append($cell);
    return $this;
  }

  /**
   * Creates and appends a new {@link Th} cell to the row
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
   * @return self for a fluent interface
   */
  public function appendTh($content, $scope = null, $colspan = 1, $rowspan = 1) {
    $this->append(new Th($content, $scope, $colspan, $rowspan));
    return $this;
  }

  /**
   * Creates and appends {@link CellInterface} components to the row
   *
   * @param  mixed|mixed[] $cells cells of the table row
   * @return self for a fluent interface
   */
  public function appendThs($cells) {
    foreach ($this->parseNewCells($cells, Th::class) as $th) {
      $this->append($th);
    }
    return $this;
  }

  /**
   * Creates and appends a new {@link Td} cell to the row
   *
   * @precondition  $colspan >= 1
   * @precondition  $rowspan >= 1
   * @param mixed $content the content of the component
   * @param int $colspan the value of the colspan attribute
   * @param int $rowspan the value of the rowspan attribute
   * @link  http://www.w3schools.com/tags/att_td_colspan.asp colspan attribute
   * @link  http://www.w3schools.com/tags/att_td_rowspan.asp rowspan attribute
   * @return self for a fluent interface
   */
  public function appendTd($content, $colspan = 1, $rowspan = 1) {
    $this->append(new Td($content, $colspan, $rowspan));
    return $this;
  }

  /**
   * Creates and appends {@link CellInterface} components to the row
   *
   * @param  mixed|mixed[] $cells cells of the table row
   * @return self for a fluent interface
   */
  public function appendTds($cells) {
    foreach ($this->parseNewCells($cells, Td::class) as $td) {
      $this->append($td);
    }
    return $this;
  }

  /**
   * Prepends a cell component to the row
   *
   * @param  CellInterface $cell new cell object
   * @return self for a fluent interface
   */
  public function prepend(CellInterface $cell) {
    $this->getInnerContainer()->prepend($cell);
    return $this;
  }

  /**
   * Returns the input as an array of components extending {@link TableCell}
   *
   *  mixed <var>$rawData</var> can be of any type that converts to a string or
   *  to a string[].
   *
   * <var>$rawData</var> attribute can have two case insensitive values:
   * 
   * * 'td' => all mixed <var>$rawData</var> are of type {@link Td}
   * * 'th' => all mixed <var>$rawData</var> are of type {@link Th}
   * 
   * @param  mixed|mixed[] $rawData cells of the table row
   * @param  string $cellType the default type of the cell `td|th`
   * @return CellInterface[] table cells
   */
  protected function parseNewCells($rawData, $cellType = Td::class) {
    foreach (is_array($rawData) ? $rawData : [$rawData] as $cell) {
      if ($cell instanceof CellInterface) {
        $arr[] = $cell;
      } else {
        $arr[] = new $cellType($cell);
      }
    }
    return $arr;
  }

  public function getIterator() {
    return $this->getInnerContainer();
  }

  /**
   * Counts of the cells in the row
   *
   * @return int number of the cells in the row
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count() {
    return $this->getInnerContainer()->count();
  }

}
