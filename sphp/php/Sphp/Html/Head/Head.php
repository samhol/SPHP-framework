<?php

/**
 * Head.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Head;

use Sphp\Html\NonVisualContentInterface;
use Sphp\Html\AbstractComponent;
use Sphp\Stdlib\Path;
use Sphp\Html\Container;
use Sphp\Stdlib\Strings;
use Sphp\Html\Programming\ScriptsContainer;
use Sphp\Html\Programming\ScriptInterface;
use Sphp\Stdlib\URL;

/**
 * Implements an HTML &lt;head&gt; tag
 *
 * The &lt;head&gt; tag is a container for all the head elements.
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2013-02-03
 * @link    http://www.w3schools.com/tags/tag_head.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Head extends AbstractComponent implements NonVisualContentInterface {

  /**
   *
   * @var Title 
   */
  private $title;

  /**
   *
   * @var Base|null 
   */
  private $base;

  /**
   *
   * @var ScriptsContainer 
   */
  private $scripts;

  /**
   *
   * @var Container 
   */
  private $links;

  /**
   *
   * @var MetaContainer 
   */
  private $meta;

  /**
   * Constructs a new instance
   *
   * @param string $title the title of the HTML document
   * @param string $charset the character set of the HTML document
   */
  public function __construct($title = '', $charset = 'UTF-8') {
    parent::__construct('head');
    $this->setup($title, $charset);
  }

  /**
   * Builds the initial setup
   *
   * @param  string $title the title of the HTML document
   * @param  string $charset the character set of the HTML document
   * @return self for a fluent interface
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
  public function scripts(ScriptsContainer $c = null) {
    if ($c !== null) {
      $this->scripts = new ScriptsContainer();
    }
    return $this->scripts;
  }

  /**
   * Sets the title of the html page
   *
   * @param  string|Title $title the title of the html page
   * @return self for a fluent interface
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
   * @param  string|URL $baseAddr the base URL for all relative URLs in the page
   * @param  string $target the default target for all hyperlinks and forms in the page
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/tag_base.asp  w3schools HTML API link
   */
  public function setBaseAddr($baseAddr, $target = '_self') {
    if (!Strings::isEmpty($baseAddr) && !Strings::isEmpty($target)) {
      $this->base = new Base($baseAddr, $target);
    } else {
      $this->unsetBaseAddress();
    }
    return $this;
  }

  /**
   * unsets the default URL and a default target for all links on a page
   *
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/tag_base.asp  w3schools HTML API link
   */
  public function unsetBaseAddress() {
    $this->base = null;
    return $this;
  }

  /**
   * Sets up the Font Awesome icons
   *
   * @return self for a fluent interface
   * @link   http://fontawesome.io/icons/?utm_source=www.qipaotu.com Font Awesome icons
   */
  public function useFontAwesome() {
    return $this->addCssSrc('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
  }

  /**
   * Sets up the Foundation icons
   *
   * @return self for a fluent interface
   * @link   http://zurb.com/playground/foundation-icon-fonts-3 Foundation icons
   */
  public function useFoundationIcons() {
    $this->addCssSrc('https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css');
    return $this;
  }

  /**
   * Sets up the Foundation framework related CSS files and meta data
   *
   * @return self for a fluent interface
   */
  public function enableSPHP() {
    $this->addMeta(Meta::viewport('width=device-width, initial-scale=1.0'))
            ->addMeta(Meta::charset('UTF-8'));
    $this->addCssSrc(Path::get()->http() . 'sphp/css/sphp.all.css')
            ->addCssSrc('https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css')
            ->useVideoJS();
    return $this;
  }

  /**
   * Appends JavaScript files for Video.js
   *
   * @return self for a fluent interface
   * @link   http://www.videojs.com/ Video.js
   */
  public function useVideoJS() {
    $this->addCssSrc('http://vjs.zencdn.net/5.18.4/video-js.css')
            ->appendScriptSrc('http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js');
    return $this;
  }

  /**
   * Appends an {@link \Sphp\Html\Programming\ScriptSrc} pointing to the given `src`
   *
   * @param  string $src the file path of the script file
   * @param  boolean $async true for asynchronous execution, false otherwise
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_script_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_script_async.asp async attribute
   */
  public function appendScriptSrc($src, $async = false) {
    $this->scripts()->appendSrc($src, $async);
    return $this;
  }

  /**
   * Adds an link tag which points to a CSS stylesheet file to the object
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @param  string $media the relationship between the current document and the linked one
   * @param  string $media what media/device the target resource is optimized for
   * @return self for a fluent interface
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
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_link_type.asp type attribute
   * @link   http://www.iana.org/assignments/media-types complete list of standard MIME types
   */
  public function addShortcutIcon($href, $type = 'image/x-icon') {
    $this->addContent(Link::shortcutIcon($href, $type));
    return $this;
  }

  /**
   * Adds content component to the object
   *
   * @param  HeadComponentInterface $component content the component to add
   * @return self for a fluent interface
   */
  public function addContent(HeadComponentInterface $component) {
    if ($component instanceof Title) {
      $this->setDocumentTitle($component);
    } else if ($component instanceof Base) {
      $this->base = $component;
    } else if ($component instanceof Link) {
      $this->links->append($component);
    } else if ($component instanceof Meta) {
      $this->addMeta($component);
    } else if ($component instanceof ScriptInterface) {
      $this->scripts()->append($component);
    } else {
      $this->content()->append($component);
    }
    return $this;
  }

  /**
   * Returns the container of all the existing {@link Meta} components
   *
   * @return MetaContainer containing all {@link Meta} components
   */
  public function metaTags() {
    return $this->meta;
  }

  /**
   * Adds meta data object
   *
   * @param  MetaInterface $meta
   * @return self for a fluent interface
   */
  public function addMeta(MetaInterface $meta) {
    $this->meta->addMeta($meta);
    return $this;
  }

  public function contentToString() {
    return $this->title . $this->base . $this->meta . $this->links . $this->scripts;
  }

}
