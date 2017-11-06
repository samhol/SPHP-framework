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
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PasswordInput extends TextualInput {

  /**
   * Constructs a new instance
   *
   * @precondition `0 < $size <= $maxlength`
   * @param  string $name name attribute
   * @param  string $value value attribute
   * @param  int $size size attribute
   * @param  int $maxlength maxlength attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   * @link   http://www.w3schools.com/tags/att_input_size.asp size attribute
   * @link   http://www.w3schools.com/tags/att_input_maxlength.asp maxlength attribute
   */
  public function __construct(string $name = null, $value = null, int $size = null, int $maxlength = null) {
    parent::__construct('password', $name, $value, $maxlength, $size);
  }

}

