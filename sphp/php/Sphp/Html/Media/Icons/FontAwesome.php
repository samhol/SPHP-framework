<?php

declare(strict_types=1);

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
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://fontawesome.com/ Font Awesome
 * @filesource
 */
class FontAwesome extends IconFactory {

  /**
   *  member function map 
   *
   * @var array[]
   */
  private $functions = [];

  /**
   * Constructor
   */
  public function __construct(string $defaultTagName = 'i') {
    parent::__construct($defaultTagName);
    $this->functions = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->functions);
  }

  /**
   * Creates an icon instance
   * 
   * @param  string $iconName
   * @param  string $tagname
   * @return IconTag
   */
  public function createIcon(string $iconName, string $tagname = 'i'): IconTag {
    $icon = new FontAwesomeIcon($iconName);
    $this->insertIconAttributesTo($icon);
    $this->setCssClassesTo($icon);
    return $icon;
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
   * Sets the size of the icon
   * 
   * @param  string|null $borders the size of the icon
   * @return $this for a fluent interface
   */
  public function useBorsers(bool $borders = true) {
    $this->functions['useBorders'] = $borders;
    return $this;
  }

}
