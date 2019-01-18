<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation;

use Sphp\Html\Span;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\Foundation\Sites\Core\ScreenSizes;

/**
 * Implements a factory for some Foundation components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class Foundation {

  /**
   * @var ScreenSizes 
   */
  private static $screens = [];

  /**
   * 
   * @param  string $text
   * @return Span
   */
  public static function screenReaderLabel(string $text = null): Span {
    $label = new Span($text);
    $label->cssClasses()->protectValue('show-for-sr');
    return $label;
  }

  /**
   * 
   * @param  string $name
   * @return ScreenSizes
   * @throws InvalidArgumentException
   */
  public static function screen(string $name = 'default'): ScreenSizes {
    if ($name === 'default' && !array_key_exists($name, static::$screens)) {
      return static::insertScreen($name, new ScreenSizes());
    }
    if (!array_key_exists($name, static::$screens)) {
      throw new InvalidArgumentException("Screensize obect '$name' type does not exisxt");
    }
    return static::$screens[$name];
  }

  /**
   * 
   * @param  string $name
   * @param  array $sizes
   * @return ScreenSizes
   */
  public static function insertScreen(string $name, $sizes): ScreenSizes {
    if (!$sizes instanceof ScreenSizes) {
      if (!is_array($sizes)) {
        throw new InvalidArgumentException("Sizes collection is of incorrect type obect");
      }
      $sizes = new ScreenSizes($sizes);
    }
    static::$screens[$name] = $sizes;
    return $sizes;
  }

}
