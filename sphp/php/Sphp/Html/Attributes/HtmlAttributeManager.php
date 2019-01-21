<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

/**
 * Implements default attribute manager for all HTML components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class HtmlAttributeManager extends AttributeManager {

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
    $this->getObjectMap()
            ->mapType('class', ClassAttribute::class)
            ->mapType('style', PropertyCollectionAttribute::class)
            ->mapType('id', IdAttribute::class);
  }

  /**
   * Returns the class attribute object
   *
   * @return ClassAttribute the `class` attribute object
   */
  public function classes(): ClassAttribute {
    return $this->getObject('class');
  }

  /**
   * Returns the style attribute object
   *
   * @return PropertyCollectionAttribute the `style` attribute object
   */
  public function styles(): PropertyCollectionAttribute {
    return $this->getObject('style');
  }

  /**
   * Sets an Aria attribute
   *
   * **IMPORTANT!:** Does not alter locked attribute values
   * 
   * @param  string $name the name of the Aria attribute (without the `aria` prefix)
   * @param  mixed $value the value of the attribute
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException if the attribute name or value is invalid
   * @throws \Sphp\Exceptions\RuntimeException if the attribute value is unmodifiable
   * @link   https://www.w3.org/WAI/intro/aria.php
   */
  public function setAria(string $name, $value) {
    $this->setAttribute("aria-$name", $value);
    return $this;
  }

  /**
   * Returns the `id` attribute
   * 
   * @return IdAttribute
   */
  public function id(): IdAttribute {
    return $this->getObject('id');
  }

  /**
   * Identifies the element with an unique id attribute
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. Therefore given id is checked for its uniqueness.
   * 
   * @param  int $length the length of the identity value
   * @return string the identifier
   * @link   http://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function identify(int $length = 16): string {
    return $this->id()->identify($length);
  }

}
