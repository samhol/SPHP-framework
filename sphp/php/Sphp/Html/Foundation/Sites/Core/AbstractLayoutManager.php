<?php

/**
 * AbstractColumnLayoutProperties.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Attributes\ClassAttribute;
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
abstract class AbstractLayoutManager implements LayoutManager {

  /**
   * @var CssClassifiedComponent
   */
  private $component;

  /**
   * Constructs a new instance
   * 
   * @param CssClassifiedComponent $component
   */
  public function __construct(CssClassifiedComponent $component) {
    $this->component = $component;
  }

  public function cssClasses(): ClassAttribute {
    return $this->component->cssClasses();
  }

}
