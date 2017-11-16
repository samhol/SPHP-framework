<?php

/**
 * Checkboxes.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Forms\Inputs\Checkbox;

/**
 * A component containing multiple {@link Checkbox} inputs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Checkboxes extends Choiceboxes {

  public function setOption($value, $label, bool $checked = false) {
    $input = new Checkbox($this->getName() . '[]', $value, $checked);
    $this->setInput($input, $label);
    return $this;
  }

  /**
   * Sets whether an {@link Checkbox} component must be checked before form 
   *   submission
   * 
   * @param  boolean $required true if an {@link Checkbox} component must
   *         be checked before form submission, otherwise false
   * @return $this for a fluent interface
   */
  public function setRequired(bool $required = true) {
    return $this->setAttr('data-required', $required);
  }

  /**
   * Checks whether an {@link Checkbox} component must be checked before form 
   *   submission
   *
   * @return boolean true if an {@link Checkbox} component must be checked 
   *         before form submission, otherwise false
   */
  public function isRequired(): bool {
    return $this->attrExists('data-required');
  }

}
