<?php

/**
 * AbstractColumnLayoutProperties.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Foundation\Sites\Core\Screen;
use Sphp\Stdlib\Arrays;
use Sphp\Html\CssClassifiableContent;
use Sphp\Stdlib\Strings;
use Sphp\Html\Foundation\Sites\Core\SelfAlingmentAdapter;

/**
 * Implements a layout manager for a Foundation framework based XY Grid Column
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ColumnLayoutManager extends SelfAlingmentAdapter implements ColumnLayoutManagerInterface {

  /**
   * @var int 
   */
  private $maxSize;

  /**
   * Constructs a new instance
   * 
   * @param CssClassifiableContent $component
   * @param int $maxSize
   */
  public function __construct(CssClassifiableContent $component, int $maxSize = 12) {
    parent::__construct($component);
    $this->maxSize = $maxSize;
    $this->cssClasses()->protect('cell');
  }

  /**
   * 
   * @return int
   */
  public function getMaxSize(): int {
    return $this->maxSize;
  }

  public function setLayouts(...$layouts) {
    $this->setWidths($layouts);
    $this->setOffsets($layouts);
    parent::setLayouts($layouts);
    return $this;
  }

  public function unsetLayouts() {
    $this->unsetWidths()
            ->unsetOffsets();
    parent::unsetLayouts();
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
    $filtered = preg_grep('/^((small|medium|large|xlarge|xxlarge)-([1-9]|(1[0-2])|auto)|auto)+$/', $widths);
    foreach ($filtered as $width) {
      if ($width === 'auto') {
        $this->unsetWidths();
      } else {
        $parts = explode('-', $width);
        $this->unsetWidths($parts[0]);
      }
      $this->cssClasses()->add($width);
    }
    return $this;
  }

  /**
   * Returns the column width associated with the given screen size
   * 
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return int|boolean the width of the column (1-12) or false for inheritance 
   *         from smaller screens
   */
  public function getWidth(string $screenSize): string {
    $widths = $this->cssClasses()->parsePattern('/^((small|medium|large|xlarge|xxlarge)-([1-9]|(1[0-2])|auto)|auto)+$/');
    print_r($widths);
    if ($this->cssClasses()->contains("auto", "$screenSize-auto")) {
      return 'auto';
    }
    $parseWidth = function($screenName) {
      $result = false;
      for ($i = 1; $i <= $this->getMaxSize(); $i++) {
        if ($this->cssClasses()->contains("$screenName-$i")) {
          $result = $i;
          break;
        }
      }
      return $result;
    };
    $width = $parseWidth($screenSize);
    $prev = Screen::getPreviousSize($screenSize);
    while ($width === false && $prev !== false) {
      $w = $parseWidth($prev);
      $prev = Screen::getPreviousSize($prev);
      if ($w !== false) {
        $width = $w;
      }
    }
    return $width;
  }

  /**
   * Unsets the column width associated with the given screen size to be inherited from smaller screens
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetWidths(string $screenSize = null) {
    if ($screenSize === null) {
      $screenSize = '(small|medium|large|xlarge|xxlarge)';
    }
    $this->cssClasses()->removePattern("/^($screenSize-([1-9]|(1[0-2])|auto))+$/");
    return $this;
  }

  /**
   * Offsets the column component to right on the associated screen sizes
   * 
   * Moves Column block up to 11 columns to the right.
   *
   * @param  string|string[] $offsets the column offsets classes
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function setOffsets(... $offsets) {
    $offsets = Arrays::flatten($offsets);
    $filtered = preg_grep('/^(small|medium|large|xlarge|xxlarge)-offset-([1-9]|(1[0-2]))+$/', $offsets);
    foreach ($filtered as $offset) {
      $parts = explode('-', $offset);
      $this->unsetOffset($parts[0]);
      $this->cssClasses()->add($offset);
    }
    return $this;
  }

  /**
   * 
   * @return $this for a fluent interface
   */
  public function unsetOffsets() {
    foreach (Screen::sizes() as $screenSize) {
      $this->unsetOffset($screenSize);
    }
    return $this;
  }

  /**
   * Returns the column offset for the target screen
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen type
   * @return int the width of the column (0-11)
   */
  public function getOffset(string $screenSize): int {
    $parseOffset = function($screen) {
      $result = 0;
      for ($i = 0; $i <= $this->getMaxSize() - 1; $i++) {
        if ($this->cssClasses()->contains("$screen-offset-$i")) {
          $result = $i;
        }
      }
      return $result;
    };
    $offset = 0;
    foreach (Screen::sizes() as $screenName) {
      $offset = $parseOffset($screenName);
      if ($screenName == $screenSize) {
        break;
      }
    }
    return $offset;
  }

  /**
   * Unsets the grid offset for the given screen size
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetOffset(string $screenSize) {
    for ($i = 1; $i < $this->getMaxSize(); $i++) {
      $classes[] = "$screenSize-offset-$i";
    }
    $this->cssClasses()->remove($classes);
    return $this;
  }

  public function setOrders(...$orders) {
    $orders = Arrays::flatten($orders);
    $f = function ($value) {
      return Strings::match($value, '/^(small|medium|large|xlarge|xxlarge)-order-([1-9]|(1[0-2]))+$/') === 1;
    };
    $filtered = array_filter($orders, $f);
    foreach ($filtered as $order) {
      $parts = explode('-', $order);
      $this->unsetOrder($parts[0]);
      $this->cssClasses()->add($order);
    }
    return $this;
  }

  /**
   * Unsets the grid offset for the given screen size
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetOrder(string $screenSize) {
    for ($i = 1; $i < $this->getMaxSize(); $i++) {
      $classes[] = "$screenSize-push-$i";
    }
    $this->cssClasses()->remove($classes);
    return $this;
  }

  /**
   * Unsets the grid offset for the given screen size
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetOrders() {
    foreach (Screen::sizes() as $screenSize) {
      $this->unsetOrder($screenSize);
    }
    return $this;
  }

  /**
   * Returns the amount of the space the column uses from the row
   * 
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return int the amount of the space the column uses from the row
   */
  public function countUsedSpace(string $screenSize) {
    return $this->getWidth($screenSize) + $this->getOffset($screenSize);
  }

}
