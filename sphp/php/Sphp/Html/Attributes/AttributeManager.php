<?php

/**
 * AttributeManager.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

/**
 * Class contains and manages all the attribute value pairs for a markup language tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AttributeManager extends AbstractAttributeManager {

  /**
   * Constructs a new instance
   *
   * @param AttributeInterface[] $objectMap
   */
  public function __construct(array $objectMap = []) {
    $objects = [
        new MultiValueAttribute("class"),
        new PropertyAttribute("style")
    ];
    parent::__construct($objects);
    $this->attachIdentifier('id');
    foreach ($objectMap as $obj) {
      $this->setAttributeObject($obj);
    }
  }

  /**
   * Returns the class attribute object
   *
   * @return MultiValueAttribute the `class` attribute object
   */
  public function classes() {
    return $this->getAttributeObject('class');
  }

  /**
   * Returns the style attribute object
   *
   * @return PropertyAttribute the `style` attribute object
   */
  public function styles() {
    return $this->getAttributeObject('style');
  }

  /**
   * Sets an Aria attribute
   *
   * **IMPORTANT!:** Does not alter locked attribute values
   * 
   * @param  string $name the name of the Aria attribute (without the `aria` prefix)
   * @param  mixed $value the value of the attribute
   * @return self for a fluent interface
   * @throws InvalidArgumentException if the attribute name or value is invalid
   * @throws AttributeException if the attribute value is unmodifiable
   * @link   https://www.w3.org/WAI/intro/aria.php
   */
  public function setAria($name, $value) {
    $this->set("aria-$name", $value);
    return $this;
  }

}
