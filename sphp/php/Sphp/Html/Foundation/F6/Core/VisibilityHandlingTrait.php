<?php

/**
 * VisibilityHandlingTrait.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\Attributes\MultiValueAttribute as MultiValueAttribute;

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

  private static $sreenMap = [
      Screen::SMALL => "small-only",
      Screen::MEDIUM => "medium-only",
      Screen::MEDIUM_UP => "medium-up",
      Screen::LARGE => "large-only",
      Screen::LARGE_UP => "large-up",
      Screen::X_LARGE => "xlarge-only",
      Screen::X_LARGE_UP => "xlarge-up",
      Screen::XX_LARGE_UP => "xxlarge-up",
      Screen::PORTRAIT => "portrait",
      Screen::LANDSCAPE => "landscape",
      Screen::SCREENREADER => "sr"
  ];

  /**
   * Clears all Foundation based visibility CSS classes
   * 
   * @return VisibilityHandlingInterface for PHP Method Chaining
   */
  public function showForAllScreenSizes() {
    $cssClasses = [];
    foreach (Screen::getScreenSize() as $screen) {
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
   * @throws \InvalidArgumentException
   */
  public function showFromUp($screenType) {
    if (!in_array($screenType, Screen::getScreenSize())) {
      throw new \InvalidArgumentException("Screen type '$screenType' was not recognized");
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
   * @throws \InvalidArgumentException
   */
  public function hideDownTo($screenSize) {
    $this->showForAllScreenSizes();
    if (!Screen::sizeExists($screenSize)) {
      throw new \InvalidArgumentException("Screen type '$screenSize' was not recognized");
    }
    if ($screenSize == "small") {
      $this->cssClasses()
              ->add("hide");
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
   * Hidden the component for the given screen sizes
   * 
   * Valid flags for <var>$screenSizes</var> parameter (PHP constants):
   * 
   * @precondition
   * 
   * * {@link Screen::SMALL} or `"small-only"`: screen widths 0px - 640px
   * * {@link Screen::MEDIUM} or `"medium-only"`: screen widths 641px - 1024px
   * * {@link Screen::MEDIUM_UP} or `"medium-up"`: all screen widths from 641px...
   * * {@link Screen::LARGE} or `"large-only"`: screen widths 1025px - 1440px)
   * * {@link Screen::LARGE_UP} or `"large-up"`: all screen widths from 1025px...
   * * {@link Screen::X_LARGE} or `"x-large-only"`: screen widths 1441px - 1920px
   * * {@link Screen::X_LARGE_UP} or `"x-large-up"`: all screen widths from 1441px...
   * * {@link Screen::PORTRAIT} or `"portrait"`: portrait oriented screens
   * * {@link Screen::LANDSCAPE} or `"landscape"`: landscape oriented screens
   * * {@link Screen::TOUCH} or `"touch"`: device supports touch (as determined by Modernizr).
   * * {@link Screen::SCREENREADER} or `"sr"`:  Screen Readers
   * 
   * @param  string $screenType the targeted screensize flags as a bitmask
   * @return VisibilityHandlingInterface for PHP Method Chaining
   * @throws \InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function hideOnlyFromSize($screenType) {
    $this->showForAllScreenSizes();
    if ($screenType == "sr") {
      $this->attrs()->set("aria-hidden", "true");
    } else if (Screen::sizeExists($screenType)) {
      $this->cssClasses()
              ->add("hide-for-$screenType-only");
    } else {
      throw new \InvalidArgumentException("Screen type '$screenType' was not recognized");
    }
    return $this;
  }

  /**
   * Sets the component visible for the given screen sizes
   * 
   * Valid flags for <var>$screenSizes</var> parameter (PHP constants):
   * 
   * * {@link Screen::SMALL} for small screen (width: 0px - 640px)
   * * {@link Screen::MEDIUM} for medium screen (width: 641px - 1024px)
   * * {@link Screen::MEDIUM_UP} for all screens from medium up (width: 641px...)
   * * {@link Screen::LARGE} for large screen (width: 1025px - 1440px)
   * * {@link Screen::LARGE_UP} for all screens from large up (width: 1025px...)
   * * {@link Screen::X_LARGE} for X-large screen (width: 1441px - 1920px)
   * * {@link Screen::X_LARGE_UP} for all screens from x-large up (width: 1441px...)
   * * {@link Screen::XX_LARGE} for XX-large screen (width: 1921px...)
   * * {@link Screen::ALL_SIZES} for all screens
   * 
   * @param  int|string $screenType the targeted screen type
   * @return VisibilityHandlingInterface for PHP Method Chaining
   * @throws \InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function showOnlyFor($screenType) {
    if (!in_array($screenType, Screen::getAll())) {
      throw new \InvalidArgumentException("Screen type '$screenType' was not recognized");
    }
    $this->showForAllScreenSizes();
    $this->cssClasses()
            ->add("show-for-$screenType-only");
    return $this;
  }

  /**
   * 
   * 
   * @return VisibilityHandlingInterface for PHP Method Chaining
   */
  public function showForAllSizes() {
    $classes = [];
    foreach (Screen::getScreenSize() as $sreenName) {
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
            ->remove("show-for-portrait");
    if ($hide) {
      $this->cssClasses()
              ->add("show-for-landscape");
    } else {
      $this->cssClasses()
              ->remove("show-for-landscape");
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
            ->remove("show-for-landscape");
    if ($hide) {
      $this->cssClasses()
              ->add("show-for-portrait");
    } else {
      $this->cssClasses()
              ->remove("show-for-portrait");
    }
    return $this;
  }

}
