<?php

/**
 * ScriptInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Programming;

use Sphp\Html\ComponentInterface as ComponentInterface;
use Sphp\Html\Head\MetaDataInterface as MetaDataInterface;

/**
 * Interface ScriptInterface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-27
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ScriptInterface extends ComponentInterface, MetaDataInterface {

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "script";

  /**
   * Sets the value of the type attribute
   *
   * Specifies the MIME type of the script
   *
   * @param  string $type the value of the type attribute (mime-type)
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_script_type.asp type attribute
   */
  public function setType($type);
}
