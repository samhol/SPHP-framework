<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Defines an HTML input type="radio|checkbox" tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface BooleanInput extends Input {

  /**
   * Checks/unchecks the choice
   *
   * @param  bool $checked true if chosen, false otherwise
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_input_checked.asp checked attribute
   */
  public function setChecked(bool $checked = true);

  /**
   * Checks if the choice is made
   *
   * @return bool true if chosen, false otherwise
   * @link   https://www.w3schools.com/tags/att_input_checked.asp checked attribute
   */
  public function isChecked(): bool;
}
