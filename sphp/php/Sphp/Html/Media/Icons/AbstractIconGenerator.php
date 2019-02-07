<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;

use Sphp\Exceptions\BadMethodCallException;

/**
 * Implements a factory for Font Awesome icon objects
 * 
 * @method \Sphp\Html\Media\Icons\FaIcon html5(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon sass(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon css3(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon php(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon js(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon python(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon nodejs(string $screenReaderLabel = null) creates a new icon object
 * 
 * @method \Sphp\Html\Media\Icons\FaIcon facebook(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon twitter(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon googlePlus(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon github(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon tumblr(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon stumbleupon(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon pinterest(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon blogger(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon apple(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon cc(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon android(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon apper(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon cpanel(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon angular(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon dribbble(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon dropbox(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon digg(string $screenReaderLabel = null) creates a new icon object
 *
 * @method \Sphp\Html\Media\Icons\FaIcon phone(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon envelope(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon search(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon tags(string $screenReaderLabel = null) creates a new icon object
 * 
 * @method \Sphp\Html\Media\Icons\FaIcon exclamation(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon ban(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon stethoscope(string $screenReaderLabel = null) creates a new icon object
 * 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://fontawesome.com/ Font Awesome
 * @filesource
 */
abstract class AbstractIconGenerator {

  /**
   * list of Font Awesome icons and their corresponding PHP classes
   *
   * @var mixed[]
   */
  private static $tags = array(
      'archive' => 'far fa-file-archive',
      'pdf' => 'far fa-file-pdf',
      'video' => 'far fa-file-video',
      'audio' => 'far fa-file-audio',
      'powerpoint' => 'far fa-file-powerpoint',
      'word' => 'far fa-file-word',
      'excel' => 'far fa-file-excel',
      'css' => 'fab fa-css3-alt',
      'image' => 'far fa-file-image',
      'text' => 'far fa-file-alt',
      'html5' => 'fab fa-html5',
      'php' => 'fab fa-php',
      'js' => 'fab fa-js-square',
      'font' => 'far fa-file',
      'executable' => 'fas fa-cogs',
      'database' => 'fas fa-database',
      'windows' => 'fab fa-windows',
      'code' => 'far fa-file-code',
      'certificate' => 'fas fa-certificate',
      'html5' => 'fab fa-html5',
      'sass' => 'fab fa-sass',
      'css3' => 'fab fa-css3',
      'php' => 'fab fa-php',
      'js' => 'fab fa-js-square',
      'python' => 'fab fa-python',
      'nodejs' => 'fab fa-node-js',
      /**
       * Social
       */
      'facebook' => 'fab fa-facebook-square',
      'facebook-f' => 'fab fa-facebook-f',
      'twitter' => 'fab fa-twitter-square',
      'googlePlus' => 'fab fa-google-plus-square',
      'github' => 'fab fa-github-square',
      'chevronCircleUp' => 'fas fa-chevron-circle-up',
      'tumblr' => 'fab fa-tumblr-square',
      'stumbleupon' => 'fab fa-stumbleupon-circle',
      'pinterest' => 'fab fa-pinterest-square',
      'blogger' => 'fab fa-blogger',
      'cc' => 'fab fa-creative-commons',
      /**
       * General
       */
      'phone' => 'fas fa-phone',
      'envelope' => 'far fa-envelope',
      'user' => 'far fa-user',
      'users' => 'fas fa-users',
      'book' => 'fas fa-book',
      'database' => 'fas fa-database',
      'search' => 'fas fa-search',
      'copy' => 'far fa-copy',
      'ban' => 'fas fa-ban',
      'eraser' => 'fas fa-eraser',
      'exclamation' => 'fas fa-exclamation-triangle',
      'tags' => 'fas fa-tags',
      'stethoscope' => 'fas fa-stethoscope',
      'terminal' => 'fas fa-terminal',
      'flag' => 'fas fa-flag',
      /**
       * Brands
       */
      'apple' => 'fab fa-apple',
      'android' => 'fab fa-android',
      'angular' => 'fab fa-angular',
      'apper' => 'fab fa-apper',
      'blogger' => 'fab fa-blogger',
      'cpanel' => 'fab fa-cpanel',
      'digg' => 'fab fa-digg',
      'dropbox' => 'fab fa-dropbox',
      'dribbble' => 'fab fa-dribbble',
      
      
      'eye' => 'far fa-eye',
      
  );

  /**
   * @var Filetype|null singleton instance 
   */
  private static $instance;
  
  /**
   * @var string[]
   */
  private $classes = [];

  public function __construct() {
    $this->classes = [];
  }

  /**
   * Creates an icon object
   *
   * @param  string $fileType the file type
   * @param  string $screenReaderText 
   * @return FaIcon the corresponding component
   */
  public function __invoke(string $fileType, string $screenReaderText = null): FaIcon {
    return static::get($fileType, $screenReaderText);
  }

  /**
   * Creates an icon object
   *
   * @param  string $fileType the file type
   * @param  array $arguments 
   * @return FaIcon the corresponding component
   */
  public function __call(string $fileType, array $arguments): FaIcon {
    $screenReaderText = array_shift($arguments);
    $icon = static::get($fileType, $screenReaderText);
    foreach ($this->classes as $propertyName => $value) {
      $icon->$propertyName($value);
    }
    return $icon;
  }

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

  /**
   * Creates an icon object
   *
   * @param  string $name the file type
   * @param  string $screenReaderText 
   * @return FaIcon the corresponding component
   */
  public static function get(string $name, string $screenReaderText = null): FaIcon {
    if (isset(static::$tags[$name])) {
      $classes = static::$tags[$name];
    } else {
      $classes = $name;
    }
    return new FaIcon($classes, $screenReaderText);
  }

  /**
   * Optionally pulls the icon to left or right
   * 
   * @param  string|null $direction the direction of the pull
   * @return $this for a fluent interface
   */
  public function pull(string $direction = null) {
    $this->classes['pull'] = $direction;
    return $this;
  }

  /**
   * Sets/unsets the width of the icon fixed
   * 
   * @param bool $fixedWidth
   * @return $this for a fluent interface
   */
  public function fixedWidth(bool $fixedWidth = true) {
    $this->classes['fixedWidth'] = $fixedWidth;
    return $this;
  }

  /**
   * Sets the size of the icon
   * 
   * @param  string|null $size the size of the icon
   * @return $this for a fluent interface
   */
  public function setSize(string $size = null) {
    $this->classes['size'] = $size;
    return $this;
  }

  /**
   * Returns the singleton instance
   * 
   * @return Icons singleton instance
   */
  public static function instance(): Icons {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
