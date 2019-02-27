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
 * Implements an XY Grid Cell
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DivCell extends Div implements Cell {

  /**
   * @var BasicCellLayout 
   */
  private $layoutManager;

  /**
   * Constructor
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
    $this->layoutManager = new BasicCellLayout($this);
    $this->layout()->setLayouts($layout);
  }

  public function layout(): CellLayout {
    return $this->layoutManager;
  }

  public static function create($content, array $layout = ['auto']): DivCell {
    return new static($content, $layout);
  }

}
