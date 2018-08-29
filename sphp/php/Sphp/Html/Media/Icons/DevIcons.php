<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;

/**
 * Implements a factory for Font Awesome icon objects
 * 
 * @method \Sphp\Html\Media\Icons\Icon facebookSquare(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\Icon twitterSquare(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\Icon googlePlusSquare(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\Icon githubSquare(string $screenReaderLabel = null) creates a new icon object
 * 
 * @method \Sphp\Html\Media\Icons\Icon js(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\Icon jquery(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\Icon php(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\Icon zend(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\Icon symfony(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\Icon doctrine(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\Icon travis(string $screenReaderLabel = null) creates a new icon object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DevIcons {

  private static $assosiations = [
      'zend' => 'devicon-zend-plain',
      'zendLogo' => 'devicon-zend-plain',
      'symfony' => 'devicon-symfony-original',
      'symfonyLogo' => 'devicon-symfony-original',
      'doctrine' => 'devicon-doctrine-plain',
      'doctrineLogo' => 'devicon-doctrine-plain',
      'mysql' => 'devicon-mysql-plain',
      'mysqlLogo' => 'devicon-mysql-plain',
      'postgresql' => 'devicon-postgresql-plain',
      'postgresqlLogo' => 'devicon-postgresql-plain',
      'foundation' => 'devicon-foundation-plain',
      'foundationLogo' => 'devicon-foundation-plain',
      'jquery' => 'devicon-jquery-plain',
      'jqueryLogo' => 'devicon-jquery-plain',
      'travis' => 'devicon-travis-plain',
      'mocha' => 'devicon-mocha-plain',
      'photoshop' => 'devicon-photoshop-plain',
      'illustrator' => 'devicon-illustrator-plain',
      'java' => 'devicon-java-plain-wordmark',
      'python' => 'devicon-python-plain',
      'c++' => 'devicon-cplusplus-line',
      'c#' => 'devicon-csharp-line',
      'c' => 'devicon-c-plain',
  ];

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
    if (array_key_exists($name, static::$assosiations)) {
      return new Icon(static::$assosiations[$name], $screenReaderText);
    } else {
      $h = preg_replace("/([A-Z])/", '-$1', $name);
      $h = strtolower($h);
      //echo "\nfoo$h\n";
      return new Icon("devicon-$h", $screenReaderText);
    }
  }

}
