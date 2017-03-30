<?php

/**
 * ColumnTrait.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Attributes\MultiValueAttribute;
use Sphp\Html\Foundation\Sites\Core\Screen;

/**
 * Trait implements functionality for {@link ColumnInterface} 
 * 
 * Foundation framework based component to create  multi-device layouts
 *
 * The sum of the column widths in a row should never exeed 12.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @link    http://foundation.zurb.com/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ColumnTrait {

  /**
   * Returns the class attribute object
   * 
   * @return MultiValueAttribute the class attribute object
   */
  abstract public function cssClasses();

  /**
   * Sets the width and offset for given screen size
   *
   * **Important!**
   *
   * Column component is mobile-first. Code for small screens first,
   * and larger devices will inherit those styles. Customize for
   * larger screens as necessary.
   *
   * @precondition The value of the `$width` parameter is between 1-12 or false for inheritance
   * @precondition The value of the `$offset` parameter is between 0-11 or false for inheritance
   * @precondition The sum `$width + $offset` < 13
   * @precondition `$screen` == `small|medium|large|xlarge|xxlarge`
   *
   * @param  int|boolean $width the width of the column or false for inheritance
   * @param  int|boolean $offset the offset of the column or false for inheritance
   * @param  string $screen the target screen size
   * @return ColumnInterface for PHP Method Chaining
   */
  public function setLayout($width, $offset = false, $screen = 'small') {
    $this->setWidth($width, $screen);
    $this->setGridOffset($offset, $screen);
    return $this;
  }

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  int $s column width for small screens (1-12)
   * @param  int|boolean $m column width for medium screens (1-12) or false for inheritance
   * @param  int|boolean $l column width for large screens (1-12) or false for inheritance
   * @param  int|boolean $xl column width for x-large screens (1-12) or false for inheritance
   * @param  int|boolean $xxl column width for xx-large screen)s (1-12) or false for inheritance
   * @return ColumnInterface for PHP Method Chaining
   */
  public function setWidths($s, $m = false, $l = false, $xl = false, $xxl = false) {
    $this->setWidth($s, 'small')
            ->setWidth($m, 'medium')
            ->setWidth($l, 'large')
            ->setWidth($xl, 'xlarge')
            ->setWidth($xxl, 'xxlarge');
    return $this;
  }

  /**
   * Sets column width for the component
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
   * @return ColumnInterface for PHP Method Chaining
   */
  public function setWidth($width, $screen = "small") {
    $this->setWidthInherited($screen);
    if ($width !== false) {
      $this->cssClasses()->add("$screen-$width");
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
  public function getWidth($screenSize) {
    $parseWidth = function($screenName) {
      $result = false;
      for ($i = 1; $i <= 12; $i++) {
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
   * @return ColumnInterface for PHP Method Chaining
   */
  public function setWidthInherited($screenSize) {
    $classes = [];
    for ($i = 1; $i <= 12; $i++) {
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
   * @return ColumnInterface for PHP Method Chaining
   */
  public function setGridOffset($offset, $screenSize = 'small') {
    $this->inheritGridOffset($screenSize);
    if ($offset !== false && $offset !== 0) {
      $this->cssClasses()->add("$screenSize-offset-$offset");
    }
    return $this;
  }

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  int|boolean $s column offset for small screens (0-11) or false for none
   * @param  int|boolean $m column offset for medium screens (0-11) or false for inheritance
   * @param  int|boolean $l column offset for large screens (0-11) or false for inheritance
   * @param  int|boolean $xl column offset for x-large screens (0-11) or false for inheritance
   * @param  int|boolean $xxl column offset for xx-large screen)s (0-11) or false for inheritance
   * @return ColumnInterface for PHP Method Chaining
   */
  public function setGridOffsets($s, $m = false, $l = false, $xl = false, $xxl = false) {
    $this->setGridOffset($s, 'small')
            ->setGridOffset($m, 'medium')
            ->setGridOffset($l, 'large')
            ->setGridOffset($xl, 'xlarge')
            ->setGridOffset($xxl, 'xxlarge');
    return $this;
  }

  /**
   * Returns the column offset for the target screen
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen type
   * @return int the width of the column (0-11)
   */
  public function getGridOffset($screenSize) {
    $parseOffset = function($screen) {
      $result = 0;
      for ($i = 0; $i <= 11; $i++) {
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
   * @return ColumnInterface for PHP Method Chaining
   */
  public function inheritGridOffset($screenSize) {
    for ($i = 1; $i <= 12; $i++) {
      $classes[] = "$screenSize-offset-$i";
    }
    $this->cssClasses()->remove($classes);
    return $this;
  }

  /**
   * Returns the amount of the space the column uses from the row
   * 
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return int the amount of the space the column uses from the row
   */
  public function countUsedSpace($screenSize) {
    return $this->getWidth($screenSize) + $this->getGridOffset($screenSize);
  }

  /**
   * Centers the column to the Foundation row
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return ColumnInterface for PHP Method Chaining
   */
  public function centerize($screenSize) {
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
   * @return ColumnInterface for PHP Method Chaining
   */
  public function uncenterize($screenSize) {
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
   * @return ColumnInterface for PHP Method Chaining
   */
  public function unsetCenterizing($screenSize) {
    $classes[] = "$screenSize-uncentered";
    $classes[] = "$screenSize-centered";
    $this->cssClasses()->remove($classes);
    return $this;
  }

}
