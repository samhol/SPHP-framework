<?php

/**
 * HiddenInput.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\NonVisualContentInterface;

/**
 * Implements an HTML &lt;input type="hidden"&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HiddenInput extends AbstractInputTag implements NonVisualContentInterface {

  /**
   * Constructs a new instance
   *
   * @param  string|null $name name attribute
   * @param  scalar|null $value value attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct(string $name = null, $value = null) {
    parent::__construct('hidden', $name, $value);
  }

}
