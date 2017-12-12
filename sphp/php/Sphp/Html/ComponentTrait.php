<?php

/**
 * ComponentTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Html\Attributes\ClassAttribute;
use Sphp\Html\Attributes\PropertyAttribute;

/**
 * Trait implements functionality of {@link ComponentInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ComponentTrait {

  use IdentifiableTrait,
      CssClassifiableTrait;

  /**
   * Returns the attribute manager attached to the component
   *
   * @return HtmlAttributeManager the attribute manager
   */
  abstract public function attrs(): HtmlAttributeManager;

  /**
   * Returns the class attribute object
   *
   * @return ClassAttribute the class attribute object
   */
  public function cssClasses(): ClassAttribute {
    return $this->attrs()->classes();
  }

  /**
   * Returns the attribute object containing inline styles
   *
   * @return PropertyAttribute the attribute object containing inline styles
   */
  public function inlineStyles(): PropertyAttribute {
    return $this->attrs()->styles();
  }

  /**
   * Sets an attribute name value pair
   *
   * **IMPORTANT!:** Does not alter locked attribute values:
   *
   * 1. For 'class' attribute: if a CSS class name is locked the method does nothing
   * 2. For any other locked attribute the method throws a {@link LockingException}
   *
   * **`$value` handling:**
   *
   * 1. the type of the value should always convert to string
   * 2. `null` or an empty `string`: an empty attribute is set
   * 3. boolean `true`: an empty attribute is set
   * 4. boolean `false`: attribute is removed if present
   * 5. otherwise the attribute value the string conversion value
   *
   * @param  string $name the name of the attribute
   * @param  mixed $value the value of the attribute
   * @return $this for a fluent interface
   * @throws InvalidAttributeException if the attribute name or value is invalid
   * @throws UnmodifiableAttributeException if the attribute value is unmodifiable
   */
  public function setAttr(string $name, $value = null) {
    $this->attrs()->set($name, $value);
    return $this;
  }

  /**
   * Removes the given attribute if it is not required
   *
   * @param  string $name the name of the attribute
   * @return $this for a fluent interface
   */
  public function removeAttr(string $name) {
    $this->attrs()->remove($name);
    return $this;
  }

  /**
   * Returns the value of a given attribute name
   *
   * **IMPORTANT:**
   *
   * * Returns always `boolean false` if attribute is not present.
   * * return `null` or an empty string for empty attributes.
   *
   * @param  string $name the name of the attribute
   * @return mixed the value of the attribute
   */
  public function getAttr(string $name) {
    return $this->attrs()->getValue($name);
  }

  /**
   * Checks if an attribute exists
   *
   * @param  string $name the name of the attribute
   * @return boolean (attribute exists)
   */
  public function attrExists(string $name): bool {
    return $this->attrs()->exists($name);
  }

}
