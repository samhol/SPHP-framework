<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Buttons;

use Sphp\Html\Forms\FormController;

/**
 * Defines HTML buttons used in HTML forms
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Button extends FormController {
  
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
   * @param  string|null $name the name of the input
   * @return $this for a fluent interface
   */
  public function setName(?string $name);

  /**
   * Checks whether the form input has a name
   *
   * **Note:** Only form elements with a name attribute will have their values 
   * passed when submitting a form.
   *
   * @return bool true if the input has a name, otherwise false
   */
  public function isNamed(): bool;
}
