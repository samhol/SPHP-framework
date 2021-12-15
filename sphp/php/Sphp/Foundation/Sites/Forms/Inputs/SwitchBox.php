<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Forms\Inputs\Checkbox;

/**
 * Implements a Foundation Framework based switch
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SwitchBox extends AbstractSwitch {

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
    parent::__construct(new Checkbox($name, $value, $checked), $screenReaderLabel);
  }

}
