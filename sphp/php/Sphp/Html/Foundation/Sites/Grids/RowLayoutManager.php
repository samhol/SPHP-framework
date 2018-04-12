<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Foundation\Sites\Core\Screen;
use Sphp\Html\ComponentInterface;
use Sphp\Html\Foundation\Sites\Core\AlingmentAdapter;

/**
 * Implements a layout manager for a Foundation framework based XY Row
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/docs/components/block_grid.html Foundation Block Grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class RowLayoutManager extends AlingmentAdapter {

  /**
   * Constructs a new instance
   *
   * @param ComponentInterface $component
   */
  public function __construct(ComponentInterface $component) {
    parent::__construct($component);
    $this->cssClasses()->protect('grid-x');
  }

  public function setLayouts(...$layout) {
    foreach (is_array($layout) ? $layout : [$layout] as $width) {
      $parts = explode('-', $width);

    }
    return $this;
  }

  /**
   * Unsets all layout settings 
   * 
   * @return $this for a fluent interface
   */
  public function unsetLayouts() {
    foreach (Screen::sizes() as $screenSize) {
      $this->reset($screenSize);
    }
    return $this;
  }

  /**
   * 
   * @param  bool $margin
   * @return $this for a fluent interface
   */
  public function useMargin(bool $margin = true) {
    if ($margin) {
      $this->cssClasses()->add('grid-margin-x');
    } else {
      $this->cssClasses()->remove('grid-margin-x');
    }
    return $this;
  }

  /**
   * 
   * @param  bool $padding
   * @return $this for a fluent interface
   */
  public function usePadding(bool $padding = true) {
    if ($padding) {
      $this->cssClasses()->add('grid-padding-x');
    } else {
      $this->cssClasses()->remove('grid-padding-x');
    }
    return $this;
  }

  /**
   * Sets the block grid value of the given target screen types
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
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
   * @return $this for a fluent interface
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
   * @return $this for a fluent interface
   */
  public function reset(string $screenSize) {
    $classes = [];
    $classes[] = "$screenSize-collapse";
    $classes[] = "$screenSize-uncollapse";
    $this->cssClasses()->remove($classes);
    return $this;
  }

}
