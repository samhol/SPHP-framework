<?php

/**
 * ScriptInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Programming;

use Sphp\Html\ComponentInterface;
use Sphp\Html\Head\HeadComponentInterface as HeadComponentInterface;

/**
 * Defines script tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-27
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ScriptInterface extends ComponentInterface, HeadComponentInterface {

  /**
   * Sets the value of the type attribute
   *
   * Specifies the MIME type of the script
   *
   * @param  string $type the value of the type attribute (mime-type)
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_script_type.asp type attribute
   */
  public function setType($type);
}
