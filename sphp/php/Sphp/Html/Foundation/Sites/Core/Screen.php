<?php

/**
 * Screen.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Core;

/**
 * Defines Screen Sizes and types and implements static screen size parsing functions
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class Screen {

  /**
   * Foundation screen size names
   *
   * @var string[]
   */
  private static $sizes = ['small', 'medium', 'large', 'xlarge', 'xxlarge'];

  /**
   * Foundation screen type names
   *
   * @var string[]
   */
  private static $otherTypes = ['portrait', 'landscape', 'sr'];

  /**
   * Returns all supported screen type names
   * 
   * @return string[] all supported screen type names
   */
  public static function allTypes(): array {
    return array_merge(static::$sizes, static::$otherTypes);
  }

  /**
   * Checks whether the given screen type exists
   * 
   * @param  string $size screen type name
   * @return boolean true if the given size exists
   */
  public static function typeExists(string $size): bool {
    return in_array($size, static::allTypes());
  }

  /**
   * Returns all screen size names
   * 
   * @return string[] all screen size names
   */
  public static function sizes(): array {
    return static::$sizes;
  }

  /**
   * Checks whether the given screen size exists
   * 
   * @param  string $size screen size name
   * @return boolean true if the given size exists
   */
  public static function sizeExists(string $size): bool {
    return in_array($size, static::sizes());
  }

  /**
   * Returns next larger screen size or false if none present
   * 
   * @param  string $currentSize
   * @return string|boolean next larger screen size or false if none present
   */
  public static function getNextSize(string $currentSize) {
    $next = false;
    $sizes = static::sizes();
    $key = array_search($currentSize, $sizes);
    if ($key !== false && $key < count($sizes) - 1) {
      $next = $sizes[$key + 1];
    }
    return $next;
  }

  /**
   * Returns previous smaller screen size or false if none present
   * 
   * @param  string $currentSize
   * @return string|boolean previous smaller screen size or false if none present
   */
  public static function getPreviousSize(string $currentSize) {
    $previous = false;
    $sizes = static::sizes();
    $key = array_search($currentSize, $sizes);
    if ($key !== false && $key > 0) {
      $previous = $sizes[$key - 1];
    }
    return $previous;
  }

  /**
   * 
   * @return string[]
   */
  public static function orientation(): array {
    return ['portrait', 'landscape'];
  }

}
