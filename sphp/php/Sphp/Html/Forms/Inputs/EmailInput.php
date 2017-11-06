<?php

/**
 * EmailInput.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Implements an HTML &lt;input type="email"&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class EmailInput extends TextualInput {

  /**
   * Constructs a new instance
   *
   * @param  string|null $name the value of the  name attribute
   * @param  string|null $value the value of the  value attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct(string $name = null, $value = null) {
    parent::__construct('email', $name, $value);
  }

  /**
   * Sets whether to accept multiple email addresses or not
   *
   * @param  boolean $multiple whether to accept multiple email addresses or not
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_multiple.asp multiple attribute
   */
  public function multiple(bool $multiple = true) {
    $this->attrs()->setBoolean('multiple', $multiple);
    return $this;
  }

}

