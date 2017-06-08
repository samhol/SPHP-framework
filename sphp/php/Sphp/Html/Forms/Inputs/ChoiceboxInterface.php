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
 * @since   2013-10-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ChoiceboxInterface extends InputInterface {

  /**
   * Checks/unchecks the choice
   *
   * @param  boolean $checked true if chosen, false otherwise
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_checked.asp checked attribute
   */
  public function setChecked(bool $checked = true);
}
