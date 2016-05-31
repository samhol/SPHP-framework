<?php

/**
 * BlockGrid.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\TraversableInterface as TraversableInterface;
use Sphp\Html\TraversableTrait as TraversableTrait;
use Sphp\Html\WrappingContainer as WrappingContainer;
use Sphp\Core\Types\BitMask as BitMask;

/**
 * Class makes it possible to evenly split contents of a list within the grid.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-02-13
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/docs/components/block_grid.html Foundation Block Grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BlockGrid extends AbstractComponent implements TraversableInterface {

  use TraversableTrait;

  /**
   * The maximum block grid value (int 12)
   */
  const MAX_GRID = 8;

  /**
   * The block grid value is inherited from the smaller screen (int 0)
   */
  const INHERITED = 0;

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * {@link self} component is mobile-first. Code for small screens first,
   * and larger devices will inherit those styles. Customize for
   * larger screens as necessary.
   *
   * If you use the small block grid only, the grid will keep its spacing and
   * configuration no matter the screen size. If you use large block grid
   * only, the list items will stack on top of each other for small devices.
   * If you use both of those classes combined, you can control the
   * configuration and layout separately for each breakpoint.
   *
   * @param  mixed $items list elements
   * @param  int $small the number of items in a row for small screens
   * @param  int $medium the number of items in a row for medium screens
   * @param  int $large the number of items in a row for large screens
   */
  public function __construct($items = null, $small = 3, $medium = self::INHERITED, $large = self::INHERITED) {
    $wrapper = function($c) {
      if (!($c instanceof BlockGridColumn)) {
        $c = new BlockGridColumn($c);
      }
      return $c;
    };
    parent::__construct("div", null, new WrappingContainer($wrapper));
    $this->setBlockGrids($small, $medium, $large);
    if ($items !== null) {
      foreach (is_array($items) ? $items : [$items] as $item) {
        $this->append($item);
      }
    }
    $this->cssClasses()->lock("row");
  }

  public function append($column) {
    $this->content()->append($column);
    return $this;
  }

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  int $small the number of items in a row for small screens
   * @param  int $medium the number of items in a row for medium screens
   * @param  int $large the number of items in a row for large screens
   * @return self for PHP Method Chaining
   */
  public function setBlockGrids($small, $medium, $large) {
    return $this->setBlockGrid($small, Screen::SMALL)
                    ->setBlockGrid($medium, Screen::MEDIUM)
                    ->setBlockGrid($large, Screen::LARGE);
  }

  /**
   * Resets the block grid values for all screen types
   *
   * @return self for PHP Method Chaining
   */
  public function resetBlockGrids() {
    $this->setBlockGrid(3, Screen::SMALL)
            ->setBlockGrid(self::INHERITED, Screen::MEDIUM | Screen::LARGE);
    return $this;
  }

  /**
   * Sets the block grid value of the small screens
   *
   * If you use the small block grid only, the grid will keep its spacing and
   * configuration no matter the screen size.
   *
   * @param  int $num the number of items in a row
   * @return self for PHP Method Chaining
   */
  public function setSmallBlockGrid($num) {
    return $this->setBlockGrid($num, Screen::SMALL);
  }

  /**
   * Sets the block grid value of the medium screens
   *
   * @param  int $num the number of items in a row
   * @return self for PHP Method Chaining
   */
  public function setMediumBlockGrid($num) {
    return $this->setBlockGrid($num, Screen::MEDIUM);
  }

  /**
   * Sets the block grid value of the large screens
   *
   * @param  int $num number of elements in large block grid
   * @return self for PHP Method Chaining
   */
  public function setLargeBlockGrid($num) {
    return $this->setBlockGrid($num, Screen::LARGE);
  }

  /**
   * Sets the block grid value of the given target screen types
   *
   * **Important!**
   *
   * {@link self} component is mobile-first. Code for small screens first,
   * and larger devices will inherit those styles. Customize for
   * larger screens as necessary.
   *
   * @precondition The value of the `$num` parameter is between (0-12)
   * @precondition parameter `$screens` has a bitmask value combining named 
   *         constants {@link Screen::SMALL}, 
   *         {@link Screen::MEDIUM} and 
   *         {@link Screen::LARGE} or aa combination of strings 
   *         `"small"`, `"medium"`, `"large"`
   * @param  int|string|BitMask $screens the target screen size(s)
   * @param  int $num the width of the column
   * @param  int $screens the targeted screensizes as a bitmask
   * @return self for PHP Method Chaining
   */
  public function setBlockGrid($num, $screens = Screen::SMALL) {
    if ($num > self::MAX_GRID) {
      $num = self::MAX_GRID;
    }
    if ($num < 1) {
      $num = self::INHERITED;
    }
    $this->unsetBlockGrid($screens);
    foreach (Screen::parseScreens($screens) as $screenName) {
      //$this->widths[$screenType] = $num;
      if ($num != self::INHERITED) {
        $this->addCssClass("$screenName-up-$num");
      }
    }
    return $this;
  }

  /**
   * Returns the block grid value of the target screen
   *
   * @precondition parameter `$screens` has a bitmask value combining named 
   *         constants {@link Screen::SMALL}, 
   *         {@link Screen::MEDIUM} and 
   *         {@link Screen::LARGE} or aa combination of strings 
   *         `"small"`, `"medium"`, `"large"`
   * @param  int $screen the target screensize
   * @return int the block grid value of the target screen (1-12)
   */
  public function getBlockGridValue($screen = Screen::SMALL) {
    $parseGrid = function($screenName) {
      $result = self::INHERITED;
      for ($i = 1; $i <= 12; $i++) {
        if ($this->cssClasses()->contains("$screenName-up-$i")) {
          $result = $i;
        }
      }
      return $result;
    };
    $screenName = Screen::getScreenName($screen);
    $num = self::INHERITED;
    if ($screenName == "large") {
      $num = $parseGrid("large");
    }
    if ($screenName == "medium" || ($screenName == "large" && $num == self::INHERITED)) {
      $num = $parseGrid("medium");
    }
    if ($screenName == "small" || ($screenName != "small" && $num == self::INHERITED)) {
      $num = $parseGrid("small");
    }
    return $num;
  }

  /**
   * Unsets the block grid setting for the given screen widths
   *
   * @precondition parameter `$screens` has a bitmask value combining named 
   *         constants {@link Screen::SMALL}, 
   *         {@link Screen::MEDIUM} and 
   *         {@link Screen::LARGE} or aa combination of strings 
   *         `"small"`, `"medium"`, `"large"`
   * @param  int|string|BitMask $screens the target screen size(s)
   * @return self for PHP Method Chaining
   */
  protected function unsetBlockGrid($screens) {
    $classes = [];
    foreach (Screen::parseScreens($screens) as $screenName) {
      for ($i = 1; $i <= 12; $i++) {
        $classes[] = "$screenName-up-$i";
      }
    }
    $this->removeCssClass($classes);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    return $this->content()->getIterator();
  }

  /**
   * {@inheritdoc}
   */
  public function count() {
    return $this->content()->count();
  }

}
