<?php

/**
 * SubmitButton.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Buttons;

use Sphp\Html\Forms\Inputs\Input;

/**
 * Implements &lt;button type="submit"&gt; tag
 *
 * A submit button is used to send form data to a server.
 * The data is sent to the page specified in the action attribute of the form.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-input-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Submitter extends AbstractButton implements SubmitterInterface, Input {

  use \Sphp\Html\Forms\Inputs\InputTagTrait;

  /**
   * Constructs a new instance
   *
   * @param  string|null $content the content of the button
   * @param  string|null $name the value of name attribute
   * @param  string|null $value the value of value attribute
   * @link   http://www.w3schools.com/tags/att_button_value.asp value attribute
   * @link   http://www.w3schools.com/tags/att_button_name.asp name attribute
   */
  public function __construct($content = null, $name = null, $value = null) {
    parent::__construct('button', 'submit', $content);
    if (isset($name)) {
      $this->setName($name);
    }
    if (isset($value)) {
      $this->setSubmitValue($value);
    }
  }

}
