<?php

/**
 * SPHPlayground Framework (http://playground.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Forms\FormController;
use Sphp\Exceptions\InvalidStateException;

/**
 * Defines required operations for all HTML form input components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Input extends FormController {

  /**
   * Returns the name of the form input
   *
   * @return string|null the name of the form input
   */
  public function getName(): ?string;

  /**
   * Sets the name of the input
   *
   * **Note:** Only form elements with a name attribute will have their values 
   * passed when submitting a form.
   *
   * @param  string $name the name of the input
   * @return $this for a fluent interface
   */
  public function setName(string $name = null);

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
   * @return mixed the value
   */
  public function getSubmitValue();

  /**
   * Sets the initial submit value of the input
   *
   * @param  mixed $value the value of the input
   * @return $this for a fluent interface
   * @throws InvalidStateException if value is not suitable for input
   */
  public function setInitialValue($value);
}
