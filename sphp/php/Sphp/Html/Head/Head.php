<?php

/**
 * Head.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Head;

use Sphp\Html\NonVisualContent;
use Sphp\Html\AbstractComponent;
use Sphp\Html\Container;
use Sphp\Html\Programming\ScriptsContainer;
use Sphp\Html\Programming\Script;

/**
 * Implements an HTML &lt;head&gt; tag
 *
 * The &lt;head&gt; tag is a container for all the head elements.
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_head.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Head extends AbstractComponent implements NonVisualContent {

  /**
   * @var Title 
   */
  private $title;

  /**
   * @var Base|null 
   */
  private $base;

  /**
   * @var ScriptsContainer 
   */
  private $scripts;

  /**
   * @var Container 
   */
  private $links;

  /**
   * @var MetaContainer 
   */
  private $meta;

  /**
   * Constructs a new instance
   *
   * @param string $title the title of the HTML document
   * @param string $charset the character set of the HTML document
   */
  public function __construct(string $title = null, string $charset = 'UTF-8') {
    parent::__construct('head');
    $this->setup($title, $charset);
  }

  /**
   * Builds the initial setup
   *
   * @param  string $title the title of the HTML document
   * @param  string $charset the character set of the HTML document
   * @return $this for a fluent interface
   */
  private function setup($title, $charset) {
    $this->setDocumentTitle($title);
    $this->meta = new MetaContainer();
    $this->scripts = new ScriptsContainer();
    $this->links = new Container();
    $this->addMeta(Meta::charset($charset));
    return $this;
  }

  /**
   * Returns and optionally sets the inner script container
   * 
   * @param  ScriptsContainer|null $c optional new script container to set
   * @return ScriptsContainer the script container
   */
  public function scripts(ScriptsContainer $c = null): ScriptsContainer {
    if ($c !== null) {
      $this->scripts = new ScriptsContainer();
    }
    return $this->scripts;
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
    $this->title = $title;
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
      $this->base = new Base($baseAddr, $target);
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
    $this->addCssSrc('https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css');
    return $this;
  }

  /**
   * Appends a script component pointing to the given `src`
   *
   * @param  string $src the file path of the script file
   * @param  boolean $async true for asynchronous execution, false otherwise
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_script_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_script_async.asp async attribute
   */
  public function appendScriptSrc(string $src, bool $async = false) {
    $this->scripts()->appendSrc($src, $async);
    return $this;
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
  public function addCssSrc($href, $media = 'screen') {
    $this->links->append((new Link($href, 'stylesheet', $media))->setType('text/css'));
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
  public function addShortcutIcon(string $href, string $type = 'image/x-icon') {
    $this->add(Link::shortcutIcon($href, $type));
    return $this;
  }

  /**
   * Adds content component to the object
   *
   * @param  HeadContent $component content the component to add
   * @return $this for a fluent interface
   */
  public function add(HeadContent $component) {
    if ($component instanceof Title) {
      $this->setDocumentTitle($component);
    } else if ($component instanceof Base) {
      $this->base = $component;
    } else if ($component instanceof Link) {
      $this->links->append($component);
    } else if ($component instanceof Meta) {
      $this->addMeta($component);
    } else if ($component instanceof Script) {
      $this->scripts()->append($component);
    } else {
      $this->content()->append($component);
    }
    return $this;
  }

  /**
   * Returns the &lt;meta&gt; component container
   *
   * @return MetaContainer the &lt;meta&gt; component container
   */
  public function metaTags(): MetaContainer {
    return $this->meta;
  }

  /**
   * Adds meta data object
   *
   * @param  MetaData $meta
   * @return $this for a fluent interface
   */
  public function addMeta(MetaData $meta) {
    $this->meta->addMeta($meta);
    return $this;
  }

  public function contentToString(): string {
    return $this->meta . $this->title . $this->base . $this->links . $this->scripts;
  }

}
