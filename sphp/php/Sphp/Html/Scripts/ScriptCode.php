<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Scripts;

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
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ScriptCode extends ContainerTag implements ScriptTag {

  /**
   * Constructor
   * 
   * **IMPORTANT:** 
   * 
   * This component contains scripting statements
   *
   * @param string $code the script code inside the script component or `null` for empty
   */
  public function __construct($code = null) {
    parent::__construct('script', $code);
  }

  /**
   * Specifies the MIME type of the script
   *
   * @param  string $type the value of the type attribute (mime-type)
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_script_type.asp type attribute
   */
  public function setType(string $type = null) {
    $this->attributes()->setAttribute('type', $type);
    return $this;
  }

  /**
   * Sets whether the script is executed asynchronously
   * 
   * Asynchronous script will be executed as soon as it is available.
   * 
   * @param  boolean $async true for asynchronous execution, false otherwise
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_script_async.asp async attribute
   * @link   http://www.w3schools.com/tags/att_script_defer.asp defer attribute
   */
  public function setAsync(bool $async = true) {
    $this->attributes()
            ->remove('defer')
            ->setAttribute('async', $async);
    return $this;
  }

  /**
   * Sets whether the script will not run until after the page has loaded
   * 
   * @param  boolean $defer true for deferred execution, false otherwise
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_script_defer.asp defer attribute
   * @link   http://www.w3schools.com/tags/att_script_async.asp async attribute
   */
  public function setDefer(bool $defer = true) {
    $this->attributes()
            ->remove('async')
            ->setAttribute('defer', $defer);
    return $this;
  }

}
