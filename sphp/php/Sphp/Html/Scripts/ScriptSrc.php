<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Scripts;

/**
 * Implements an HTML &lt;script&gt; tag having script code as its content
 *
 * **IMPORTANT:** 
 * 
 * This component points to an external script file through the `src` attribute.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link http://www.w3schools.com/tags/tag_script.asp w3schools API
 * @link http://dev.w3.org/html5/spec/Overview.html#script W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ScriptSrc extends AbstractScriptTag {

  /**
   * Constructor
   * 
   * **IMPORTANT:** 
   * 
   * This component points to an external script file through the `src` attribute.
   * 
   * @param  string $src the URL of the script file
   * @link   http://www.w3schools.com/tags/att_script_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_script_async.asp async attribute
   */
  public function __construct(string $src = null) {
    parent::__construct();
    $this->setSrc($src);
  }

  /**
   * Sets subresource integrity
   * 
   * @param  string $hash a base64-encoded cryptographic hash of a resource (file)
   * @param  string $crossorigin  CORS access to content Request 
   * @return $this for a fluent interface
   * @link   https://developer.mozilla.org/en-US/docs/Web/Security/Subresource_Integrity
   * @link   https://developer.mozilla.org/en-US/docs/Web/HTML/CORS_settings_The crossorigin attribute
   */
  public function setIntegrity(string $hash = null, string $crossorigin = null) {
    $this->attributes()
            ->setAttribute('integrity', $hash);
    if ($hash !== null && $crossorigin === null) {
      $crossorigin = 'anonymous';
    }
    $this->attributes()
            ->setAttribute('crossorigin', $crossorigin);
    return $this;
  }

  /**
   * Sets the URL of the script file
   *
   * @param  string $src the URL of the script file
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_script_src.asp src attribute
   */
  public function setSrc(string $src = null) {
    $this->attributes()->setAttribute('src', $src);
    return $this;
  }

  /**
   * Returns the URL of the script file
   *
   * @return string the URL of the script file
   * @link   http://www.w3schools.com/tags/att_script_src.asp src attribute
   */
  public function getSrc(): ?string {
    return $this->attributes()->getValue('src');
  }

  public function contentToString(): string {
    return '';
  }

}
