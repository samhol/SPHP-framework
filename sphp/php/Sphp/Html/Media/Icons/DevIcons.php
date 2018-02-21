<?php

/**
 * DevIcons.php (UTF-8)
 * Copyright (c) 2018 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Icons;

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
 * @since   2018-02-19
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class DevIcons {

  /**
   * Creates a HTML object
   *
   * @param  string $name the name of the icon (function name)
   * @param  array $arguments 
   * @return Icon the corresponding component
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $arguments): Icon {
    $screenReaderText = array_shift($arguments);
    $h = preg_replace("/([A-Z])/", "-$1", $name);
    $h = strtolower($h);
    //echo "\nfoo$h\n";
    return new Icon("devicon-$h", $screenReaderText);
  }

}
