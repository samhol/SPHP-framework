<?php

/**
 * FontAwesome.php (UTF-8)
 * Copyright (c) 2018 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Icons;

use Sphp\Exceptions\BadMethodCallException;

/**
 * Implements a factory for Font Awesome icon objects
 * 
 * @method \Sphp\Html\\Media\Icons\Icon facebookSquare(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\Icon twitterSquare(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\Icon googlePlusSquare(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\Icon githubSquare(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\Icon php(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\Icon js(string $screenReaderLabel = null) creates a new icon object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @link    https://fontawesome.com/ Font Awesome
 * @filesource
 */
class FontAwesome {

  /**
   * list of Font Awesome icons and their corresponding PHP classes
   *
   * @var mixed[]
   */
  private static $tags = array(
      'facebookSquare' => ['fab', 'fa-facebook-square'],
      'facebook' => ['fab', 'fa-facebook-square'],
      'twitterSquare' => ['fab', 'fa-twitter-square'],
      'googlePlusSquare' => ['fab', 'fa-google-plus-square'],
      'githubSquare' => ['fab', 'fa-github-square'],
      'php' => ['fab', 'fa-php'],
      'js' => ['fab', 'fa-js-square'],
      'chevronCircleUp' => ['fas', 'fa-chevron-circle-up'],
  );

  /**
   * Creates a new icon object
   *
   * @param  string $name the name of the icon (function name)
   * @param  array $arguments 
   * @return Icon the corresponding component
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $arguments): Icon {
    if (!isset(static::$tags[$name])) {
      throw new BadMethodCallException("Method $name does not exist");
    }
    $classes = static::$tags[$name];
    $text = array_unshift($arguments, $name);
    return new Icon($classes, $text);
  }

}
