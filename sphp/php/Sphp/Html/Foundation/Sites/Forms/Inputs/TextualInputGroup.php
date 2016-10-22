<?php

/**
 * TextualInputGroup.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Forms\Inputs\TextualInputInterface;
use Sphp\Html\Forms\Inputs\TextualInput;

/**
 * Class InputGroup
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-21
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TextualInputGroup extends InputGroup implements TextualInputInterface {

  use \Sphp\Html\Forms\Inputs\TextualInputWrapperTrait;

  /**
   * 
   * @param string $type
   * @param string|null $prefix the content of the prefix
   * @param string|null $suffix the content of the suffix
   */
  public function __construct($type = 'text', $prefix = null, $suffix = null) {
    parent::__construct(new TextualInput($type), $prefix, $suffix);
  }

}
