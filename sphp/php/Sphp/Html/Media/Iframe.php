<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media;

use Sphp\Html\EmptyTag;

/**
 * Implements an HTML &lt;iframe&gt; tag (an inline frame)
 *
 * This component represents a nested browsing context.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_iframe.asp w3schools HTML API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-iframe-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Iframe extends EmptyTag implements Embeddable, LazyMedia, SizeableMedia {

  use LazyMediaSourceTrait,
      SizeableMediaTrait;

  /**
   * Constructor
   *
   * @param  string $src the address of the document to embed in the object
   * @param  string $name the name for the component
   * @link   http://www.w3schools.com/tags/att_iframe_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_iframe_name.asp name attribute
   */
  public function __construct(string $src = null, string $name = null) {
    parent::__construct('iframe', true);
    if ($src !== null) {
      $this->setSrc($src);
    }
    if ($name !== null) {
      $this->setName($name);
    }
  }

  /**
   * Sets the value of the name attribute
   *
   * @param  string $name the value of the name attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_iframe_name.asp name attribute
   */
  public function setName(string $name) {
    $this->attributes()->setAttribute('name', $name);
    return $this;
  }

  /**
   * Returns the value of the name attribute
   *
   * @return string name attribute
   * @link   http://www.w3schools.com/tags/att_iframe_name.asp name attribute
   */
  public function getName(): string {
    return (string) $this->attributes()->getValue('name');
  }

  /**
   * Sets the value of the seamless attribute (If set as true the object looks
   *  like it is a part of the containing document)
   *
   * **Note:** Limited browser support.
   *
   * @param  string $seamless the value of the seamless attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function setSeamless(bool $seamless = true) {
    return $this->setAttribute('seamless', $seamless);
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
   * @link   http://www.w3schools.com/TAGS/att_iframe_sandbox.asp sandbox attribute
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
   * @link   http://www.w3schools.com/TAGS/att_iframe_sandbox.asp sandbox attribute
   */
  public function getSandbox(): string {
    return (string) $this->getAttribute('sandbox');
  }

}
