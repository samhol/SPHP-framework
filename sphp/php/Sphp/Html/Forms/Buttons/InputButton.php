<?php

/**
 * SubmitButton.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Buttons;

use Sphp\Html\Forms\Inputs\AbstractInputTag as AbstractInputTag;
use InvalidArgumentException;
use Sphp\Stdlib\Strings;

/**
 * Implements &lt;input type="button|submit|reset"&gt; button tag
 *
 * A submit button is used to send form data to a server.
 * The data is sent to the page specified in the form's action attribute.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-26
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-input-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class InputButton extends AbstractInputTag implements ButtonInterface {

  /**
   * Constructs a new instance
   *
   * @param  string $type the value of the type attribute
   * @param  string|null $name the value of the name attribute
   * @param  string|null $value the value of the value attribute
   * @link   http://www.w3schools.com/tags/att_input_type.asp type attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct($type, $name = null, $value = null) {
    if (!Strings::match($type, "/^(submit|reset|button)$/")) {
      throw new InvalidArgumentException("Illegal form button type '$type'");
    }
    parent::__construct($type, $name, $value);
  }
}
