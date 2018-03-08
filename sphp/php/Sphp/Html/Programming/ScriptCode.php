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
 * @link http://www.w3schools.com/tags/tag_script.asp w3schools API
 * @link http://dev.w3.org/html5/spec/Overview.html#script W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ScriptCode extends ContainerTag implements ScriptTag {

  /**
   * Constructs a new instance
   * 
   * **IMPORTANT:** 
   * 
   * This component contains scripting statements
   *
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
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_script_type.asp type attribute
   */
  public function setType(string $type) {
    return $this->setAttribute('type', $type);
  }

}
