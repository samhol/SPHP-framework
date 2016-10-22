<?php

/**
 * RadioSwitch.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Forms\Inputs\Radiobox;
use Sphp\Html\Foundation\Sites\Core\ScreenReaderLabel;

/**
 * Class implements a Foundation based radio switch
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-17
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/slider.html Foundation 6 Sliders
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class RadioSwitch extends AbstractSwitch {

  /**
   * Constructs a new instance
   * 
   * @param  string|null $name the value of the name attribute
   * @param  string|null $value the value of the value attribute
   * @param  boolean $checked is component checked
   * @param  ScreenReaderLabel|string $screenReaderLabel the screen reader label or its textual content
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   * @link   http://www.w3schools.com/tags/att_input_checked.asp checked attribute
   */
  public function __construct($name, $value, $checked = false, $screenReaderLabel = '') {
    parent::__construct(new Radiobox($name, $value, $checked), $screenReaderLabel);
  }

}
