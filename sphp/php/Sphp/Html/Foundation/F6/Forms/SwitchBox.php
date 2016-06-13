<?php

/**
 * SwitchBox.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Forms\Input\Checkbox as Checkbox;
/**
 * Slider allows to drag a handle to select a specific value from a range
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-17
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/slider.html Foundation 6 Sliders
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SwitchBox extends AbstractSwitch {

  /**
   * Constructs a new instance
   * 
   * @param string|null $name
   * @param scalar|null $value
   * @param boolean $checked
   */
  public function __construct($name = null, $value = null, $checked = false) {
    parent::__construct(new Checkbox($name, $value, $checked));
  }

}
