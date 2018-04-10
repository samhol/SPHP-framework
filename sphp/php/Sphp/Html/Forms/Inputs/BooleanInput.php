<?php

/**
 * ChoiceboxInterface.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Implements an HTML &lt;input type="radio|checkbox"&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface BooleanInput extends Input {

  /**
   * Checks/unchecks the choice
   *
   * @param  boolean $checked true if chosen, false otherwise
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_checked.asp checked attribute
   */
  public function setChecked(bool $checked = true);
}
