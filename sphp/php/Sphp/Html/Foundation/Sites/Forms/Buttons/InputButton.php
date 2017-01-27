<?php

/**
 * InputButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Forms\Buttons;

use Sphp\Html\Forms\Buttons\InputButton as InputButtonTag;
use Sphp\Html\Foundation\Sites\Buttons\ButtonInterface;
use Sphp\Html\Foundation\Sites\Buttons\ButtonTrait;

/**
 * Implements &lt;input type="button|submit|reset"&gt; tag as a Foundation Button
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-input-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class InputButton extends InputButtonTag implements ButtonInterface {

  use ButtonTrait;

  /**
   * Constructs a new instance
   *
   * @param  string $type the value of type attribute
   * @param  string $name the value of name attribute
   * @param  string $value the value of value attribute
   * @link   http://www.w3schools.com/tags/att_input_type.asp type attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct($type = null, $name = null, $value = null) {
    parent::__construct($type, $name, $value);
    $this->cssClasses()->lock('button');
  }

}
