<?php

/**
 * InputInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\ContentInterface;

/**
 * Defines required operations for all input components used in {@link FormInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-02-15
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface InputInterface extends ContentInterface {

  /**
   * Returns the name of the form input
   *
   * @return string|null the name of the form input
   */
  public function getName();

  /**
   * Sets the name of the form input
   *
   * **Note:** Only form elements with a name attribute will have their values 
   * passed when submitting a form.
   *
   * @param  string $name the name of the form input
   * @return self for a fluent interface
   */
  public function setName($name);

  /**
   * Checks whether the form input has a name
   *
   * **Note:** Only form elements with a name attribute will have their values 
   * passed when submitting a form.
   *
   * @return boolean true if the input has a name , otherwise false
   */
  public function isNamed();

  /**
   * Returns the value of the form input
   *
   * @return  scalar|scalar[] the value
   */
  public function getSubmitValue();

  /**
   * Sets  the value of the form input
   *
   * @param  string|string[] $value the value of the form input
   * @return self for a fluent interface
   * @throws \InvalidArgumentException if the value is not valid for the input type
   */
  public function setValue($value);

  /**
   * Disables the input component
   * 
   * A disabled input component is unusable and un-clickable. 
   * Disabled input components in a form will not be submitted.
   *
   * @param  boolean $disabled true if the component is disabled, otherwise false
   * @return self for a fluent interface
   */
  public function disable($disabled = true);

  /**
   * Checks whether the input component is enabled or not
   * 
   * @param  boolean true if the input component is enabled, otherwise false
   */
  public function isEnabled();
}
