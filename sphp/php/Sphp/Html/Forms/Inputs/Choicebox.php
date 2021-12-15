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
 * Implementation of an HTML input type="radio|checkbox" tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Choicebox extends InputTag implements BooleanInput {

  /**
   * Constructor
   *
   * @param  string $type the value of the type attribute ('radio'|'checkbox')
   * @param  string|null $name the value of the name attribute
   * @param  scalar $value the value of the value attribute
   * @param  bool $checked is component checked or not
   * @link   https://www.w3schools.com/tags/att_input_type.asp type attribute
   * @link   https://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   https://www.w3schools.com/tags/att_input_value.asp value attribute
   * @link   https://www.w3schools.com/tags/att_input_checked.asp checked attribute
   */
  public function __construct(string $type, ?string $name = null, $value = null, bool $checked = false) {
    parent::__construct($type, $name, $value);
    $this->setChecked($checked);
  }

  /**
   * Checks/unchecks the choice
   *
   * @param  bool $checked true if chosen, false otherwise
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_input_checked.asp checked attribute
   */
  public function setChecked(bool $checked = true) {
    $this->setAttribute('checked', $checked);
    return $this;
  }

  public function isChecked(): bool {
    return $this->attributeExists('checked');
  }

}
