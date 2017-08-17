<?php

/**
 * BlockGridLayoutManager.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\AbstractLayoutManager;
use Sphp\Html\ComponentInterface;
use Sphp\Html\Foundation\Sites\Core\Screen;

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
    $this->cssClasses()->lock('row');
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
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function setLayouts($layouts) {
    $this->unsetLayouts();
    foreach (is_array($layouts) ? $layouts : [$layouts] as $layout) {
      $parts = explode('-', $layout);
      $this->setGrid($parts[2], $parts[0]);
    }
    return $this;
  }

  /**
   * Sets the block grid value of the given target screen types
   *
   * @precondition The value of the `$num` parameter is between (1-8) or false for inheritance
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  int $num number of columns in a row (1-8) or false for inheritance
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function setGrid(int $num, string $screenSize) {
    if ($num < 1 || $num > $this->getColumnCount()) {
      throw new \Sphp\Exceptions\InvalidArgumentException($num);
    }
    $this->unsetGrid($screenSize);
    $this->cssClasses()->add("$screenSize-up-$num");
    return $this;
  }

  /**
   * Unsets all layout settings 
   * 
   * @return self for a fluent interface
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
   * @return self for a fluent interface
   */
  protected function unsetGrid(string $screenSize) {
    $classes = [];
    for ($i = 1; $i <= $this->getColumnCount(); $i++) {
      $classes[] = "$screenSize-up-$i";
    }
    $this->cssClasses()->remove($classes);
    return $this;
  }

  /**
   * Returns the block grid value of the target screen
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return int the column count value per row for given target screen size
   */
  public function getColCount(string $screenSize) {
    $parseGrid = function($screenName) {
      $result = false;
      for ($i = 1; $i <= $this->getColumnCount(); $i++) {
        if ($this->cssClasses()->contains("$screenName-up-$i")) {
          $result = $i;
          break;
        }
      }
      return $result;
    };
    //$screenName = Screen::getScreenName($screenSize);
    $num = 0;
    foreach (Screen::sizes() as $screenName) {
      $num = $parseGrid($screenName);
      if ($screenName == $screenSize) {
        break;
      }
    }
    return $num;
  }

}
