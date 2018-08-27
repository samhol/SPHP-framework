<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Html\NonVisualContent;
use Sphp\Html\AbstractComponent;
use Sphp\Html\PlainContainer;
use Sphp\Html\Programming\ScriptsContainer;
use Sphp\Html\Programming\Script;
use Sphp\Html\Programming\ScriptSrc;

/**
 * Implements an HTML &lt;head&gt; tag
 *
 * The &lt;head&gt; tag is a container for all the head elements.
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_head.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Head extends AbstractComponent implements NonVisualContent {

  private $content;

  /**
   * Constructor
   *
   * @param string $title the title of the HTML document
   * @param string $charset the character set of the HTML document
   */
  public function __construct(string $title = null, string $charset = null) {
    parent::__construct('head');
    $this->content = new HeadContentContainer();
    if ($title !== null) {
      $this->setDocumentTitle($title);
    }
    if ($charset !== null) {
      $this->set(Meta::charset($charset));
    }
  }

  /**
   * Sets the title of the HTML page
   *
   * @param  string|Title $title the title of the HTML page
   * @return $this for a fluent interface
   */
  public function setDocumentTitle($title) {
    if (!($title instanceof Title)) {
      $title = new Title($title);
    }
    $this->content->set($title);
    return $this;
  }

  /**
   * Sets a default URL and a default target for all links on a page
   *
   * @param  string $baseAddr the base URL for all relative URLs in the page
   * @param  string $target the default target for all hyperlinks and forms in the page
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/tag_base.asp  w3schools HTML API link
   */
  public function setBaseAddr(string $baseAddr, string $target = '_self') {
    if ($baseAddr !== null && $target !== null) {
      $this->content->set(new Base($baseAddr, $target));
    } else {
      $this->unsetBaseAddress();
    }
    return $this;
  }

  /**
   * Removes the default URL and a default target for all links on a page
   *
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/tag_base.asp  w3schools HTML API link
   */
  public function unsetBaseAddress() {
    $this->base = null;
    return $this;
  }

  /**
   * Sets up the Foundation icons
   *
   * @return $this for a fluent interface
   * @link   http://zurb.com/playground/foundation-icon-fonts-3 Foundation icons
   */
  public function useFoundationIcons() {
    $this->setCssSrc('https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css');
    return $this;
  }

  /**
   * Appends a script component pointing to the given `src`
   *
   * @param  string $src the file path of the script file
   * @param  boolean $async true for asynchronous execution, false otherwise
   * @return ScriptSrc appended code component
   * @link   http://www.w3schools.com/tags/att_script_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_script_async.asp async attribute
   */
  public function appendScriptSrc(string $src, bool $async = false): ScriptSrc {
    $script = new ScriptSrc($src, $async);
    $this->content->set($script);
    return $script;
  }

  /**
   * Adds an link tag which points to a CSS stylesheet file to the object
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @param  string $media the relationship between the current document and the linked one
   * @param  string $media what media/device the target resource is optimized for
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_link_media.asp media attribute
   */
  public function setCssSrc(string $href, string $media = 'screen') {
    $this->content->set(Link::stylesheet($href, $media));
    return $this;
  }

  /**
   * Adds a shortcut icon to the object
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @param  string $type the MIME type of the linked document
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_link_type.asp type attribute
   * @link   http://www.iana.org/assignments/media-types complete list of standard MIME types
   */
  public function setShortcutIcon(string $href, string $type = 'image/x-icon') {
    $this->content->set(Link::icon($href, $type));
    return $this;
  }

  /**
   * Adds content component to the object
   *
   * @param  HeadContent $component content the component to add
   * @return $this for a fluent interface
   */
  public function set(HeadContent $component) {
    $this->content->set($component);
    return $this;
  }

  public function contentToString(): string {
    return $this->content->getHtml();
  }

}
