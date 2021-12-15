<?php

declare(strict_types=1);

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
use Sphp\Html\ContentIterator;

/**
 * Implementation of an HTML tr tag
 *
 *  This component represents a row of {@link CellInterface}
 *  components in a {@link Table}.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_tr.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-tr-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Tr extends AbstractComponent implements IteratorAggregate, Row {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var Cell[]
   */
  private array $cells = [];

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

  public function appendThs(... $cells) {
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

  public function appendTds(... $cells) {
    foreach ($cells as $td) {
      if ($td instanceof Cell) {
        $this->append($td);
      } else {
        $this->appendTd($td);
      }
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
    array_unshift($this->cells, $cell);
    return $this;
  }

  public function contentToString(): string {
    return implode($this->cells);
  }

  /**
   * Returns an external iterator
   *
   * @return ContentIterator<Cell> external iterator
   */
  public function getIterator(): ContentIterator {
    return new ContentIterator($this->cells);
  }

  /**
   * Checks whether an offset exists
   *
   * @param mixed $offset an offset to check for
   * @return bool true on success or false on failure
   */
  public function offsetExists($offset): bool {
    return array_key_exists($offset, $this->cells);
  }

  /**
   * Returns the content element at the specified offset
   *
   * @param  mixed $offset the index with the content element
   * @return Cell|null content element or null
   */
  public function offsetGet($offset): ?Cell {
    if ($this->offsetExists($offset)) {
      return $this->cells[$offset];
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
    if (!$value instanceof Cell) {
      $value = new Td($value);
    }
    $this->cells[$offset] = $value;
  }

  /**
   * Unsets an offset
   *
   * @param  mixed $offset offset to unset
   * @return void
   */
  public function offsetUnset($offset): void {
    if ($this->offsetExists($offset)) {
      unset($this->cells[$offset]);
    }
  }

  /**
   * Creates a new tr component
   * 
   * @param  array $tds 
   * @return Tr<Td> created tr component
   */
  public static function fromTds(array $tds): Tr {
    $tr = new static();
    foreach ($tds as $key => $value) {
      if (!$value instanceof Td) {
        $value = new Td($value);
      }
      $tr[$key] = $value;
    }
    return $tr;
  }

  /**
   * Creates a new tr component
   * 
   * @param  array $ths
   * @return Tr<Th> created tr component
   */
  public static function fromThs(array $ths): Tr {
    $tr = new static();
    foreach ($ths as $key => $value) {
      if (!$value instanceof Th) {
        $value = new Th($value);
      }
      $tr[$key] = $value;
    }
    return $tr;
  }

}
