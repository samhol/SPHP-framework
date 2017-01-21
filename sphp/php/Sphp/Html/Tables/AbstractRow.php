<?php

/**
 * AbstractRow.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\Document;
use Sphp\Html\TraversableInterface;

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
   * `$cellType` parameter defines the type of the wrapper for`$cells` not instanceof  {@link CellInterface}
   *  
   * * `td` => all `$cells` not extending {@link CellInterface} are wrapped within a {@link Td} component
   * * `th` => all `$cells` not extending {@link CellInterface} are wrapped within a {@link Th} component
   *
   * @param  null|mixed|mixed[] $cells cell(s) of the table row or null for no content
   * @param  string $cellType the default type of the cell 
   *         (`td`|`th`)
   */
  public function __construct() {
    parent::__construct('tr');
  }


  /**
   * Appends cell components to the table row
   *
   * @param  CellInterface $cell new cell object
   * @return self for PHP Method Chaining
   */
  public function append(CellInterface $cell) {
    $this->getInnerContainer()->append($cell);
    return $this;
  }

  /**
   * Creates and appends {@link CellInterface} components to the table row component
   *
   * @param  mixed|mixed[] $cells cells of the table row
   * @return self for PHP Method Chaining
   */
  public function appendThs($cells) {
    $this->getInnerContainer()->append($this->parseNewCells($cells, 'th'));
    return $this;
  }

  /**
   * Creates and appends {@link CellInterface} components to the table row component
   *
   * @param  mixed|mixed[] $cells cells of the table row
   * @return self for PHP Method Chaining
   */
  public function appendTds($cells) {
    $this->getInnerContainer()->append($this->parseNewCells($cells, 'td'));
    return $this;
  }

  /**
   * Prepends {@link Cell} components to the table row component
   *
   * **Notes:**
   *
   *  **Important!** The keys of the object will be renumbered starting from
   *  zero.
   *
   *  mixed <var>$cells</var> can be of any type that converts to a string or
   *  to a string[].
   *
   * <var>$cellType</var> attribute can have two case insensitive values:
   * 
   * * 'td' => all mixed <var>$cells</var> are of type {@link Td}
   * * 'th' => all mixed <var>$cells</var> are of type {@link Th}
   * 
   *
   * @param  mixed|Cell|Cell[] $cells cells of the table row
   * @param  string $cellType the default type of the cell `td|th`
   * @return self for PHP Method Chaining
   */
  public function prepend($cells, $cellType = 'td') {
    $this->getInnerContainer()->prepend($this->parseNewCells($cells, $cellType));
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
   * @param  mixed|Cell|Cell[] $rawData cells of the table row
   * @param  string $cellType the default type of the cell `td|th`
   * @return Cell[] table cells
   */
  protected function parseNewCells($rawData, $cellType = 'td') {
    foreach (is_array($rawData) ? $rawData : [$rawData] as $cell) {
      if ($cell instanceof Cell) {
        $arr[] = $cell;
      } else {
        $arr[] = Document::get($cellType)->setContent($cell);
      }
    }
    return $arr;
  }

  public function getIterator() {
    
  }

}
