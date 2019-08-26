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
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://fontawesome.com/ Font Awesome
 * @filesource
 */
class IconFactory {

  private $tagName;
  /**
   *  member function map 
   *
   * @var array[]
   */
  private $functions = [];

  /**
   * Constructor
   */
  public function __construct(string $tagName = 'i') {
    $this->tagName = $tagName;
    $this->functions = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->functions);
  }

  /**
   * Creates an icon object
   *
   * @param  string $fileType the file type
   * @param  string $screenReaderText 
   * @return FontAwesomeIcon the corresponding component
   */
  public function __invoke(string $fileType, string $screenReaderText = null): FontAwesomeIcon {
    $icon = static::get($fileType, $screenReaderText);
    $this->setCssClassesTo($icon);
    return $icon;
  }

  /**
   * Creates an icon object
   *
   * @param  string $fileType the file type
   * @param  array $arguments 
   * @return FontAwesomeIcon the corresponding component
   */
  public function __call(string $fileType, array $arguments): FontAwesomeIcon {
    $screenReaderText = array_shift($arguments);
    $icon = static::get($fileType, $screenReaderText);
    $this->setCssClassesTo($icon);
    return $icon;
  }

  /**
   * Creates a new icon object
   *
   * @param  string $name the name of the icon (function name)
   * @param  array $arguments 
   * @return FontAwesomeIcon the corresponding component
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $arguments): FontAwesomeIcon {
    if (!isset(static::$map[$name])) {
      throw new BadMethodCallException("Method $name does not exist");
    }
    $classes = static::$map[$name];
    $screenReaderText = array_shift($arguments);
    return new FontAwesomeIcon($classes, $screenReaderText);
  }

  /**
   * 
   * @param  FontAwesomeIcon $icon
   * @return void
   */
  public function setCssClassesTo(FontAwesomeIcon $icon): void {
    foreach ($this->functions as $propertyName => $value) {
      $icon->$propertyName($value);
    }
  }

  /**
   * Creates an icon object
   *
   * @param  string $name the file type
   * @param  string $screenReaderText 
   * @return FontAwesomeIcon the corresponding component
   */
  public static function get(string $name, string $screenReaderText = null): FontAwesomeIcon {
    if (isset(static::$map[$name])) {
      $classes = static::$map[$name];
    } else {
      $classes = $name;
    }
    $icon = new FontAwesomeIcon($classes, $screenReaderText);
    return $icon;
  }

  /**
   * Optionally pulls the icon to left or right
   * 
   * @param  string|null $direction the direction of the pull
   * @return $this for a fluent interface
   */
  public function pull(string $direction = null) {
    $this->functions['pull'] = $direction;
    return $this;
  }

  /**
   * Sets/unsets the width of the icon fixed
   * 
   * @param bool $fixedWidth
   * @return $this for a fluent interface
   */
  public function fixedWidth(bool $fixedWidth = true) {
    $this->functions['fixedWidth'] = $fixedWidth;
    return $this;
  }

  /**
   * Sets the size of the icon
   * 
   * @param  string|null $size the size of the icon
   * @return $this for a fluent interface
   */
  public function setSize(string $size = null) {
    $this->functions['setSize'] = $size;
    return $this;
  }

}
