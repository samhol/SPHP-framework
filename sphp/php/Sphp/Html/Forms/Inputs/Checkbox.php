<?php

/**
 * Checkbox.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Implements an HTML &lt;input type="checkbox"&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-10-18
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Checkbox extends Choicebox {

  /**
   * Constructs a new instance of the {@link Checkbox} component
   *
   * @Postconditions   <var>attrLocked("type", "checkbox") === true</var>
   * 
   * @param  string|null $name the value of the name attribute
   * @param  string|null $value the value of the value attribute
   * @param  boolean $checked is component checked
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   * @link   http://www.w3schools.com/tags/att_input_checked.asp checked attribute
   */
  public function __construct($name = '', $value = '', $checked = false) {
    parent::__construct('checkbox', $name, $value, $checked);
  }

}
