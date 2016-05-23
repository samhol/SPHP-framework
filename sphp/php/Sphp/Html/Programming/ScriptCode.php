<?php

/**
 * ScriptCode.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Programming;

use Sphp\Html\ContainerTag as ContainerTag;

/**
 * Class models an HTML &lt;script&gt; tag having script code as its content
 *
 * **IMPORTANT:** 
 * 
 * The {@link self} component contains scripting statements
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-10-17
 * @version 2.0.0
 * @link http://www.w3schools.com/tags/tag_script.asp w3schools API link
 * @link http://dev.w3.org/html5/spec/Overview.html#script W3C API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ScriptCode extends ContainerTag implements ScriptInterface {

  /**
   * Constructs a new instance
   * 
   * **IMPORTANT:** 
   * 
   * The {@link self} component contains scripting statements
   *
   * @param  int $purpose the purpose of the script component
   * @param  string $type script's mime-type (type attribute)
   * @link   http://www.w3schools.com/tags/att_script_type.asp type attribute
   */
  public function __construct($code = null) {
    parent::__construct(self::TAG_NAME, $code);
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
    return $this->setAttr("type", $type);
  }

}
