<?php

/**
 * VisibilityHandlingTrait.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Attributes\MultiValueAttribute;
use InvalidArgumentException;

/**
 * Trait implements {@link Visibility} interface functionality
 * 
 * {@link Visibility} defines Foudation styled CSS border radius settings
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-01-29
 * @link    http://foundation.zurb.com/ Foundation 6
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait VisibilityHandlingTrait {

  /**
   * Returns the class attribute object
   * 
   * @return MultiValueAttribute the class attribute object
   */
  abstract public function cssClasses();

  /**
   * Clears all Foundation based visibility CSS classes
   * 
   * @return VisibilityHandlingInterface for PHP Method Chaining
   */
  public function showForAllScreenSizes() {
    $cssClasses = [];
    foreach (Screen::sizes() as $screen) {
      $cssClasses[] = "show-for-$screen-only";
      $cssClasses[] = "show-for-$screen";
      $cssClasses[] = "hide-for-$screen-only";
      $cssClasses[] = "hide-for-$screen";
    }
    $this->cssClasses()
            ->remove($cssClasses);
    return $this;
  }

  /**
   * 
   * @param  string $screenType
   * @return VisibilityHandlingInterface for PHP Method Chaining
   * @throws InvalidArgumentException
   */
  public function showFromUp($screenType) {
    if (!in_array($screenType, Screen::sizes())) {
      throw new InvalidArgumentException("Screen type '$screenType' was not recognized");
    }
    $this->cssClasses()
            ->add("show-for-$screenType")
            ->remove("hide-for-$screenType");
    return $this;
  }

  /**
   * 
   * @param string $screenSize
   * @return VisibilityHandlingInterface for PHP Method Chaining
   * @throws InvalidArgumentException
   */
  public function hideDownTo($screenSize) {
    $this->showForAllScreenSizes();
    if (!Screen::sizeExists($screenSize)) {
      throw new InvalidArgumentException("Screen type '$screenSize' was not recognized");
    }
    if ($screenSize == 'small') {
      $this->cssClasses()
              ->add('hide');
    }
    $this->cssClasses()
            ->add("hide-for-$screenSize");
    return $this;
  }

  /**
   * **Important!**
   * 
   * Overrides all previous sreen size related visibility settings
   * 
   * @param  string $smaller
   * @param  string $larger
   * @return VisibilityHandlingInterface for PHP Method Chaining
   */
  public function showBetweenSizes($smaller, $larger) {
    $this->showForAllScreenSizes();
    $upper = Screen::getNextSize($larger);
    if ($upper !== false) {
      $this->cssClasses()
              ->add(["hide-for-$upper"]);
    }
    if ($smaller != "small") {
      $this->cssClasses()
              ->add(["show-for-$smaller", "hide-for-$upper"]);
    }
    return $this;
  }

  /**
   * Hides the component for the given screen sizes only
   * 
   * Valid flags for `$size` parameter:
   * 
   * * `"small"`: screen widths 0px - 640px
   * * `"medium"`: screen widths 641px - 1024px
   * * `"large"`: screen widths 1025px - 1440px)
   * * `"x-large"`: screen widths 1441px - 1920px
   * * `"xx-large"`: all screen widths from 1921px...
   * 
   * @precondition `$screen` == `small|medium|large|xlarge|xxlarge`
   * @param  string $size the targeted screensize flags as a bitmask
   * @return VisibilityHandlingInterface for PHP Method Chaining
   * @throws InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function hideOnlyFromSize($size) {
    $this->showForAllScreenSizes();
    if (Screen::sizeExists($size)) {
      $this->cssClasses()
              ->add("hide-for-$size-only");
    } else {
      throw new InvalidArgumentException("Screen size '$size' was not recognized");
    }
    return $this;
  }

  /**
   * Shows component visible for the given screen sizes only
   * 
   * Valid flags for `$size` parameter:
   * 
   * * `"small"`: screen widths 0px - 640px
   * * `"medium"`: screen widths 641px - 1024px
   * * `"large"`: screen widths 1025px - 1440px)
   * * `"x-large"`: screen widths 1441px - 1920px
   * * `"xx-large"`: all screen widths from 1921px...
   * 
   * @precondition `$size` == `small|medium|large|xlarge|xxlarge`
   * @param  int|string $screenType the targeted screen type
   * @return VisibilityHandlingInterface for PHP Method Chaining
   * @throws InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function showOnlyFor($screenType) {
    $onlyFor = function($size) {
      if (!Screen::sizeExists($size)) {
        throw new InvalidArgumentException("Screen type '$size' was not recognized");
      }
      $this->cssClasses()
              ->add("show-for-$size-only");
    };
    if (func_num_args() === 1) {
      $onlyFor($screenType);
    } else {
      foreach (func_get_args() as $screen) {
        $onlyFor($screen);
      }
    }
    return $this;
  }

  /**
   * Sets the componentvisible for all screen sizes
   * 
   * @return VisibilityHandlingInterface for PHP Method Chaining
   */
  public function showForAllSizes() {
    $classes = [];
    foreach (Screen::sizes() as $sreenName) {
      $classes[] = "hide-for-$sreenName";
      $classes[] = "hide-for-$sreenName-only";
      $classes[] = "show-for-$sreenName";
      $classes[] = "show-for-$sreenName-only";
    }
    $this->cssClasses()
            ->remove($classes);
    return $this;
  }

  /**
   * 
   * 
   * @return self for PHP Method Chaining
   */
  public function clearVisibilitySettings() {
    $classes = [];
    foreach (self::$sreenMap as $sreenName) {
      $classes[] = "hidden-for-$sreenName";
      $classes[] = "show-for-$sreenName";
    }
    $this->cssClasses()
            ->remove($classes);
    return $this;
  }

  /**
   * Sets/unsets the component visible only for landscape orientation
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return VisibilityHandlingInterface for PHP Method Chaining
   */
  public function hideForPortrait($hide = true) {
    $this->cssClasses()
            ->remove('show-for-portrait');
    if ($hide) {
      $this->cssClasses()
              ->add('show-for-landscape');
    } else {
      $this->cssClasses()
              ->remove('show-for-landscape');
    }
    return $this;
  }

  /**
   * Sets/resets the component visible only for portrait orientation
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return VisibilityHandlingInterface for PHP Method Chaining
   */
  public function hideForLandscape($hide = true) {
    $this->cssClasses()
            ->remove('show-for-landscape');
    if ($hide) {
      $this->cssClasses()
              ->add('show-for-portrait');
    } else {
      $this->cssClasses()
              ->remove('show-for-portrait');
    }
    return $this;
  }

}
