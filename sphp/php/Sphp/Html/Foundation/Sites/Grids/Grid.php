<?php

/**
 * Grid.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\WrappingContainer;

/**
 * Implements a Foundation grid 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Grid extends WrappingContainer implements GridInterface {

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
  public function __construct($row = null) {
    $wrapper = function ($c) {
      if (!($c instanceof RowInterface)) {
        $c = new Row($c);
      }
      return $c;
    };
    parent::__construct($wrapper, $row);
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
   * 
   * @param  array $rows single or two dimensional array of column data
   * @return self new instance containing given content as rows
   */
  public static function from(array $rows) {
    $grid = new Static();
    foreach ($rows as $row) {
      $grid->append($row);
    }
    return $grid;
  }
  
  
  /**
   * Sets/ the row completely fluid
   *
   * @param  boolean $expanded the target screen size
   * @return $this for a fluent interface
   */
  public function expand($expanded = true) {
    foreach($this as $row) {
      $row->layout()->expand($expanded);
    }
    return $this;
  }
  
}
