<?php

/**
 * BlockGrid.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Grids;

use Sphp\Html\AbstractContainerComponent as AbstractContainerComponent;
use Sphp\Html\TraversableInterface as TraversableInterface;
use Sphp\Html\TraversableTrait as TraversableTrait;
use Sphp\Html\WrappingContainer as WrappingContainer;
use Sphp\Core\Types\BitMask as BitMask;
use Sphp\Html\Foundation\F6\Core\Screen as Screen;

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
class BlockGrid extends AbstractContainerComponent implements TraversableInterface {

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
  public function __construct($items = null, $small = false, $medium = false, $large = false, $xlarge = false, $xxlarge = false) {
    $wrapper = function($c) {
      if (!($c instanceof BlockGridColumn)) {
        $c = new BlockGridColumn($c);
      }
      return $c;
    };
    parent::__construct("div", null, new WrappingContainer($wrapper));
    $widthSetter = function ($width, $sreenSize) {
      if ($width > 0 && $width < 9) {
        $this->cssClasses()->add("$sreenSize-up-$width");
      }
    };
    $widthSetter($small, "small");
    $widthSetter($medium, "medium");
    $widthSetter($large, "large");
    $widthSetter($xlarge, "xlarge");
    $widthSetter($xxlarge, "xxlarge");
    if ($items !== null) {
      foreach (is_array($items) ? $items : [$items] as $item) {
        $this->append($item);
      }
    }
    $this->cssClasses()->lock("row");
  }

  /**
   * Appends a new Column to the container
   * 
   * @param  mixed $column column or column content
   * @return self for PHP Method Chaining
   */
  public function append($column) {
    $this->content()->append($column);
    return $this;
  }

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  int|boolean $small number of columns in a row for small screens (0-8) or false for inheritance
   * @param  int|boolean $medium number of columns in a row for medium screens (0-8) or false for inheritance
   * @param  int|boolean $large number of columns in a row for large screens (0-8) or false for inheritance
   * @param  int|boolean $xlarge number of columns in a row for x-large screens (0-8) or false for inheritance
   * @param  int|boolean $xxlarge number of columns in a row for xx-large screen)s (0-8) or false for inheritance
   * @return self for PHP Method Chaining
   */
  public function setBlockGrids($small = false, $medium = false, $large = false, $xlarge = false, $xxlarge = false) {
    return $this->setBlockGrid($small, "small")
                    ->setBlockGrid($medium, "medium")
                    ->setBlockGrid($large, "large")
                    ->setBlockGrid($xlarge, "xlarge")
                    ->setBlockGrid($xxlarge, "xxlarge");
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
   * @precondition The value of the `$num` parameter is between (1-8) or false for inheritance
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  int|boolean $num number of columns in a row (0-12) or false for inheritance
   * @param  string $screenSize the target screen size
   * @return self for PHP Method Chaining
   */
  public function setBlockGrid($num, $screenSize) {
    if ($num > self::MAX_GRID) {
      $num = self::MAX_GRID;
    }
    $this->unsetBlockGrid($screenSize);
    if ($num !== false) {
      $this->addCssClass("$screenSize-up-$num");
    }
    return $this;
  }

  /**
   * Returns the block grid value of the target screen
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return int the block grid value of the target screen (1-12)
   */
  public function getBlockGridValue($screenSize) {
    $parseGrid = function($screenName) {
      $result = false;
      for ($i = 1; $i <= 8; $i++) {
        if ($this->cssClasses()->contains("$screenName-up-$i")) {
          $result = $i;
          break;
        }
      }
      return $result;
    };
    $screenName = Screen::getScreenName($screenSize);
    $num = self::INHERITED;
    foreach (Screen::getScreenSizeNames() as $screenName) {
      $num = $parseGrid($screenName);
      if ($screenName == $screenSize) {
        break;
      }
    }
    return $num;
  }

  /**
   * Unsets the block grid setting for the given screen widths
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for PHP Method Chaining
   */
  protected function unsetBlockGrid($screenSize) {
    $classes = [];
    for ($i = 1; $i <= 8; $i++) {
      $classes[] = "$screenSize-up-$i";
    }
    $this->cssClasses()->remove($classes);
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
