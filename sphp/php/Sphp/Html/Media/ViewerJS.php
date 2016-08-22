<?php

/**
 * ViewerJS.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

/**
 * Class Models an HTML &lt;iframe&gt; tag (an inline frame).
 *
 * The {@link self} component represents a nested browsing context.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-07-14
 * @link    http://www.w3schools.com/tags/tag_iframe.asp w3schools HTML API link
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-iframe-element W3C API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ViewerJS extends AbstractIframe {

  use LazyLoaderTrait;

  //private $src;

  /**
   * Constructs a new instance
   *
   * @param  string $src the address of the document to embed in the object
   * @param  string $name the value of the name attribute
   * @link   http://www.w3schools.com/TAGS/att_iframe_src.asp src attribute
   */
  public function __construct($src = null) {
    //$this->src = $src;
    parent::__construct();
    if ($src !== null) {
      $this->setSrc("sphp/viewerjs/#../../$src");
    }
  }

  /**
   * Sets or unsets the media source loading as lazy
   * 
   * **Important:** if the `$lazy = true` the actual media source path is stored into the  
   * `data-src` attribute instead of the `src` attribute
   * 
   * @param  boolean $lazy true if the loading is lazy, false otherwise
   * @return LazyLoaderInterface for PHP Method Chaining
   */
  public function setLazy($lazy = true) {
    $classes = "lazy-hidden lazy-loaded";
    if ($lazy && !$this->isLazy()) {
      $src = $this->getSrc();
      $this->setSrc(false);
      $this->attrs()->classes()->add($classes);
      $this->attrs()->set("data-src", $src);
    } else if ($this->isLazy()) {
      $this->attrs()->classes()->remove($classes);
      $this->setSrc($this->attrs()->get("data-src"));
      $this->attrs()->remove("data-src");
    }
    return $this;
  }

  /**
   * Checks whether the media source loading is lazy
   * 
   * @return boolean true if the loading is lazy, false otherwise
   */
  public function isLazy() {
    return $this->attrs()->exists("data-src") &&
            $this->attrs()->classes()->contains(["lazy-hidden", "lazy-loaded"]);
  }

  /**
   * Sets the path to the image source (The URL of the image file)
   * 
   * **Important:** if {@link LazyLoaderInterface::isLazy()} this method sets the value of the 
   * `data-src` attribute instead of the `src` attribute
   *
   * @param  string|URL $src the path to the image source (The URL of the image file)
   * @return LazyLoaderInterface for PHP Method Chaining
   */
  public function setSrc($src) {
    if ($src instanceof URL) {
      $src = $src->getHtml();
    }
    if ($this->isLazy()) {
      $this->attrs()->set("data-src", $src);
    } else {
      $this->attrs()->set("src", $src);
    }
    return $this;
  }

  /**
   * Returns the path to the image source (The URL of the image file)
   *
   * **Important:** if {@link LazyLoaderInterface::isLazy()} this method returns the value of the 
   * `data-src` attribute instead of the `src` attribute
   * 
   * @return string the path to the image source (The URL of the image file)
   */
  public function getSrc() {
    if ($this->isLazy()) {
      return $this->attrs()->get("data-src");
    } else {
      return $this->attrs()->get("src");
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
    $this->attrs()->set("name", $name);
    return $this;
  }

  /**
   * Returns the value of the name attribute
   *
   * @return string name attribute
   * @link   http://www.w3schools.com/tags/att_iframe_name.asp name attribute
   */
  public function getName() {
    return $this->attrs()->get("name");
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
    return $this->setAttr("seamless", $seamless);
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
    return $this->setAttr("sandbox", $sandbox);
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
    return $this->getAttr("sandbox");
  }

}
