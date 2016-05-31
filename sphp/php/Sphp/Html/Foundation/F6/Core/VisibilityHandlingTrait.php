<?php

/**
 * VisibilityHandlingTrait.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\F6\Core;


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

  use \Sphp\Html\ContentTrait;

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
      Screen::TOUCH => "touch",
      Screen::SCREENREADER => "sr"
  ];

  /**
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
   * @var type 
   */

  /**
   * 
   * @return string[]
   */
  public static function getScreenTypeMap() {
    return self::$sreenMap;
  }

  /**
   * Clears all Foundation based visibility CSS classes
   * 
   * @return self for PHP Method Chaining
   */
  public function showForAllScreenSizes() {
    $cssClasses = [];
    foreach (Screen::parseScreens(Screen::ALL_SIZES) as $screen) {
      $cssClasses[] = "show-for-$screen-only";
      $cssClasses[] = "show-for-$screen-up";
      $cssClasses[] = "hide-for-$screen-only";
      $cssClasses[] = "hide-for-$screen-up";
    }
    $this->cssClasses()->remove($cssClasses);
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
   * @param  int|string $screenType the targeted screensize flags as a bitmask
   * @return self for PHP Method Chaining
   * @throws \InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function hideOnlyFrom($screenType) {
    if ($screenType == "sr" || $screenType === Screen::SCREENREADER) {
      $this->attrs()->set("aria-hidden", "true");
    } else if (array_key_exists($screenType, self::$sreenMap)) {
      $screenName = self::$sreenMap[$screenType];
    } else if (in_array($screenType, self::$sreenMap)) {
      $screenName = $screenType;
    } else {
      throw new \InvalidArgumentException("Screen type was not recognized");
    }
    $this->clearVisibilitySettings();

    $this->cssClasses()->add("hide-for-$screenType");
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
   * @return self for PHP Method Chaining
   * @throws \InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function showOnlyFor($screenType) {
    if (array_key_exists($screenType, self::$sreenMap)) {
      $screenName = self::$sreenMap[$screenType];
    } else if (in_array($screenType, self::$sreenMap)) {
      $screenName = $screenType;
    } else {
      throw new \InvalidArgumentException("Screen type was not recognized");
    }
    $this->clearVisibilitySettings();
    $this->cssClasses()->add("show-for-$screenName");
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
    $this->cssClasses()->remove($classes);
    return $this;
  }

  /**
   * Sets/unsets the component visible only for landscape orientation
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return self for PHP Method Chaining
   */
  public function hideForPortrait($hide = true) {
    if ($hide) {
      $this->addCssClass("show-for-landscape");
    } else {
      $this->removeCssClass("show-for-landscape");
    }
    return $this;
  }

  /**
   * Sets/resets the component visible only for portrait orientation
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return self for PHP Method Chaining
   */
  public function hideForLandscape($hide = true) {
    if ($hide) {
      $this->addCssClass("show-for-portrait");
    } else {
      $this->removeCssClass("show-for-portrait");
    }
    return $this;
  }

  /**
   * Hide/shows the component for touch screen devices (as determined by 
   * {@link http://modernizr.com/ modernizr})
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return self for PHP Method Chaining
   */
  public function hideForTouchScreenDevices($hide = true) {
    if ($hide) {
      $this->removeCssClass("show-for-touch")
              ->addCssClass("hide-for-touch");
    } else {
      $this->removeCssClass("hide-for-touch");
    }
    return $this;
  }

  /**
   * Hide/shows the component for non touch screen devices (as determined by 
   * {@link http://modernizr.com/ modernizr})
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return self for PHP Method Chaining
   */
  public function hideForNonTouchScreenDevices($hide = true) {
    if ($hide) {
      $this->addCssClass("show-for-touch");
    } else {
      $this->removeCssClass("show-for-touch");
    }
    return $this;
  }

}
