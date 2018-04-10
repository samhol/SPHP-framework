<?php

/**
 * PasswordInput.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Implements &lt;input type="password"&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PasswordInput extends TextualInput {

  /**
   * Constructs a new instance
   *
   * @param  string $name name attribute
   * @param  string $value value attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct(string $name = null, $value = null) {
    parent::__construct('password', $name, $value);
  }

}
