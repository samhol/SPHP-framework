<?php

/**
 * AbstractColumnLayoutProperties.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Foundation\Sites\Core\AbstractLayoutManager;
use Sphp\Html\CssClassifiableContent;

/**
 * Implements a layout manager for a Foundation framework based XY Grid container
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class GridLayoutManager extends AbstractLayoutManager implements GridLayoutManagerInterface {

  /**
   * Constructs a new instance
   * 
   * @param CssClassifiableContent $component
   */
  public function __construct(CssClassifiableContent $component) {
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
