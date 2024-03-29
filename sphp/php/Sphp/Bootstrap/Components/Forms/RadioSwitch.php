<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components\Forms;

use Sphp\Html\Forms\Inputs\Radiobox;

/**
 * Implements a based radio switch
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/slider.html Foundation Sliders
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class RadioSwitch extends AbstractSwitch {

  /**
   * Constructor
   * 
   * @param  string|null $name the value of the name attribute
   * @param  string|null $value the value of the value attribute
   * @param  bool $checked is component checked
   * @param  string|null $screenReaderLabel the screen reader label or its textual content
   * @link   https://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   https://www.w3schools.com/tags/att_input_value.asp value attribute
   * @link   https://www.w3schools.com/tags/att_input_checked.asp checked attribute
   */
  public function __construct(string $name = null, $value = null, bool $checked = false, string $screenReaderLabel = null) {
    parent::__construct(new Radiobox($name, $value, $checked), $screenReaderLabel);
  }

}
