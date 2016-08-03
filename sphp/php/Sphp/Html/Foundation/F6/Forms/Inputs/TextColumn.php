<?php

/**
 * TextColumn.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\F6\Forms\Inputs;

use Sphp\Html\Forms\InputInterface as InputInterface;
use Sphp\Html\Forms\Inputs\TextInput as TextInput;

/**
 * Class implements Foundation framework based component to create  multi-device layouts
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TextColumn extends TextualColumn {

  /**
   * Constructs a new instance
   *
   * @param string|null $name
   * @param string|null $value
   * @param string|null $maxlength
   * @param string|null $size
   */
  public function __construct($name = null, $value = null, $maxlength = null, $size = null) {
    $textInput = new TextInput($name, $value, $maxlength, $size);
    parent::__construct($textInput);
  }

}
