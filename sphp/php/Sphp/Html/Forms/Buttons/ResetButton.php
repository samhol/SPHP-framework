<?php

/**
 * ResetButton.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Buttons;

/**
 * Implements an HTML &lt;input type="reset"&gt; tag
 *
 * {@inheritdoc}
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since  2012-08-22
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-input-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ResetButton extends InputButton {

  /**
   * Constructs a new instance
   *
   * @param  string|null $name the value of name attribute
   * @param  string|null $value the value of value attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct($name = null, $value = null) {
    parent::__construct('reset', $name, $value);
  }

}
