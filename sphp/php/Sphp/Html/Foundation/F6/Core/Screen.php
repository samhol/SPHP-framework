<?php

/**
 * Screen.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Core\Types\BitMask as BitMask;

/**
 * Class defines Foudation Screen Sizes and implements static screen size parsing functions
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-01-29
 * @link    http://foundation.zurb.com/ Foundation 6
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Screen {

  /**
   * Small screen (width: 0px - 640px)
   */
  const SMALL = 0b1;

  /**
   * Medium screen (width: 641px - 1024px)
   */
  const MEDIUM = 0b10;

  /**
   * Large screen (width: 1025px - 1440px)
   */
  const LARGE = 0b100;

  /**
   * X Large screen (width: 1441px - 1920px)
   */
  const X_LARGE = 0b1000;

  /**
   * XX Large screen (width: 1921px...)
   */
  const XX_LARGE = 0b10000;

  /**
   * All From Medium screens and up (width: 641px...)
   */
  const MEDIUM_UP = 0b11110;

  /**
   * All From Large screens and up (width: 1025px...)
   */
  const LARGE_UP = 0b11100;

  /**
   * All From X Large screens and up (width: 1441px...)
   */
  const X_LARGE_UP = 0b11000;

  /**
   * XX Large screen (width: 1921px...)
   */
  const XX_LARGE_UP = 0b10000;

  /**
   * All screen sizes 
   */
  const ALL_SIZES = 0b11111;

  /**
   * Landscape orientation
   */
  const LANDSCAPE = 0b100000;

  /**
   * Portrait orientation
   */
  const PORTRAIT = 0b1000000;

  /**
   * Touch enabled screentype
   */
  const TOUCH = 0b10000000;

  /**
   * Screen Readers
   */
  const SCREENREADER = 0b100000000;

  /**
   * All Screen types and sizes
   */
  const ALL_TYPES = 0b111111111;
  
  public static function getScreenSizeNames() {
    return ["small", "medium", "large", "xlarge", "xxlarge"];
  }

  /**
   * Returns the parsed screen types as screen type => screen name pairs
   * 
   * @param  int|BitMask|string|string[] $targetScreens the targeted screensizes
   * @return string[] the parsed screen types as screen type => screen name pairs
   */
  public static function parseScreens($targetScreens) {
    if (is_string($targetScreens)) {
      $targetScreens = explode(" ", $targetScreens);
    }
    if (is_array($targetScreens)) {
      $types = new BitMask();
      foreach ($targetScreens as $screenName) {
        $types->or_(self::getScreenType($screenName));
      }
    } else {
      $types = new BitMask($targetScreens);
    }
    $screenNames = [];
    if ($types->contains(Screen::SMALL)) {
      $screenNames[Screen::SMALL] = "small";
    }
    if ($types->contains(Screen::MEDIUM)) {
      $screenNames[Screen::MEDIUM] = "medium";
    }
    if ($types->contains(Screen::LARGE)) {
      $screenNames[Screen::LARGE] = "large";
    }
    if ($types->contains(Screen::X_LARGE)) {
      $screenNames[Screen::X_LARGE] = "x-large";
    }
    if ($types->contains(Screen::XX_LARGE)) {
      $screenNames[Screen::XX_LARGE] = "xx-large";
    }
    if ($types->contains(Screen::PORTRAIT)) {
      $screenNames[Screen::PORTRAIT] = "portrait";
    }
    if ($types->contains(Screen::LANDSCAPE)) {
      $screenNames[Screen::LANDSCAPE] = "landscape";
    }
    if ($types->contains(Screen::TOUCH)) {
      $screenNames[Screen::TOUCH] = "touch";
    }
    if ($types->contains(Screen::SCREENREADER)) {
      $screenNames[Screen::SCREENREADER] = "sr";
    }
    return $screenNames;
  }

  /**
   * Returns the name of the given screen type
   * 
   * @postconditions result is one of the values `null`, `"small"`, `"medium"` or `"large"`
   * @param  int|string $screenType the screen type to solve
   * @return string|null the name of the screen type or null if the type was 
   *         not recognized
   */
  public static function getScreenName($screenType) {
    $typename = null;
    if ($screenType == Screen::SMALL) {
      $typename = "small";
    } else if ($screenType == Screen::MEDIUM) {
      $typename = "medium";
    } else if ($screenType == Screen::LARGE) {
      $typename = "large";
    } else if (Strings::match("/^(small|medium|large|x-large|xx-large|portrait|landscape|touch|sr)$/", $screenType)) {
      $typename = $screenType;
    }
    return $typename;
  }

  /**
   * Returns the screen type associated with the given screen name
   * 
   * @postconditions result === (0
   *                 |{@link Screen::SMALL} 
   *                 |{@link Screen::MEDIUM}
   *                 |{@link Screen::LARGE})
   * @param  string|int $screenName
   * @return int the screen type associated with the given screen name
   */
  public static function getScreenType($screenName) {
    $type = 0;
    if (is_numeric($screenName) && in_array($screenName, ColumnInterface::$screens)) {
      $type = (int) $screenName;
    } else if ($screenName == "small") {
      $type = Screen::SMALL;
    } else if ($screenName == "medium") {
      $type = Screen::MEDIUM;
    } else if ($screenName == "large") {
      $type = Screen::LARGE;
    }
    return $type;
  }

}
