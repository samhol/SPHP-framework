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
 * Implementation of an HTML input type="email" tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class EmailInput extends AbstractTextualInput {

  /**
   * Constructor
   *
   * @param  string|null $name the value of the  name attribute
   * @param  string|null $value the value of the  value attribute
   * @link   https://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   https://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct(string $name = null, $value = null) {
    parent::__construct('email', $name, $value);
  }

  /**
   * Sets whether to accept multiple email addresses or not
   *
   * @param  bool $multiple whether to accept multiple email addresses or not
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_input_multiple.asp multiple attribute
   */
  public function multiple(bool $multiple = true) {
    $this->attributes()->setAttribute('multiple', $multiple);
    return $this;
  }

}
