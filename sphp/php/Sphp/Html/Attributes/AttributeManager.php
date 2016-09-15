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
   */
  public function __construct(array $objectMap = []) {
    $objects = [
        new MultiValueAttribute("class"),
        new PropertyAttribute("style"),
        new IdentifyingAttribute("id")
    ];
    $d = array_merge($objects, $objectMap);
    parent::__construct($d);
  }

  /**
   * Returns the class attribute object
   *
   * @return MultiValueAttribute the class attribute object
   */
  public function classes() {
    return $this->getAttributeObject("class");
  }

  /**
   * Returns the style attribute object
   *
   * @return PropertyAttribute the style attribute object
   */
  public function inlineStyles() {
    return $this->getAttributeObject("style");
  }

  /**
   * Returns the style attribute object
   *
   * @return PropertyAttribute the style attribute object
   */
  public function id() {
    return $this->getAttributeObject("id");
  }

}
