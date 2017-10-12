<?php

/**
 * AbstractGrid.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids\XY;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Container;

/**
 * Implements a grid 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractGrid extends AbstractComponent implements \IteratorAggregate, GridInterface {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var Container 
   */
  private $content;

  /**
   * @var GridLayoutManager 
   */
  private $layoutManager;

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * 1. Parameter `mixed $content` can be of any type that converts to a string 
   *    or to an array of strings. So also objects of any type that implement magic 
   *    method `__toString()` are allowed.
   * 2. `mixed $content` is transformed to a @link Row} component.
   *
   * @param  mixed|RowInterface $row a row content or a row component
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct(string $tagName) {
    parent::__construct($tagName);
    $this->content = new Container();
    $this->layoutManager = new GridLayoutManager($this);
  }

  /**
   * Returns all {@link ColumnInterface} components from the grid
   * 
   * @return Container containing all the {@link ColumnInterface} components
   */
  public function getColumns() {
    return $this->getComponentsByObjectType(ColumnInterface::class);
  }

  /**
   * Sets/ the row completely fluid
   *
   * @param  boolean $expanded the target screen size
   * @return $this for a fluent interface
   */
  public function expand($expanded = true) {
    foreach ($this as $row) {
      $row->layout()->expand($expanded);
    }
    return $this;
  }

  public function append($row) {
    if (!($row instanceof RowInterface)) {
      $row = new Row($row);
    }
    $this->content->append($row);
    return $this;
  }

  public function contentToString(): string {
    return $this->content->getHtml();
  }

  public function count(): int {
    return $this->content->count();
  }

  public function prepend($row) {
    if (!($row instanceof RowInterface)) {
      $row = new Row($row);
    }
    $this->content->prepend($row);
    return $this;
  }

  public function current() {
    
  }

  public function key() {
    
  }

  public function next() {
    
  }

  public function rewind() {
    
  }

  public function getIterator() {
    return $this->content->getIterator();
  }

}
