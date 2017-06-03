<?php

/**
 * ColumnLayoutProperties.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\ComponentInterface;

/**
 * Implements a layout manager for Grid columns
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @link    http://foundation.zurb.com/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ColumnLayoutManager extends AbstractColumnLayoutManager {

  /**
   * Constructs a new instance
   * 
   * @param ComponentInterface $component
   */
  public function __construct(ComponentInterface $component) {
    parent::__construct($component, 12);
    $this->cssClasses()->lock('column');
  }

}
