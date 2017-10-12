<?php

/**
 * AbstractColumnLayoutProperties.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids\XY;

use Sphp\Html\AbstractLayoutManager;

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

  public function isStretched(): bool {
    return $this->cssClasses()->contains('fluid') || $this->cssClasses()->contains('full');
  }

  public function stretch(string $type = 'fluid') {
    $this->unStretch()->cssClasses()->set($type);
    return $this;
  }

  public function unStretch() {
    $this->cssClasses()->remove('fluid', 'full');
    return $this;
  }

  public function setLayouts($layouts) {
    $this->cssClasses()->set($layouts);
    $this->cssClasses()->set('grid-container');
    return $this;
  }

  public function unsetLayouts() {
    $this->unStretch();
    return $this;
  }

}
