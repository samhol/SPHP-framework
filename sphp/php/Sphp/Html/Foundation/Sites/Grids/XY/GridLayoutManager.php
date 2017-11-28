<?php

/**
 * AbstractColumnLayoutProperties.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids\XY;

use Sphp\Html\Foundation\Sites\Core\AbstractLayoutManager;
use Sphp\Html\CssClassifiedComponent;

/**
 * Implements an abstract layout manager for responsive HTML components
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @link    http://foundation.zurb.com/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class GridLayoutManager extends AbstractLayoutManager implements GridLayoutManagerInterface {

  /**
   * Constructs a new instance
   * 
   * @param CssClassifiedComponent $component
   */
  public function __construct(CssClassifiedComponent $component) {
    parent::__construct($component);
    $this->cssClasses()->protect('grid-container');
  }
  public function setFluid(bool $fluid = false) {
    if ($fluid) {
      $this->cssClasses()->remove('full')->set('fluid');
    } else {
      $this->cssClasses()->remove('fluid');
    }
    return $this;
  }

  public function setFull(bool $full = false) {
    if ($full) {
      $this->cssClasses()->remove('fluid')->set('full');
    } else {
      $this->cssClasses()->remove('full');
    }
    return $this;
  }

  public function setLayouts(...$layouts) {
    $this->cssClasses()->set($layouts);
    $this->cssClasses()->set('grid-container');
    return $this;
  }

  public function unsetLayouts() {
    $this->setFluid(false)->setFull(false);
    return $this;
  }

}
