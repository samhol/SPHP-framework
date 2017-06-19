<?php

/**
 * RowLayoutManager.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\AbstractLayoutManager;
use Sphp\Html\Foundation\Sites\Core\Screen;
use Sphp\Html\ComponentInterface;

/**
 * Implements a layout manager for Block Grid columns
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-02-13
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/docs/components/block_grid.html Foundation Block Grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class RowLayoutManager extends AbstractLayoutManager {

  /**
   * Constructs a new instance
   *
   * @param ComponentInterface $component
   */
  public function __construct(ComponentInterface $component) {
    parent::__construct($component);
    $this->cssClasses()->lock('row');
  }

  public function setLayouts($layout) {
    $this->unsetLayouts();
    foreach (is_array($layout) ? $layout : [$layout] as $width) {
      $parts = explode('-', $width);
      $this->setGrid($parts[2], $parts[0]);
    }
    return $this;
  }

  /**
   * Unsets all layout settings 
   * 
   * @return self for a fluent interface
   */
  public function unsetLayouts() {
    foreach (Screen::sizes() as $screenSize) {
      $this->reset($screenSize);
    }
    return $this;
  }

  /**
   * Sets/ the row completely fluid
   *
   * @param  boolean $expanded the target screen size
   * @return self for a fluent interface
   */
  public function expand(bool $expanded = true) {
    if ($expanded) {
      $this->cssClasses()->add('expanded');
    } else {
      $this->cssClasses()->remove('expanded');
    }
    return $this;
  }

  /**
   * Sets the block grid value of the given target screen types
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
   */
  public function collapse(string $screenSize) {
    $this->reset($screenSize);
    $this->cssClasses()->add("$screenSize-collapse");
    return $this;
  }

  /**
   * Sets the block grid value of the given target screen types
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
   */
  public function uncollapse(string $screenSize) {
    $this->reset($screenSize);
    $this->cssClasses()->add("$screenSize-uncollapse");
    return $this;
  }

  /**
   * Unsets the block grid setting for the given screen widths
   *
   * @precondition `$screenSize` == `medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
   */
  public function reset(string $screenSize) {
    $classes = [];
    $classes[] = "$screenSize-collapse";
    $classes[] = "$screenSize-uncollapse";
    $this->cssClasses()->remove($classes);
    return $this;
  }

}
