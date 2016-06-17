<?php

/**
 * ColumnTrait.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Core\Types\BitMask as BitMask;

/**
 * Trait implements functionality for {@link ColumnInterface} 
 * 
 * Foundation framework based component to create  multi-device layouts
 *
 * The sum of the column widths in a row should never exeed 12.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-02
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation 6 grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ColumnTrait {
  
  abstract public function cssClasses();

  /**
   * Sets the column width and optionally the offset values for small screen sizes
   * 
   * @param  int $width the column width value for small screen sizes
   * @param  int $offset optional column offset (0-11)
   * @return self for PHP Method Chaining
   */
  public function setSmall($width, $offset = 0) {
    return $this->setWidth($width, Screen::SMALL)
                    ->setGridOffset($offset, Screen::MEDIUM);
  }

  /**
   * Sets the column width and optionally the offset values for medium screen sizes
   * 
   * @param  int $width the column width value for medium screen sizes
   * @param  int $offset optional column offset (0-11)
   * @return self for PHP Method Chaining
   */
  public function setMedium($width, $offset = 0) {
    return $this->setWidth($width, Screen::MEDIUM)
                    ->setGridOffset($offset, Screen::MEDIUM);
  }

  /**
   * Sets the column width and optionally the offset values for large screen sizes
   * 
   * @param  int $width the column width value for large screen sizes (0-12)
   * @param  int $offset optional column offset (0-11)
   * @return self for PHP Method Chaining
   */
  public function setLarge($width, $offset = 0) {
    return $this->setWidth($width, Screen::LARGE)
                    ->setGridOffset($offset, Screen::LARGE);
  }

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  int $small column width for small screens (0-12)
   * @param  int $medium column width for medium screens (0-12)
   * @param  int $large column width for large screens (0-12)
   * @return self for PHP Method Chaining
   */
  public function setWidths($small, $medium, $large) {
    $this->setWidth($small, Screen::SMALL)
            ->setWidth($medium, Screen::MEDIUM)
            ->setWidth($large, Screen::LARGE);
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
   * **Preconditions: ** 
   *
   * * The value of the $width parameter is between 0-12
   * * $targetScreen = Screen::SMALL | $targetScreen = Screen::MEDIUM | $targetScreen = Screen::LARGE
   *
   * @param  int $width the width of the column
   * @param  int|string|BitMask $targetScreen the target sreen typenames
   * @return self for PHP Method Chaining
   */
  public function setWidth($width, $targetScreen = Screen::SMALL) {
    if ($width > ColumnInterface::FULL_WIDTH) {
      $width = ColumnInterface::FULL_WIDTH;
    }
    if ($width < 1) {
      $width = ColumnInterface::INHERITED;
    }
    $this->setWidthInherited($targetScreen);
    foreach (Screen::parseScreens($targetScreen) as $screenName) {
      if ($width != ColumnInterface::INHERITED) {
        $this->addCssClass("$screenName-$width");
      }
    }
    return $this;
  }

  /**
   * Returns the column width associated with the given screen size
   * 
   * @preconditions  parameter `$screen` is either one of the constants 
   *                 {@link Screen::SMALL}, 
   *                 {@link Screen::MEDIUM},
   *                 {@link Screen::LARGE} or one of the strings 
   *                 `"small"`, `"medium"`, `"large"`
   * @param  int|string $screen the target screen type
   * @return int the width of the column (0-12)
   */
  public function getWidth($screen = Screen::SMALL) {
    $parseWidth = function($screenName) {
      $result = ColumnInterface::INHERITED;
      for ($i = 1; $i <= 12; $i++) {
        if ($this->cssClasses()->contains("$screenName-$i")) {
          $result = $i;
        }
      }
      return $result;
    };
    $screenName = Screen::getScreenName($screen);
    $width = ColumnInterface::INHERITED;
    if ($screenName == "large") {
      $width = $parseWidth("large");
    }
    if ($screenName == "medium" || ($screenName == "large" && $width == ColumnInterface::INHERITED)) {
      $width = $parseWidth("medium");
    }
    if ($screenName == "small" || ($screenName != "small" && $width == ColumnInterface::INHERITED)) {
      $width = $parseWidth("small");
    }
    return $width;
  }

  /**
   * Sets the column width associated with the given screen size to be inherited from smaller screens
   *
   * @param  int|string|BitMask $targetScreens the targeted screensizes
   * @return self for PHP Method Chaining
   */
  public function setWidthInherited($targetScreens) {
    $classes = [];
    foreach (Screen::parseScreens($targetScreens) as $screenName) {
      for ($i = 1; $i <= 12; $i++) {
        $classes[] = "$screenName-$i";
      }
      $this->cssClasses()->remove($classes);
    }
    return $this;
  }

  /**
   * Offsets the column component to right on the associated screen sizes
   * 
   * Moves Column block up to 11 columns to the right.
   *
   * @param  int $offset the column offset (0-11)
   * @param  int $targetScreens the targeted screensizes as a bitmask
   * @return self for PHP Method Chaining
   */
  public function setGridOffset($offset, $targetScreens = Screen::SMALL) {
    if ($offset > ColumnInterface::FULL_WIDTH - 1) {
      $offset = ColumnInterface::FULL_WIDTH - 1;
    }
    if ($offset < 1) {
      $offset = ColumnInterface::INHERITED;
    }
    $this->inheritGridOffset($targetScreens);
    if ($offset != ColumnInterface::INHERITED) {
      $classes = [];
      foreach (Screen::parseScreens($targetScreens) as $screenName) {
        $classes[] = "$screenName-offset-$offset";
      }
      $this->addCssClass($classes);
    }
    return $this;
  }

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  int $small column offset for small screens (0-11)
   * @param  int $medium column offset for medium screens (0-11)
   * @param  int $large column offset for large screens (0-11)
   * @return self for PHP Method Chaining
   */
  public function setGridOffsets($small, $medium, $large) {
    return $this->setGridOffset($small, Screen::SMALL)
                    ->setGridOffset($medium, Screen::MEDIUM)
                    ->setGridOffset($large, Screen::LARGE);
  }

  /**
   * Returns the column width for the target screen
   *
   * @preconditions  parameter `$screen` is either one of the constants 
   *                 {@link Screen::SMALL}, 
   *                 {@link Screen::MEDIUM},
   *                 {@link Screen::LARGE} or one of the 
   *                 strings `"small"`, `"medium"`, `"large"`
   * @param  int|string $screen the target screen type
   * @param  int $screen the target screen type
   * @return int the offset setting of the column (0-11)
   */
  public function getGridOffset($screen = Screen::SMALL) {
    $parseOffset = function($screenName) {
      $result = ColumnInterface::INHERITED;
      for ($i = 0; $i <= 11; $i++) {
        if ($this->cssClasses()->contains("$screenName-offset-$i")) {
          $result = $i;
        }
      }
      return $result;
    };
    $screenName = Screen::getScreenName($screen);
    $offset = ColumnInterface::INHERITED;
    if ($screenName == "large") {
      $offset = $parseOffset("large");
    }
    if ($screenName == "medium" || ($screenName == "large" && $offset == ColumnInterface::INHERITED)) {
      $offset = $parseOffset("medium");
    }
    if ($screenName == "small" || ($screenName != "small" && $offset == ColumnInterface::INHERITED)) {
      $offset = $parseOffset("small");
    }
    return $offset;
  }

  /**
   * Unsets the grid offset of the column
   *
   * @param  int $targetScreens the targeted screensizes as a bitmask
   * @return self for PHP Method Chaining
   */
  public function inheritGridOffset($targetScreens = Screen::SMALL) {
    $classes = [];
    foreach (Screen::parseScreens($targetScreens) as $screenName) {
      for ($i = 1; $i <= 12; $i++) {
        $classes[] = "$screenName-offset-$i";
      }
    }
    $this->cssClasses()->remove($classes);
    return $this;
  }

  /**
   * Returns the amount of the space the column uses from the grid row
   * 
   * @preconditions  parameter `$screen` is either one of the constants 
   *                 {@link Screen::SMALL}, 
   *                 {@link Screen::MEDIUM},
   *                 {@link Screen::LARGE} or one of the strings 
   *                 `"small"`, `"medium"`, `"large"`
   * @param  int|string $screen
   * @return int
   */
  public function countUsedSpace($screen) {
    return $this->getWidth($screen) + $this->getGridOffset($screen);
  }

  /**
   * Centers the column to the {@link Row}
   *
   * @param  int $targetScreens the targeted screensizes as a bitmask
   * @return self for PHP Method Chaining
   */
  public function centerize($targetScreens = Screen::SMALL) {
    $del = [];
    $screens = Screen::parseScreens($targetScreens);
    foreach ($screens as $screen) {
      $del[] = "$screen-uncentered";
    }
    $this->removeCssClass($del);
    $add = [];
    foreach ($screens as $screen) {
      $add[] = "$screen-centered";
    }
    $this->addCssClass($add);
    return $this;
  }

  /**
   * Resets the centering of the column
   *
   * @param  int $targetScreens the targeted screensizes as a bitmask
   * @return self for PHP Method Chaining
   */
  public function uncenterize($targetScreens = Screen::SMALL) {
    $del = [];
    $screens = Screen::parseScreens($targetScreens);
    foreach ($screens as $screen) {
      $del[] = "$screen-centered";
    }
    $this->removeCssClass($del);
    $add = [];
    foreach ($screens as $screen) {
      $add[] = "$screen-uncentered";
    }
    $this->addCssClass($add);
    return $this;
  }

  /**
   * Removes the centering/uncentering settings
   *
   * @param  int|BitMask $screens the targeted screensizes as a bitmask
   * @return self for PHP Method Chaining
   */
  public function unsetCenterizing($screens) {
    $classes = [];
    foreach (Screen::parseScreens($screens) as $screen) {
      $classes[] = "$screen-uncentered";
      $classes[] = "$screen-centered";
    }
    $this->removeCssClass($classes);
    return $this;
  }

  /**
   * Resets (clears) all of the Grid column settings of the column
   *
   * @return self for PHP Method Chaining
   */
  public function resetGridSettings() {
    return $this->setWidthInherited(ColumnInterface::ALL_SCREENS)
                    ->inheritGridOffset(ColumnInterface::ALL_SCREENS)
                    ->unsetCenterizing(ColumnInterface::ALL_SCREENS)
                    ->setWidth(1, Screen::SMALL);
  }

}
