<?php

/**
 * Iframe.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

use Sphp\Html\AbstractComponent;

/**
 * Class Models an HTML &lt;iframe&gt; tag (an inline frame).
 *
 * The {@link self} component represents a nested browsing context.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-07-14
 * @link    http://www.w3schools.com/tags/tag_iframe.asp w3schools HTML API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-iframe-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Iframe extends AbstractComponent implements IframeInterface {

  use LazyLoaderTrait,
      SizeableTrait;

  /**
   * Constructs a new instance
   *
   * @param  string $src the address of the document to embed in the object
   * @param  string $name the value of the name attribute
   * @link   http://www.w3schools.com/TAGS/att_iframe_src.asp src attribute
   */
  public function __construct($src = null, $name = null) {
    parent::__construct('iframe');
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
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_iframe_name.asp name attribute
   */
  public function setName($name) {
    $this->attrs()->set('name', $name);
    return $this;
  }

  /**
   * Returns the value of the name attribute
   *
   * @return string name attribute
   * @link   http://www.w3schools.com/tags/att_iframe_name.asp name attribute
   */
  public function getName() {
    return $this->attrs()->get('name');
  }

  /**
   * Sets the value of the seamless attribute (If set as true the object looks
   *  like it is a part of the containing document)
   *
   * **Note:** Limited browser support.
   *
   * @param  string $seamless the value of the seamless attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function setSeamless($seamless = true) {
    return $this->setAttr('seamless', $seamless);
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
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/TAGS/att_iframe_sandbox.asp sandbox attribute
   */
  public function setSandbox($sandbox) {
    return $this->setAttr('sandbox', $sandbox);
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
  public function getSandbox() {
    return $this->getAttr('sandbox');
  }

  public function contentToString() {
    return '<p>Your browser does not support iframes.</p>';
  }

}
