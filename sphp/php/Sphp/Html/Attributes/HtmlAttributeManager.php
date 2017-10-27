<?php

/**
 * HtmlAttributeManager.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

/**
 * Implements default attribute manager for all HTML components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HtmlAttributeManager extends AbstractAttributeManager {

  /**
   * Constructs a new instance
   *
   * @param string[] $objectMap
   */
  public function __construct() {
    $objects = [
        'class' => ClassAttribute::class,
        'style' => PropertyAttribute::class,
        'id' => IdentityAttribute::class];
    parent::__construct($objects);
  }

  /**
   * Returns the class attribute object
   *
   * @return ClassAttribute the `class` attribute object
   */
  public function classes(): ClassAttribute {
    return $this->createObject('class');
  }

  /**
   * Returns the style attribute object
   *
   * @return PropertyAttribute the `style` attribute object
   */
  public function styles(): PropertyAttribute {
    return $this->createObject('style');
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
    $this->set("aria-$name", $value);
    return $this;
  }

  public function id(): IdentityAttribute {
    return $this->createObject('id');
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
