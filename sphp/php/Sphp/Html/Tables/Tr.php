<?php

/**
 * Tr.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Html\ContainerTag;
use Sphp\Html\Document;

/**
 * Implements an HTML &lt;tr&gt; tag
 *
 *  The {@link self} component represents a row of {@link CellInterface}
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
class Tr extends ContainerTag implements RowInterface {

  /**
   * the default type of the table cells (`td`|`th`)
   *
   * @var string 
   */
  private $cellType = "td";

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
  public function __construct($cells = null, $cellType = 'td') {
    parent::__construct('tr');
    $this->setDefaultCellType($cellType);
    if (isset($cells)) {
      $this->append($cells, $cellType);
    }
  }

  /**
   * Sets the default type of the table cells
   * 
   * @param  string $defaultCell the default type of the cell
   *         (`td`|`th`)
   * @return self for PHP Method Chaining
   */
  public function setDefaultCellType($defaultCell) {
    $this->cellType = $defaultCell;
    return $this;
  }

  /**
   * Sets the default type of the table cells
   * 
   * @return string the default type of the cell `td|th`
   */
  public function getDefaultCellType() {
    return $this->cellType;
  }

  /**
   * Appends {@link CellInterface} components to the table row component
   *
   * **Notes:**
   *
   *  mixed <var>$cells</var> can be of any type that converts to a string or
   *  to a string[].
   *
   * <var>$cellType</var> attribute can have two case insensitive values:
   * 
   * * 'td' => all mixed <var>$cells</var> are wrapped with {@link Td}
   * * 'th' => all mixed <var>$cells</var> are wrapped with {@link Th}
   * 
   *
   * @param  mixed|Cell|Cell[] $cells cells of the table row
   * @param  string $cellType the default type of the cell `td|th`
   * @return self for PHP Method Chaining
   */
  public function append($cells, $cellType = 'td') {
    parent::append($this->parseNewCells($cells, $cellType));
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
    parent::prepend($this->parseNewCells($cells, $cellType));
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
        $arr[] = Document::get($cellType)->append($cell);
      }
    }
    return $arr;
  }

  /**
   * Assigns a single {@link TableCell} component to the specified offset
   *
   * **Notes:**
   *
   *  mixed <var>$value</var> can be of any type that converts to a string or
   *  to a string[].
   *
   *  a non {@link Cell} <var>$value</var> is wrapped to a {@link Td} object
   *
   * @param mixed $offset the offset to assign the value to
   * @param mixed|Cell $value the value to set
   * @link  http://php.net/manual/en/arrayaccess.offsetset.php ArrayAccess::offsetGet
   */
  public function offsetSet($offset, $value) {
    $cell = ($value instanceof Cell) ? $value : Document::get($this->getDefaultCellType())->append($value);
    parent::offsetSet($offset, $cell);
  }

}
