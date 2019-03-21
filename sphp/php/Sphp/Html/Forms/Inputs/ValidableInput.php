<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Defines basic functionality of all validable inputs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ValidableInput extends Input {

  /**
   * Sets whether the input must have a value or not before form submission
   * 
   * @param  bool $required true if the input must have a value before form 
   *         submission, otherwise false
   * @return $this for a fluent interface
   */
  public function setRequired(bool $required = true);

  /**
   * Checks whether the input must have a value before form submission
   *
   * @return bool true if the input must have a value before form submission, 
   *         otherwise false
   */
  public function isRequired(): bool;
}


