<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Scripts;

use Sphp\Html\EmptyTag;

/**
 * Implementation of an HTML script tag having script code as its content
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
class ExternalScript extends EmptyTag implements Script {

  /**
   * Constructor
   * 
   * **IMPORTANT:** 
   * 
   * This component points to an external script file through the `src` attribute.
   * 
   * @param  string $src the URL of the script file
   * @link   http://www.w3schools.com/tags/att_script_src.asp src attribute
   */
  public function __construct(string $src) {
    parent::__construct('script', true);
    $this->attributes()->protect('src', $src);
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
   * Returns the URL of the script file
   *
   * @return string the URL of the script file
   * @link   http://www.w3schools.com/tags/att_script_src.asp src attribute
   */
  public function getSrc(): ?string {
    return $this->attributes()->getValue('src');
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
   * Checks whether the script is executed asynchronously
   * 
   * Asynchronous script will be executed as soon as it is available.
   * 
   * @return boolean true for asynchronous execution, false otherwise
   * @link   http://www.w3schools.com/tags/att_script_async.asp async attribute
   * @link   http://www.w3schools.com/tags/att_script_defer.asp defer attribute
   */
  public function isAsync(): bool {
    return $this->attributeExists('async');
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

  /**
   * Checks whether the script will not run until after the page has loaded
   * 
   * @return boolean true for deferred execution, false otherwise
   * @link   http://www.w3schools.com/tags/att_script_defer.asp defer attribute
   * @link   http://www.w3schools.com/tags/att_script_async.asp async attribute
   */
  public function isDefered(): bool {
    return $this->attributeExists('defer');
  }

  public function getHash(): string {
    $data = ['script;src' => $this->getSrc()];
    return md5(json_encode($data));
  }

}
