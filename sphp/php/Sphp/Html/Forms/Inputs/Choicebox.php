<?php

/**
 * Choicebox.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Implements an HTML &lt;input type="radio|checkbox"&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Choicebox extends InputTag implements ChoiceboxInterface {

  /**
   * Constructs a new instance
   *
   * @param  string $type the value of the type attribute ('radio'|'checkbox')
   * @param  string $name the value of the name attribute
   * @param  scalar $value the value of the value attribute
   * @param  boolean $checked is component checked or not
   * @link   http://www.w3schools.com/tags/att_input_type.asp type attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   * @link   http://www.w3schools.com/tags/att_input_checked.asp checked attribute
   */
  public function __construct(string $type, string $name = null, $value = null, bool $checked = false) {
    parent::__construct($type, $name, $value);
    $this->setChecked($checked);
  }

  /**
   * Checks/unchecks the choice
   *
   * @param  boolean $checked true if chosen, false otherwise
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_checked.asp checked attribute
   */
  public function setChecked(bool $checked = true) {
    return $this->attrs()->set('checked', $checked);
  }

}
