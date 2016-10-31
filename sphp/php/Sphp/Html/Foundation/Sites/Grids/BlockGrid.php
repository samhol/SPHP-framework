<?php

/**
 * BlockGrid.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use IteratorAggregate;
use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\TraversableInterface;
use Sphp\Html\TraversableTrait;
use Sphp\Html\WrappingContainer;
use Sphp\Html\Foundation\Sites\Core\Screen;
use Sphp\Html\ContentParserInterface;
use Sphp\Html\ContentParsingTrait as ContentParsingTrait;

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
class BlockGrid extends AbstractContainerComponent implements IteratorAggregate, ContentParserInterface, TraversableInterface {

  use TraversableTrait,
      ContentParsingTrait;

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
   * @param  mixed|mixed[] $items list elements
   * @param  int $s column width for small screens (0-8)
   * @param  int|boolean $m column width for medium screens (0-8) or false for inheritance
   * @param  int|boolean $l column width for large screens (0-8) or false for inheritance
   * @param  int|boolean $xl column width for x-large screens (0-8) or false for inheritance
   * @param  int|boolean $xxl column width for xx-large screen)s (0-8) or false for inheritance
   */
  public function __construct($items = null, $s = 3, $m = false, $l = false, $xl = false, $xxl = false) {
    $wrapper = function($c) {
      if (!($c instanceof BlockGridColumnInterface)) {
        $c = new BlockGridColumn($c);
      }
      return $c;
    };
    parent::__construct('div', null, new WrappingContainer($wrapper));
    $widthSetter = function ($width, $sreenSize) {
      if ($width > 0 && $width < 9) {
        $this->cssClasses()->add("$sreenSize-up-$width");
      }
    };
    $widthSetter($s, "small");
    $widthSetter($m, "medium");
    $widthSetter($l, "large");
    $widthSetter($xl, "xlarge");
    $widthSetter($xxl, "xxlarge");
    if ($items !== null) {
      foreach (is_array($items) ? $items : [$items] as $item) {
        $this->append($item);
      }
    }
    $this->cssClasses()->lock("row");
  }

  /**
   * 
   * @param  string $screenSize
   * @return string[]
   */
  private static function createClasses($screenSize) {
    for ($i = 1; $i <= 8; $i++) {
      $classes[] = "$screenSize-up-$i";
    }
    return $classes;
  }

  /**
   * Appends a new Column to the container
   * 
   * @param  mixed $column column or column content
   * @return self for PHP Method Chaining
   */
  public function append($column) {
    $this->getInnerContainer()->append($column);
    return $this;
  }
  

  /**
   * Appends a new Column to the container
   * 
   * @param  int $index column or column content
   * @return BlockGridColumn|null
   */
  public function getColumn($index) {
    return $this->getInnerContainer()->offsetGet($index);
  }

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  int $s number of columns in a row on small screens (1-8)
   * @param  int|boolean $m number of columns in a row on medium screens (1-8) or false for inheritance
   * @param  int|boolean $l number of columns in a row on large screens (1-8) or false for inheritance
   * @param  int|boolean $xl number of columns in a row on x-large screens (1-8) or false for inheritance
   * @param  int|boolean $xxl number of columns in a row on xx-large screen)s (1-8) or false for inheritance
   * @return self for PHP Method Chaining
   */
  public function setBlockGrids($s, $m = false, $l = false, $xl = false, $xxl = false) {
    $this->setBlockGrid($s, "small")
            ->setBlockGrid($m, "medium")
            ->setBlockGrid($l, "large")
            ->setBlockGrid($xl, "xlarge")
            ->setBlockGrid($xxl, "xxlarge");
    return $this;
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
   * @param  int|boolean $num number of columns in a row (1-8) or false for inheritance
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
   * @return int the block grid value of the target screen (1-8)
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
    //$screenName = Screen::getScreenName($screenSize);
    $num = self::INHERITED;
    foreach (Screen::sizes() as $screenName) {
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
   * @precondition `$screenSize` == `medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for PHP Method Chaining
   */
  protected function unsetBlockGrid($screenSize) {
    $this->cssClasses()->remove(static::createClasses($screenSize));
    return $this;
  }

  public function getIterator() {
    return $this->getInnerContainer()->getIterator();
  }

  public function count() {
    return $this->getInnerContainer()->count();
  }

}
