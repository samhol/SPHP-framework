<?php

/**
 * InputTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

use Sphp\Html\Attributes\AttributeManager as AttributeManager;
use Sphp\Core\Types\Strings as Strings;

/**
 * Trait implements parts of the {@link InputInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-05
 * @version 1.0.0
 * @filesource
 */
trait InputTrait {

  /**
   * Returns the attribute manager attached to the component
   * 
   * @return AttributeManager the attribute manager
   */
  abstract public function attrs();

  /**
   * Returns the value of the name attribute.
   *
   * @return string|null name attribute
   */
  public function getName() {
    return $this->attrs()->getValue("name");
  }

  /**
   * Sets the value of the name attribute
   *
   * @param  string $name the value of the name attribute
   * @return self for PHP Method Chaining
   */
  public function setName($name) {
    $this->attrs()->set("name", $name);
    return $this;
  }

  /**
   * Checks whether the form input has a name
   *
   * **Note:** Only form elements with a name attribute will have their values 
   * passed when submitting a form.
   *
   * @return boolean true if the input has a name, otherwise false
   */
  public function isNamed() {
    return $this->attrs()->exists("name") && Strings::notEmpty($this->getName());
  }

  /**
   * Disables the input component
   * 
   * A disabled input component is unusable and un-clickable. 
   * Disabled input components in a form will not be submitted.
   *
   * @param  boolean $disabled true if the component is disabled, otherwise false
   * @return self for PHP Method Chaining
   */
  public function disable($disabled = true) {
    $this->attrs()->set("disabled", (bool) $disabled);
    return $this;
  }

  /**
   * Checks whether the option is enabled or not
   * 
   * @param  boolean true if the option is enabled, otherwise false
   */
  public function isEnabled() {
    return !$this->attrs()->exists("disabled");
  }

}
