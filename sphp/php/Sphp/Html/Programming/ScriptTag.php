<?php

/**
 * ScriptTag.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Programming;

use Sphp\Html\ComponentInterface;

/**
 * Defines an HTML script tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ScriptTag extends Script, ComponentInterface {

  /**
   * Sets the value of the type attribute
   *
   * Specifies the MIME type of the script
   *
   * @param  string $type the value of the type attribute (mime-type)
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_script_type.asp type attribute
   */
  public function setType(string $type);
}
