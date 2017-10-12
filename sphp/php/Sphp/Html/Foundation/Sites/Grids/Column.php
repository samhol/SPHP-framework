<?php

/**
 * Column.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Div;

/**
 * Implements framework based component to create  multi-device layouts
 *
 * The sum of the column widths in a row should never exceed 12.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Column extends Div implements ColumnInterface {

  /**
   * @var ColumnLayoutManager 
   */
  private $layoutManager;

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameter `mixed $content` can be of any type that converts to a string.
   * So also an object of any class that implements magic method `__toString()` 
   * is allowed.
   *
   * @param mixed $content the content of the column
   * @param string $layout optional layout parameters
   */
  public function __construct($content = null, array $layout = ['small-12']) {
    parent::__construct($content);
    $this->layoutManager = new ColumnLayoutManager($this);
    $this->layout()->setLayouts($layout);
  }

  public function layout(): ColumnLayoutManagerInterface {
    return $this->layoutManager;
  }

}
