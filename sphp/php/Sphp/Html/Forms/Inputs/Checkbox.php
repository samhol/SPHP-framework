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
 * Implementation of an HTML input type="checkbox" tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Checkbox extends Choicebox {

  /**
   * Constructor
   *
   * @param  string|null $name the value of the name attribute
   * @param  scalar|null $value the value of the value attribute
   * @param  bool $checked is component checked
   * @link   https://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   https://www.w3schools.com/tags/att_input_value.asp value attribute
   * @link   https://www.w3schools.com/tags/att_input_checked.asp checked attribute
   */
  public function __construct(?string $name = null, $value = null, bool $checked = false) {
    parent::__construct('checkbox', $name, $value, $checked);
  }

}
