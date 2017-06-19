<?php

/**
 * AbstractColumnLayoutProperties.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\AbstractLayoutManager;
use Sphp\Html\Foundation\Sites\Core\Screen;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\ComponentInterface;

/**
 * Implements an abstract layout manager for responsive HTML components
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @link    http://foundation.zurb.com/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractColumnLayoutManager extends AbstractLayoutManager implements ColumnLayoutManagerInterface {

  /**
   * @var int 
   */
  private $maxSize;

  /**
   * Constructs a new instance
   * 
   * @param ComponentInterface $component
   * @param int $maxSize
   */
  public function __construct(ComponentInterface $component, $maxSize = 12) {
    parent::__construct($component);
    $this->maxSize = $maxSize;
  }

  /**
   * 
   * @return int
   */
  public function getMaxSize():int {
    return $this->maxSize;
  }

  /**
   * Sets the width and offset for given screen size
   *
   * **Important!**
   *
   * Column component is mobile-first. Code for small screens first,
   * and larger devices will inherit those styles. Customize for
   * larger screens as necessary.
   *
   * @param  mixed|mixed[] $layouts layout parameters
   * @return self for a fluent interface
   */
  public function setLayouts($layouts) {
    $this->unsetLayouts();
    foreach (is_array($layouts) ? $layouts : [$layouts] as $width) {
      $parts = explode('-', $width);
      $c = count($parts);
      if ($c === 2) {
        if ($parts[1] === 'centered') {
          $this->centerize($parts[0]);
        } else if ($parts[1] === 'uncentered') {
          $this->uncenterize($parts[0]);
        } else if (is_numeric($parts[1])) {
          $this->setWidth($parts[1], $parts[0]);
        }
      } else if ($c === 3) {
        if ($parts[1] === 'offset') {
          $this->setOffset($parts[2], $parts[0]);
        } else if ($parts[1] === 'push') {
          $this->setOrder($parts[2], $parts[0]);
        } else if ($parts[1] === 'pull') {
          $this->pull($parts[2], $parts[0]);
        }
      } 
    }
    return $this;
  }

  public function unsetLayouts() {
    $this->unsetWidths()
            ->unsetOffsets();
    return $this;
  }

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  string[] $widths column widths for different screens sizes
   * @return self for a fluent interface
   */
  public function setWidths(array $widths) {
    $this->unsetWidths();
    foreach ($widths as $width) {
      $parts = explode('-', $width);
      $this->setWidth($parts[1], $parts[0]);
    }
    return $this;
  }

  /**
   * 
   * @return self for a fluent interface
   */
  public function unsetWidths() {
    foreach (Screen::sizes() as $screenSize) {
      $this->unsetWidth($screenSize);
    }
    return $this;
  }

  /**
   * Sets the column width
   *
   * **Important!**
   *
   * Column component is mobile-first. Code for small screens first,
   * and larger devices will inherit those styles. Customize for
   * larger screens as necessary.
   *
   * @precondition The value of the `$width` parameter is between 1-12 or false 
   *               for inheritance from smaller screen sizes
   * @precondition `$screen` == `small|medium|large|xlarge|xxlarge`
   * @param  int|boolean $width the width of the column or false for inheritance
   * @param  string $screen the target screen size
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function setWidth(int $width, string $screen = 'small') {
    $this->unsetWidth($screen);
    if ($width > 0 && $width <= $this->getMaxSize()) {
      $this->cssClasses()->add("$screen-$width");
    } else {
      throw new InvalidArgumentException(sprintf('The width \'%s\' of a column is not between (1-%s)', $width, $this->getMaxSize()));
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
  public function getWidth(string $screenSize): int {
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
   * Sets the column width associated with the given screen size to be inherited from smaller screens
   *
   * @precondition `$screenSize` == `medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
   */
  public function unsetWidth(string $screenSize) {
    $classes = [];
    for ($i = 1; $i <= $this->getMaxSize(); $i++) {
      $classes[] = "$screenSize-$i";
    }
    $this->cssClasses()->remove($classes);
    return $this;
  }

  /**
   * Offsets the column component to right on the associated screen sizes
   * 
   * Moves Column block up to 11 columns to the right.
   *
   * @precondition The value of the `$offset` parameter is between 0-11 or false for inheritance
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  int|boolean $offset the column offset (0-11) or false for inheritance
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
   */
  public function setOffset(int $offset, string $screenSize = 'small') {
    $this->unsetOffset($screenSize);
    if ($offset !== false && $offset !== 0) {
      $this->cssClasses()->add("$screenSize-offset-$offset");
    }
    return $this;
  }

  /**
   * 
   * @return self for a fluent interface
   */
  public function unsetOffsets() {
    foreach (Screen::sizes() as $screenSize) {
      $this->unsetOffset($screenSize);
    }
    return $this;
  }

  /**
   * Sets the column offset values for all screen sizes
   *
   * @param  string[] $offsets column offsets for different screens sizes
   * @return self for a fluent interface
   */
  public function setOffsets(array $offsets) {
    $this->unsetoffsets();
    foreach ($offsets as $width) {
      $parts = explode('-', $width);
      $this->setWidth($parts[2], $parts[0]);
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
   * @return self for a fluent interface
   */
  public function unsetOffset(string $screenSize) {
    for ($i = 1; $i < $this->getMaxSize(); $i++) {
      $classes[] = "$screenSize-offset-$i";
    }
    $this->cssClasses()->remove($classes);
    return $this;
  }

  public function setOrder(int $push, string $screenSize = 'small') {
    $this->unsetOffset($screenSize);
    if ($push !== 0) {
      $this->cssClasses()->add("$screenSize-push-$push");
    }
    return $this;
  }

  public function pull(int $num, string $screenSize = 'small') {
    $this->unsetPull($screenSize);
    if ($num >= 0) {
      $this->cssClasses()->add("$screenSize-pull-$num");
    }
    return $this;
  }

  /**
   * Unsets the grid offset for the given screen size
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
   */
  public function unsetPull(string $screenSize) {
    for ($i = 0; $i < $this->getMaxSize(); $i++) {
      $classes[] = "$screenSize-pull-$i";
    }
    $this->cssClasses()->remove($classes);
    return $this;
  }

  /**
   * Unsets the grid offset for the given screen size
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
   */
  public function unsetPulls() {
    foreach (Screen::sizes() as $screenSize) {
      $this->unsetPull($screenSize);
    }
    return $this;
  }

  /**
   * Sets the column offset values for all screen sizes
   *
   * @param  string[] $pushs column offsets for different screens sizes
   * @return self for a fluent interface
   */
  public function setOrders(array $pushs) {
    $this->unsetOrders();
    foreach ($pushs as $push) {
      $parts = explode('-', $push);
      $this->setWidth($parts[2], $parts[0]);
    }
    return $this;
  }

  /**
   * Unsets the grid offset for the given screen size
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
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
   * @return self for a fluent interface
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

  /**
   * Centers the column to the Foundation row
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for PHP Method Chaining
   */
  public function centerize(string $screenSize) {
    $this->cssClasses()
            ->remove("$screenSize-uncentered")
            ->add("$screenSize-centered");
    return $this;
  }

  /**
   * Resets the centering of the column
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for PHP Method Chaining
   */
  public function uncenterize(string $screenSize) {
    $this->cssClasses()
            ->remove("$screenSize-centered")
            ->add("$screenSize-uncentered");
    return $this;
  }

  /**
   * Removes the centering/uncentering settings
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for PHP Method Chaining
   */
  public function unsetCenterizing(string $screenSize) {
    $classes[] = "$screenSize-uncentered";
    $classes[] = "$screenSize-centered";
    $this->cssClasses()->remove($classes);
    return $this;
  }

}
