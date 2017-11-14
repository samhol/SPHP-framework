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
   * @var string[]
   */
  public static $stretch = ['fluid', 'full'];

  /**
   * Constructs a new instance
   * 
   * @param CssClassifiedComponent $component
   */
  public function __construct(CssClassifiedComponent $component) {
    parent::__construct($component);
    $this->cssClasses()->protect('grid-container');
  }

  public function isStretched(): bool {
    return $this->cssClasses()->containsOneOf(static::$stretch);
  }

  public function stretch(string $type = null) {
    $this->setOneOf(static::$stretch, $type);
    return $this;
  }

  public function unStretch() {
    $this->cssClasses()->remove(static::$stretch);
    return $this;
  }

  public function setLayouts(...$layouts) {
    $this->cssClasses()->set($layouts);
    $this->cssClasses()->set('grid-container');
    return $this;
  }

  public function unsetLayouts() {
    $this->unStretch();
    return $this;
  }

}
