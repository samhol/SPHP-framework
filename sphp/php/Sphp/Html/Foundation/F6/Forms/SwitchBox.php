<?php

/**
 * SwitchBox.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Forms\InputInterface as InputInterface;
use Sphp\Html\Forms\Input\HiddenInput as HiddenInput;
use Sphp\Html\Forms\Label as Label;
use Sphp\Html\Span as Span;

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
   * <div class="switch">
    <input class="switch-input" id="exampleSwitch" type="checkbox" name="exampleSwitch">
    <label class="switch-paddle" for="exampleSwitch">
    <span class="show-for-sr">Download Kittens</span>
    <span class="switch-active" aria-hidden="true">Yes</span>
    <span class="switch-inactive" aria-hidden="true">No</span>
    </label>
    </div>
   * @param int $start the start value of the slider
   * @param int $end the end value of the slider
   * @param int $value the current value of the slider
   * @param int $step the length of a single step
   */
  public function __construct($name, $value, $checked = false) {
    parent::__construct(new \Sphp\Html\Forms\Input\Checkbox($name, $value, $checked));
  }

}
