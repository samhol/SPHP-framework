<?php

/**
 * InputInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Content;
use Sphp\Html\Exceptions\InvalidStateException;
/**
 * Defines required operations for all HTML form input components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface InputInterface extends Content {

  /**
   * Returns the name of the form input
   *
   * @return string|null the name of the form input
   */
  public function getName();

  /**
   * Sets the name of the input
   *
   * **Note:** Only form elements with a name attribute will have their values 
   * passed when submitting a form.
   *
   * @param  string $name the name of the input
   * @return $this for a fluent interface
   */
  public function setName(string $name);

  /**
   * Checks whether the form input has a name
   *
   * **Note:** Only form elements with a name attribute will have their values 
   * passed when submitting a form.
   *
   * @return boolean true if the input has a name, otherwise false
   */
  public function isNamed(): bool;

  /**
   * Returns the value of the form input
   *
   * @return  mixed the value
   */
  public function getSubmitValue();

  /**
   * Sets  the value of the input
   *
   * @param  scalar $value the value of the input
   * @return $this for a fluent interface
   * @throws InvalidStateException if the value is not valid for the input type
   */
  public function setSubmitValue($value);

  /**
   * Disables the input
   * 
   * A disabled input is unusable and un-clickable. 
   * Disabled input in a form will not be submitted.
   *
   * @param  boolean $disabled true for disabled, otherwise false
   * @return $this for a fluent interface
   */
  public function disable(bool $disabled = true);

  /**
   * Checks whether the input is enabled or not
   * 
   * @return boolean true if the input is enabled, otherwise false
   */
  public function isEnabled(): bool;
}
