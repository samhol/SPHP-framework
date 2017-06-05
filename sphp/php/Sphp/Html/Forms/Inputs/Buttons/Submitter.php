<?php

/**
 * Submit.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Inputs\Buttons;

use Sphp\Html\Forms\SubmitterInterface;
use Sphp\Html\Forms\Inputs\InputInterface;

/**
 * Implements &lt;input type="submit"&gt; tag
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
class Submitter extends AbstractButton implements SubmitterInterface, InputInterface {

  use \Sphp\Html\Forms\Inputs\InputTagTrait;

  /**
   * Constructs a new instance
   *
   * @param  string|null $value the value of value attribute
   * @param  string|null $name the value of name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   */
  public function __construct($value = null, $name = null) {
    parent::__construct('submit');
    if (isset($name)) {
      $this->setName($name);
    }
    if (isset($value)) {
      $this->setValue($value);
    }
  }

}
