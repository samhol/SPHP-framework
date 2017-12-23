<?php

/**
 * InputTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Trait implements parts of the {@link InputInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait InputTrait {

  /**
   * Returns the attribute manager attached to the component
   * 
   * @return HtmlAttributeManager the attribute manager
   */
  abstract public function attrs(): HtmlAttributeManager;

  /**
   * Returns the value of the name attribute.
   *
   * @return string name attribute
   */
  public function getName(): string {
    return (string) $this->attrs()->getValue('name');
  }

  /**
   * Sets the value of the name attribute
   *
   * @param  string $name the value of the name attribute
   * @return $this for a fluent interface
   */
  public function setName(string $name) {
    $this->attrs()->set('name', $name);
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
  public function isNamed(): bool {
    return $this->attrs()->exists('name');
  }

  /**
   * Disables the input component
   * 
   * A disabled input component is unusable and un-clickable. 
   * Disabled input components in a form will not be submitted.
   *
   * @param  boolean $disabled true if the component is disabled, otherwise false
   * @return $this for a fluent interface
   */
  public function disable(bool $disabled = true) {
    $this->attrs()->setBoolean('disabled', $disabled);
    return $this;
  }

  /**
   * Checks whether the input is enabled or not
   * 
   * @param  boolean true if the option is enabled, otherwise false
   */
  public function isEnabled(): bool {
    return !$this->attrs()->exists('disabled');
  }

}
