<?php

/**
 * AbstractColumnLayoutProperties.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Attributes\MultiValueAttribute;
use Sphp\Html\Foundation\Sites\Core\Screen;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Class implements functionality for {@link ColumnInterface} 
 * 
 * Foundation framework based component to create  multi-device layouts
 *
 * The sum of the column widths in a row should never exceed 12.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @link    http://foundation.zurb.com/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractColumnLayoutProperties implements ColumnLayoutPropertiesInterface {

  /**
   * @var MultiValueAttribute
   */
  private $cssClasses;

  /**
   *
   * @var int 
   */
  private $maxSize;

  /**
   * 
   * @param MultiValueAttribute $cssClasses
   * @param int $maxSize
   */
  public function __construct(MultiValueAttribute $cssClasses, $maxSize = 12) {
    $this->cssClasses = $cssClasses;
    $this->maxSize = $maxSize;
  }

  /**
   * 
   * @return int
   */
  public function getMaxSize() {
    return $this->maxSize;
  }

  /**
   * 
   * @return MultiValueAttribute
   */
  public function cssClasses() {
    return $this->cssClasses;
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
  public function setLayout(array $layout) {
    $this->unsetLayouts();
    foreach ($layout as $width) {
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
        }
      } else {
        throw new InvalidArgumentException(sprintf('Property \'%s\' cannot be regognized', $width));
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
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function setWidth($width, $screen = 'small') {
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
   * @return self for a fluent interface
   */
  public function unsetWidth($screenSize) {
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
   * @return self for a fluent interface
   */
  public function setOffset($offset, $screenSize = 'small') {
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
  public function getOffset($screenSize) {
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
   * @return self for a fluent interface
   */
  public function unsetOffset($screenSize) {
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
    return $this->getWidth($screenSize) + $this->getOffset($screenSize);
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
   * @return ColumnLayoutProperties for PHP Method Chaining
   */
  public function uncenterize($screenSize): ColumnLayoutProperties {
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

  public function __toString() {
    return "$this->cssClasses";
  }

}
