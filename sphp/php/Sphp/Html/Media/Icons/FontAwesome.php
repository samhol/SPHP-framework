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
 * @method \Sphp\Html\\Media\Icons\FaIcon facebook(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\FaIcon twitter(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\FaIcon googlePlus(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\FaIcon github(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\FaIcon php(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\FaIcon js(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\FaIcon tumblr(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\FaIcon stumbleupon(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\FaIcon pinterest(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\FaIcon blogger(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\FaIcon cc(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\FaIcon python(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\FaIcon phone(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\FaIcon envelope(string $screenReaderLabel = null) creates a new icon object
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
      'facebook' => ['fab', 'fa-facebook-square'],
      'twitter' => ['fab', 'fa-twitter-square'],
      'googlePlus' => ['fab', 'fa-google-plus-square'],
      'github' => ['fab', 'fa-github-square'],
      'php' => ['fab', 'fa-php'],
      'js' => ['fab', 'fa-js-square'],
      'chevronCircleUp' => ['fas', 'fa-chevron-circle-up'],
      'tumblr' => 'fab fa-tumblr-square',
      'stumbleupon' => 'fab fa-stumbleupon-circle',
      'pinterest' => 'fab fa-pinterest-square',
      'blogger' => 'fab fa-blogger',
      'cc' => 'fab fa-creative-commons',
      'python' => 'fab fa-python',
      'phone' => 'fas fa-phone',
      'envelope' => 'far fa-envelope',
  );

  /**
   * Creates a new icon object
   *
   * @param  string $name the name of the icon (function name)
   * @param  array $arguments 
   * @return FaIcon the corresponding component
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $arguments): FaIcon {
    if (!isset(static::$tags[$name])) {
      throw new BadMethodCallException("Method $name does not exist");
    }
    $classes = static::$tags[$name];
    $screenReaderText = array_shift($arguments);
    return new FaIcon($classes, $screenReaderText);
  }

}
