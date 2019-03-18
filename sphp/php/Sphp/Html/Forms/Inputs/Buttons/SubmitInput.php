<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Buttons;

use Sphp\Html\Forms\Buttons\SubmitterInterface;
use Sphp\Html\Forms\Inputs\Input;

/**
 * Implements &lt;input type="submit"&gt; tag
 *
 * A submit button is used to send form data to a server.
 * The data is sent to the page specified in the form's action attribute.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-input-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SubmitInput extends AbstractInputButton implements SubmitterInterface, Input {

  use \Sphp\Html\Forms\Inputs\InputTagTrait;

  /**
   * Constructor
   *
   * @param  string|null $value the value of value attribute
   * @param  string|null $name the value of name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   */
  public function __construct(string $value = null, string $name = null) {
    parent::__construct('submit');
    if ($name !== null) {
      $this->setName($name);
    }
    if (isset($value)) {
      $this->setInitialValue($value);
    }
  }

}
