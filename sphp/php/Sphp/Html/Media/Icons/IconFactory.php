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
 * @method \Sphp\Html\Media\Icons\IconTag i(string $iconName) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag span(string $iconName) creates a new icon object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://fontawesome.com/ Font Awesome
 * @filesource
 */
class IconFactory {

  /**
   * @var string
   */
  private $tagName;

  /**
   *  member function map 
   *
   * @var array[]
   */
  private $attributes = [];

  /**
   * Constructor
   * 
   * @param string $defaultTagname
   */
  public function __construct(string $defaultTagname = 'i') {
    $this->setTagName($defaultTagname);
    $this->attributes = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->attributes);
  }

  /**
   * Creates an icon object
   *
   * @param  string $iconName the file type
   * @param  string $screenReaderText 
   * @return FontAwesomeIcon the corresponding component
   */
  public function __invoke(string $iconName, string $screenReaderText = null): IconTag {
    $icon = $this->createIcon($iconName, $this->getTagName());
    $icon->setAriaLabel($screenReaderText);
    return $icon;
  }

  /**
   * Creates an icon object
   *
   * @param  string $tagname the tagname of the generated icon
   * @param  array $arguments 
   * @return IconTag the corresponding component
   * @throws BadMethodCallException
   */
  public function __call(string $tagname, array $arguments): IconTag {
    if (count($arguments) === 0) {
      throw new BadMethodCallException('Icon name is missing when calling ' . __CLASS__ . '::' . $tagname);
    }
    $icon = $this->createIcon($arguments[0], $tagname);
    return $icon;
  }

  public function getTagName(): string {
    return $this->tagName;
  }

  public function setTagName(string $tagName) {
    $this->tagName = $tagName;
    return $this;
  }

  public function getIconAttributes(): array {
    return $this->attributes;
  }

  public function setIconAttribute(string $name, $value) {
    $this->attributes[$name] = $value;
    return $this;
  }

  /**
   * Creates an icon instance
   * 
   * @param  string $iconName
   * @param  string $tagname
   * @return IconTag
   */
  protected function createIcon(string $iconName, string $tagname = 'i'): IconTag {
    $icon = new IconTag($iconName, $tagname);
    $this->insertIconAttributesTo($icon);
    return $icon;
  }

  protected function insertIconAttributesTo(IconTag $icon): void {
    foreach ($this->getIconAttributes() as $name => $value) {
      $icon->setAttribute($name, $value);
    }
  }

  /**
   * Creates a new icon object
   *
   * @param  string $tagName the name of the icon (function name)
   * @param  array $arguments 
   * @return IconTag the corresponding component
   * @throws BadMethodCallException if icon cannot be created
   */
  public static function __callStatic(string $tagname, array $arguments): IconTag {
    if (count($arguments) === 0) {
      throw new BadMethodCallException('Icon name is missing when calling ' . __CLASS__ . '::' . $tagname);
    }
    try {
      return static::get($arguments[0], $tagname);
    } catch (\Exception $ex) {
      throw new BadMethodCallException('Cannot create icon ' . __CLASS__ . '::' . $tagname, $ex->getCode(), $ex);
    }
  }

  /**
   * Creates an icon object
   *
   * @param  string $iconName
   * @param  string $tagName
   * @return IconTag the corresponding component
   */
  public static function get(string $iconName, string $tagName = 'i'): IconTag {
    $factory = new static($tagName);
    $icon = $factory->createIcon($iconName, $tagName);
    return $icon;
  }

}
