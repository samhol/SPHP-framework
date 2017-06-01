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

  /**
   * Sets the number of columns within the row for different screen sizes
   * 
   * @param  string[] $layout individual layout settings
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function setLayouts(array $layout) {
    $this->unsetLayouts();
    foreach ($layout as $width) {
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
   * Sets the block grid value of the given target screen types
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
   */
  public function collapse($screenSize) {
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
  public function uncollapse($screenSize) {
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
  public function reset($screenSize) {
    $classes = [];
    $classes[] = "$screenSize-collapse";
    $classes[] = "$screenSize-uncollapse";
    $this->cssClasses()->remove($classes);
    return $this;
  }

}
