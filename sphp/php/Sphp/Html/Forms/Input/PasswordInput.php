<?php

/**
 * PasswordInput.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Input;

/**
 * Class models &lt;input type="password"&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-26
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PasswordInput extends TextualInput {

  /**
   * Constructor
   *
   *  * **Preconditions:**   <var>0 < $size <= $maxlength</var>
   *  * **Postconditions:**  <var>true</var>
   *
   * @param  string $name name attribute
   * @param  string $value value attribute
   * @param  int $size size attribute
   * @param  int $maxlength maxlength attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   * @link   http://www.w3schools.com/tags/att_input_size.asp size attribute
   * @link   http://www.w3schools.com/tags/att_input_maxlength.asp maxlength attribute
   */
  function __construct($name = null, $value = null, $size = null, $maxlength = null) {
    parent::__construct("password", $name, $value, $maxlength, $size);
  }

}
