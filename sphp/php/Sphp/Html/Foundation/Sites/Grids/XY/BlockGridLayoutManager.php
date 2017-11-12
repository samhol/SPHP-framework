<?php

/**
 * BlockGridLayoutManager.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids\XY;

use Sphp\Html\ComponentInterface;
use Sphp\Html\Foundation\Sites\Core\Screen;
use Sphp\Html\Foundation\Sites\Core\AbstractLayoutManager;
use Sphp\Stdlib\Arrays;
/**
 * Implements a layout manager for Block Grid columns
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/block_grid.html Foundation Block Grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BlockGridLayoutManager extends AbstractLayoutManager {

  /**
   * @var int 
   */
  private $maxSize = 8;

  /**
   * Constructs a new instance
   *
   * @param ComponentInterface $component
   * @param int $max
   */
  public function __construct(ComponentInterface $component, int $max = 8) {
    parent::__construct($component);
    $this->maxSize = $max;
    $this->cssClasses()->protect('row');
  }

  /**
   * 
   * @return int
   */
  public function getColumnCount(): int {
    return $this->maxSize;
  }

  /**
   * Sets the number of columns within the row for different screen sizes
   * 
   * @param  string[] $layouts individual layout settings
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function setLayouts(...$layouts) {
    $this->setWidths($layouts);
    return $this;
  }

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  string|string[] $widths column widths for different screens sizes
   * @return $this for a fluent interface
   */
  public function setWidths(... $widths) {
    $widths = Arrays::flatten($widths);
    $filtered = preg_grep('/^((small|medium|large|xlarge|xxlarge)-up-([1-9]|(1[0-2])))+$/', $widths);
    foreach ($filtered as $width) {
      $parts = explode('-', $width);
      $this->unsetGrid($parts[0]);
      $this->cssClasses()->add($width);
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
      $this->unsetGrid($screenSize);
    }
    return $this;
  }

  /**
   * Unsets the block grid setting for the given screen widths
   *
   * @precondition `$screenSize` == `medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  protected function unsetGrid(string $screenSize) {
    $classes = [];
    for ($i = 1; $i <= $this->getColumnCount(); $i++) {
      $classes[] = "$screenSize-up-$i";
    }
    $this->cssClasses()->remove($classes);
    return $this;
  }

}
