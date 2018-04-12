<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Div;

/**
 * Implements a Foundation framework based XY Grid Column
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license https://opensource.org/licenses/MIT The MIT License
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
  public function __construct($content = null, array $layout = ['auto']) {
    parent::__construct($content);
    $this->layoutManager = new ColumnLayoutManager($this);
    $this->layout()->setLayouts($layout);
  }

  public function layout(): ColumnLayoutManagerInterface {
    return $this->layoutManager;
  }

  public static function create($content, array $layout = ['auto']): Column {
    return new Column($content, $layout);
  }

}
