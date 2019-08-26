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
 * @method \Sphp\Html\Media\Icons\FontIcon i(string $iconName) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FontIcon span(string $iconName) creates a new icon object
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

  public function getTagName(): string {
    return $this->tagName;
  }

  public function setTagName(string $tagName) {
    $this->tagName = $tagName;
    return $this;
  }

  /**
   * Creates an icon object
   *
   * @param  string $fileType the file type
   * @param  string $screenReaderText 
   * @return FontAwesomeIcon the corresponding component
   */
  public function __invoke(string $fileType, string $screenReaderText = null): IconTag {
    $icon = new IconTag($fileType, $this->getTagName());
    $icon->setAriaLabel($screenReaderText);
    return $icon;
  }

  /**
   * Creates an icon object
   *
   * @param  string $fileType the file type
   * @param  array $arguments 
   * @return FontAwesomeIcon the corresponding component
   */
  public function __call(string $fileType, array $arguments): IconTag {
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
  public static function __callStatic(string $name, array $arguments): IconTag {
    //$screenReaderText = array_shift($arguments);
    return static::get($arguments[0], $name);
  }

  /**
   * Creates an icon object
   *
   * @param  string $iconName
   * @param  string $tagName
   * @return IconTag the corresponding component
   */
  public static function get(string $iconName, string $tagName = 'i'): IconTag {
    $icon = new IconTag($iconName, $tagName);
    return $icon;
  }

}
