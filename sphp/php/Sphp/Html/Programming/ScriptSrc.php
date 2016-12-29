<?php

/**
 * ScriptFile.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Programming;

use Sphp\Html\AbstractTag;
use Sphp\Core\Types\URL;

/**
 * Implements an HTML &lt;script&gt; tag having script code as its content
 *
 * **IMPORTANT:** 
 * 
 * This component points to an external script file through the `src` attribute.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-10-17
 * @link http://www.w3schools.com/tags/tag_script.asp w3schools API
 * @link http://dev.w3.org/html5/spec/Overview.html#script W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ScriptSrc extends AbstractTag implements ScriptInterface {

  /**
   * Constructs a new instance
   * 
   * **IMPORTANT:** 
   * 
   * This component points to an external script file through the src attribute.
   * 
   * @param  string|URL $src the url of the script file
   * @param  boolean $async true for asynchronous execution, false otherwise
   * @link   http://www.w3schools.com/tags/att_script_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_script_async.asp async attribute
   */
  public function __construct($src = '', $async = false) {
    parent::__construct('script');
    $this->setSrc($src)->setAsync($async);
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

  /**
   * Sets the value of the async attribute
   * 
   * When present, it specifies that the script will be executed asynchronously as soon as it is available.
   * Note: The async attribute is only for external scripts (and should only be used if the src attribute is present).
   *
   * @param  boolean $async true for asynchronous execution, false otherwise
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_script_async.asp async attribute
   */
  public function setAsync($async = true) {
    return $this->setAttr('async', (bool) $async);
  }

  /**
   * Sets the value of the src attribute
   *
   * @param  string $src the file path of the script file
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_script_src.asp src attribute
   */
  public function setSrc($src) {
    $this->attrs()->set('src', $src);
    return $this;
  }

  /**
   * Returns the value of the src attribute
   *
   * @param  string script's file path
   * @link   http://www.w3schools.com/tags/att_script_src.asp src attribute
   */
  public function getSrc() {
    return $this->attrs()->get('src');
  }

  public function getHtml() {
    $attrs = '' . $this->attrs();
    if ($attrs != '') {
      $attrs = ' ' . $attrs;
    }
    $output = '<' . $this->getTagName() . $attrs . '>';
    $output .= '</' . $this->getTagName() . '>';
    return $output;
  }

}
