<?php

/**
 * ScriptCode.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Programming;

use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;script&gt; tag having script code as its content
 *
 * **IMPORTANT:** 
 * 
 * This component contains scripting statements
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-10-17
 * @link http://www.w3schools.com/tags/tag_script.asp w3schools API
 * @link http://dev.w3.org/html5/spec/Overview.html#script W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ScriptCode extends ContainerTag implements ScriptInterface {

  /**
   * Constructs a new instance
   * 
   * **IMPORTANT:** 
   * 
   * This component contains scripting statements
   *
   * @param  int $purpose the purpose of the script component
   * @param  string $code the script code inside the script component or `null` for empty
   */
  public function __construct($code = null) {
    parent::__construct('script', $code);
  }

  /**
   * Sets the value of the type attribute
   *
   * Specifies the MIME type of the script
   *
   * @param  string $type the value of the type attribute (mime-type)
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_script_type.asp type attribute
   */
  public function setType($type) {
    return $this->setAttr('type', $type);
  }

}
