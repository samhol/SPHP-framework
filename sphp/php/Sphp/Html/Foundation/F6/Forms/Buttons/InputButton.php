<?php

/**
 * InputButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms\Buttons;

use Sphp\Html\Forms\Buttons\InputButton as InputButtonTag;
use Sphp\Html\Foundation\F6\Buttons\ButtonInterface as ButtonInterface;
use Sphp\Html\Foundation\F6\Buttons\ButtonTrait as ButtonTrait;

/**
 * Class models &lt;input type="button|submit|reset"&gt; tag as a Foundation Button in PHP
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools API link
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-input-element W3C API link
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
    $this->cssClasses()->lock("button");
  }

}
