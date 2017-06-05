<?php

/**
 * SubmitButton.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Inputs\Buttons;

use Sphp\Html\EmptyTag;
use Sphp\Exceptions\InvalidArgumentException;
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
class AbstractButton extends EmptyTag {

  /**
   * Constructs a new instance
   *
   * @param  string $type the type of the button
   * @link   http://www.w3schools.com/tags/att_input_type.asp type attribute
   * @throws Sphp\Exceptions\InvalidArgumentException if the type parameter is invalid
   */
  public function __construct($type) {
    if (!Strings::match($type, "/^(submit|reset|button|image)$/")) {
      throw new InvalidArgumentException("Illegal form button type '$type'");
    }
    parent::__construct('input');
    $this->attrs()->lock('type', $type);
  }

}
