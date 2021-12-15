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
 * Defines required operations for a pattern validable input components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface PatternValidableInput extends ValidableInput {

  /**
   * Sets the regular expression pattern that the component's value is checked against
   *
   * **Note:** The pattern attribute works with the following input types: text, search, url, tel, email, and password.
   * 
   * @param  string|null $pattern a regular expression pattern
   * @return $this for a fluent interface
   */
  public function setPattern(?string $pattern);

  /**
   * Returns the validation pattern string
   *
   * @return string|null the regular expression pattern that the component's 
   *         value is checked against
   * @link   https://www.w3schools.com/tags/att_input_pattern.asp pattern attribute
   */
  public function getPattern(): ?string;

  /**
   * Checks if validation pattern is set for the component
   *
   * @return bool true if a value validation pattern is set for the 
   *         component, otherwise false
   * @link   https://www.w3schools.com/tags/att_input_pattern.asp pattern attribute
   */
  public function hasPattern(): bool;
}
