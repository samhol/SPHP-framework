<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\EmptyTag;
use Sphp\Html\Media\SizeableMedia;
use Sphp\Html\Media\Embeddable;

/**
 * Implementation of an HTML iframe tag (an inline frame)
 *
 * This component represents a nested browsing context.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_iframe.asp w3schools HTML API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-iframe-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Iframe extends EmptyTag implements Embeddable, SizeableMedia {

  /**
   * Constructor
   *
   * @param  string|null $src the address of the document to embed in the object
   * @link   https://www.w3schools.com/tags/att_iframe_src.asp src attribute
   */
  public function __construct(?string $src = null) {
    parent::__construct('iframe', true);
    if ($src !== null) {
      $this->setSrc($src);
    }
  }

  /**
   * Sets the path to the image source (The URL of the image file)
   * 
   * @param  string $src the path to the image source (The URL of the image file)
   * @return $this for a fluent interface
   */
  public function setSrc(string $src) {
    $this->attributes()->setAttribute('src', $src);
    return $this;
  }

  /**
   * Returns the path to the image source (The URL of the image file)
   *
   * @return string the path to the image source (The URL of the image file)
   */
  public function getSrc(): string {
    return (string) $this->attributes()->getValue('src');
  }

  /**
   * Sets the value of the name attribute
   *
   * @param  string $name the value of the name attribute
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_iframe_name.asp name attribute
   */
  public function setName(string $name) {
    $this->attributes()->setAttribute('name', $name);
    return $this;
  }

  /**
   * Returns the value of the name attribute
   *
   * @return string name attribute
   * @link   https://www.w3schools.com/tags/att_iframe_name.asp name attribute
   */
  public function getName(): string {
    return (string) $this->attributes()->getValue('name');
  }

  public function setSize(?int $width, ?int $height) {
    $this->setAttribute('width', $width);
    $this->setAttribute('height', $height);
    return $this;
  }

  /**
   * Sets the loading method used in browser
   *
   * **Definition and Usage:**
   *
   *  The loading attribute specifies whether a browser should load a resource 
   *  immediately or to defer loading of off-screen images until for example the 
   *  user scrolls near them
   * 
   * @param  string $loading the loading method
   * @return $this for a fluent interface
   * @link   https://developer.mozilla.org/en-US/docs/Web/Performance/Lazy_loading#images_and_iframes loading attribute
   */
  public function setLoading(?string $loading) {
    $this->attributes()->setAttribute('loading', $loading);
    return $this;
  }

  /**
   * Sets the value of the sandbox attribute (a set of extra restrictions for
   * the content in the object)
   *
   * **Values:**
   * 
   * * "": Applies all restrictions below
   * * `'allow-same-origin'`: Allows the iframe content to be treated as being
   *   from the same origin as the containing document
   * * `'allow-top-navigation'`: Allows the iframe content to navigate (load)
   *   content from the containing document
   * * `'allow-forms'`: Allows form submission
   * * `'allow-scripts'`: Allows script execution
   * 
   * **Notes:**
   * 
   * * The sandbox attribute is not supported in IE 9 and earlier versions, or 
   *   in Opera 12 and earlier versions.
   * * The sandbox attribute is new in HTML5.
   *
   * @param  string $sandbox the value of the sandbox attribute
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/TAGS/att_iframe_sandbox.asp sandbox attribute
   */
  public function setSandbox(string $sandbox) {
    return $this->setAttribute('sandbox', $sandbox);
  }

  /**
   * Returns the value of the sandbox attribute (a set of extra restrictions for
   * the content in the object)
   *
   * **Values:**
   * 
   * * "": Applies all restrictions below
   * * `'allow-same-origin'`: Allows the iframe content to be treated as being
   *   from the same origin as the containing document
   * * `'allow-top-navigation'`: Allows the iframe content to navigate (load)
   *   content from the containing document
   * * `'allow-forms'`: Allows form submission
   * * `'allow-scripts'`: Allows script execution
   * 
   * **Notes:**
   * 
   * * The sandbox attribute is not supported in IE 9 and earlier versions, or 
   *   in Opera 12 and earlier versions.
   * * The sandbox attribute is new in HTML5.
   * 
   * @return string the value of the sandbox attribute
   * @link   https://www.w3schools.com/TAGS/att_iframe_sandbox.asp sandbox attribute
   */
  public function getSandbox(): string {
    return (string) $this->getAttribute('sandbox');
  }

  /**
   * 
   * @param bool $allow
   * @return $this
   */
  public function allowFullScreen(bool $allow) {
    $this->attributes()->setAttribute('allowfullscreen', $allow);
    return $this;
  }

}
