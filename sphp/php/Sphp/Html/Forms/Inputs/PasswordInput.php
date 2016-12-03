<?php

/**
 * PasswordInput.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Class models &lt;input type="password"&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-26
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
  public function __construct($name = null, $value = null, $size = null, $maxlength = null) {
    parent::__construct('password', $name, $value, $maxlength, $size);
  }

}
