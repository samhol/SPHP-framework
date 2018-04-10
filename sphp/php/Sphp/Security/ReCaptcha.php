<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Security;

use Sphp\Html\Programming\ScriptSrc;
use Sphp\Html\Div;
use Sphp\Html\Content;

/**
 * Implements Google reCAPTCHA HTML component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://developers.google.com/recaptcha/ Google reCAPTCHA
 * @filesource
 */
class ReCaptcha implements Content {

  use \Sphp\Html\ContentTrait;

  /**
   *
   * @var Div
   */
  private $obj;

  public function __construct(string $sitekey) {
    $this->obj = new Div();
    $this->obj->cssClasses()->protect('g-recaptcha');
    $this->obj->setAttribute('data-sitekey', $sitekey);
  }

  public function __destruct() {
    unset($this->obj);
  }

  public function getHtml(): string {
    return $this->obj->getHtml();
  }

  /**
   * Sets the JavaScript callback function
   * 
   * **Optional:** The name of the callback function, executed when the user 
   * submits a successful response. The g-recaptcha-response token is passed 
   * to the callback.
   * 
   * @param string|null $callbackName the JavaScript callback function ()null for none)
   * @return $this for a fluent interface
   */
  public function setCallback(string $callbackName = null) {
    $this->obj->setAttribute('data-callback', $callbackName);
    return $this;
  }

  public function setExpiredCallback(string $callbackName = null) {
    $this->obj->setAttribute('data-expired-callback', $callbackName);
    return $this;
  }

  public function setErrorCallback(string $callbackName = null) {
    $this->obj->setAttribute('data-error-callback', $callbackName);
    return $this;
  }

  /**
   * 
   * @param  string $sitekey
   * @param  string $callbackName
   * @return ReCaptcha
   */
  public static function createObject(string $sitekey, string $callbackName = null): ReCaptcha {
    $div = new static($sitekey);
    $div->setCallback($callbackName);
    return $div;
  }

  /**
   * 
   * @return ScriptSrc
   */
  public static function createScripts(): ScriptSrc {
    return (new ScriptSrc('https://www.google.com/recaptcha/api.js'))->setAsync()->setDefer();
  }

  /**
   * 
   * @param string $sitekey
   * @param bool $loadScript
   * @return type
   */
  public static function createImage(string $sitekey, string $callbackName = null, bool $loadScript = true) {
    $div = new Div();
    $div->addCssClass('g-recaptcha');
    $div->setAttribute('data-sitekey', $sitekey);
    $div->setAttribute('data-callback', $callbackName);
    $output = $div->getHtml();
    if ($loadScript) {
      $output .= (new ScriptSrc('https://www.google.com/recaptcha/api.js'))->setAsync()->setDefer();
    }
    return $output;
  }

  /**
   * 
   * @param  string $secret
   * @return bool
   */
  public static function isValid(string $secret): bool {
    $response = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $secret, //'6Lfh6U4UAAAAAADk_T1MpBhlLy72QTMES2z_I9QB',
        'response' => $response
    ];
    $query = http_build_query($data);
    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
            "Content-Length: " . strlen($query) . "\r\n",
            'method' => 'POST',
            'content' => $query
        ]
    ];
    $context = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captcha_success = json_decode($verify);
    return (bool) $captcha_success->success;
  }

}
