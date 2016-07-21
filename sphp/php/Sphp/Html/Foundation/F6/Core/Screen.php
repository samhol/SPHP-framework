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
   * Screen Readers
   */
  const SCREENREADER = 0b100000000;

  /**
   * All Screen types and sizes
   */
  const ALL_TYPES = 0b111111111;

  /**
   * 
   * @return string[]
   */
  public static function getScreenSize() {
    return ["small", "medium", "large", "xlarge", "xxlarge"];
  }

  /**
   * Checks whether the given screen size exists
   * 
   * @param  string $size screen size name
   * @return boolean true if the given size exists
   */
  public static function sizeExists($size) {
    return in_array($size, static::getScreenSize());
  }

  
  /**
   * 
   * @param  string $currentSize
   * @return string|boolean
   */
  public static function getNextSize($currentSize) {
    $next = false;
    $sizes = static::getScreenSize();
    $key = array_search($currentSize, $sizes);
    if ($key !== false && $key < count($sizes)- 1) {
      $next = $sizes[$key + 1];
    } 
    return $next;
  }
  
  /**
   * 
   * @param  string $size
   * @return string
   * @throws \Exception
   */
  public static function getPrevious($size) {
    $sizes = static::getScreenSize();
    $key = array_search($size, $sizes);
    if ($key === false || $key >= count($sizes)) {
      throw new \Exception();
    } else {
      
    }
    return $sizes[$key + 1];
  }
  /**
   * 
   * @return string[]
   */
  public static function getScreenTypeNames() {
    return [
        static::PORTRAIT => "portrait",
        static::LANDSCAPE => "landscape",
        static::SCREENREADER => "sr"];
  }

  /**
   * 
   * @return string[]
   */
  public static function getAll() {
    return [
        static::SMALL => "small",
        static::MEDIUM => "medium",
        static::LARGE => "large",
        static::X_LARGE => "xlarge",
        static::XX_LARGE_UP => "xxlarge",
        static::PORTRAIT => "portrait",
        static::LANDSCAPE => "landscape",
        static::SCREENREADER => "sr"
    ];
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
    if ($types->contains(Screen::SCREENREADER)) {
      $screenNames[Screen::SCREENREADER] = "sr";
    }
    return $screenNames;
  }

}
