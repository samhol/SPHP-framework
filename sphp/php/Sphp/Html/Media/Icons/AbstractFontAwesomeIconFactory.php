<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Media\Icons;

/**
 * Description of AbstractFontAwesomeIconFactory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractFontAwesomeIconFactory {

  /**
   * @var AbstractFontAwesomeIconFactory|null singleton instance 
   */
  private static $instance;

  /**
   *  member function map 
   *
   * @var array[]
   */
  private $functions = [];

  /**
   * Constructor
   */
  public function __construct() {
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
   * @return FaIcon the corresponding component
   */
  public function __invoke(string $fileType, string $screenReaderText = null): FaIcon {
    $icon = static::get($fileType, $screenReaderText);
    $this->setCssClassesTo($icon);
    return $icon;
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
    $this->setCssClassesTo($icon);
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
    $screenReaderText = array_shift($arguments);
    return static::instance()->getIcon($name, $screenReaderText);
  }

  /**
   * 
   * @param  FaIcon $icon
   * @return void
   */
  public function setCssClassesTo(FaIcon $icon): void {
    foreach ($this->functions as $propertyName => $value) {
      $icon->$propertyName($value);
    }
  }

  /**
   * Creates an icon object
   *
   * @param  string $name the file type
   * @param  string $screenReaderText 
   * @return FaIcon the corresponding component
   */
  abstract public function getIcon(string $name, string $screenReaderText = null): FaIcon;

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

  /**
   * Returns the singleton instance
   * 
   * @return AbstractFontAwesomeIconFactory singleton instance
   */
  public static function instance(): AbstractFontAwesomeIconFactory {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
