<?php

/**
 * HtmlAttributeManager.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

/**
 * Description of HtmlAttributeManager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-09-28
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HtmlAttributeManager extends AbstractAttributeManager1 {

  /**
   * Constructs a new instance
   *
   * @param string[] $objectMap
   */
  public function __construct() {
    $objects = new AttributeObjectManager([
        'class' => MultiValueAttribute::class,
        'style' => PropertyAttribute::class,
        'id' => IdentityAttribute::class]);
    parent::__construct($objects);
  }

  /**
   * Returns the class attribute object
   *
   * @return MultiValueAttribute the `class` attribute object
   */
  public function classes(): MultiValueAttribute {
    return $this->getObjectManager()->getObject('class');
  }

  /**
   * Returns the style attribute object
   *
   * @return PropertyAttribute the `style` attribute object
   */
  public function styles(): PropertyAttribute {
    return $this->getObjectManager()->getObject('style');
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
  public function setAria($name, $value) {
    $this->set("aria-$name", $value);
    return $this;
  }

  public function id(): IdentityAttribute {
    return $this->getObjectManager()->getObject('id');
  }

  public function identify(string $prefix = null, int $length = 16): string {
    return $this->id()->identify($prefix, $length);
  }

}
