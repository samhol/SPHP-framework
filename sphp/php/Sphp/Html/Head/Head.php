<?php

/**
 * Head.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Head;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Core\Configuration as Configuration;
use Sphp\Html\Container as Container;
use Sphp\Util\Strings as Strings;
use Sphp\Html\Programming\ScriptsContainer as ScriptsContainer;
use Sphp\Html\Programming\ScriptInterface as ScriptInterface;

/**
 * Class models an HTML &lt;head&gt; tag
 *
 * The &lt;head&gt; tag is a container for all the head elements.
 *
 *
 * {@inheritdoc}
 *
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2013-02-03
 * @version 1.3.1
 * @link    http://www.w3schools.com/tags/tag_head.asp w3schools HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Head extends AbstractComponent {

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "head";

  /**
   * Constructs a new instance
   *
   * @param string $title the title of the HTML document
   * @param string $charset the character set of the HTML document
   * @param string $baseAddr the base address of the HTML document
   */
  public function __construct($title = "", $charset = "UTF-8", $baseAddr = "") {
    parent::__construct(self::TAG_NAME);
    $this->setup($title, $charset, $baseAddr);
  }

  /**
   * Builds the initial setup
   *
   * @param  string $title the title of the HTML document
   * @param  string $charset the character set of the HTML document
   * @param  string $baseAddr the base address of the HTML document
   * @return self for PHP Method Chaining
   */
  private function setup($title, $charset, $baseAddr) {
    $this->setTitle($title)
            ->setBaseAddr($baseAddr);
    //$this->metaTags = new MetaTagContainer();
    $this->content()["meta"] = new MetaContainer();
    $this->metaTags()->setCharset($charset);
    //$this->linkTags = ;
    $this->content()["links"] = new Container();
    //$this->scriptFiles = new ScriptsContainer();
    $this->scripts(new ScriptsContainer());
    $this->content()["scripts"] = new ScriptsContainer();
    //$this->content()["scriptFiles"] = $this->scriptFiles;
    //$this->scriptCode = new Script();
    //$this->content()["scriptCode"] = $this->scriptCode;
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
      $this->content()["scripts"] = new ScriptsContainer();
    }
    return $this->content()["scripts"];
  }

  /**
   * Sets the title of the html page
   *
   * @param  string|Title $title
   * @return self for PHP Method Chaining
   */
  public function setTitle($title) {
    if (!($title instanceof Title)) {
      $title = new Title($title);
    }
    $this->content()["title"] = $title;
    return $this;
  }

  /**
   * Sets a default URL and a default target for all links on a page
   *
   * @param  string|Url $baseAddr the base URL for all relative URLs in the page
   * @param  string $target the default target for all hyperlinks and forms in the page
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/tag_base.asp  w3schools HTML API link
   */
  public function setBaseAddr($baseAddr, $target = "_self") {
    if (Strings::notEmpty($baseAddr) || Strings::notEmpty($target)) {
      $this->content()["baseAddr"] = new Base($baseAddr, $target);
    } else if (isset($this->content()["baseAddr"])) {
      $this->content()->offsetUnset("baseAddr");
    }
    return $this;
  }

  /**
   * Sets up the Font Awesome icons
   *
   * @return self for PHP Method Chaining
   * @link   http://fontawesome.io/icons/?utm_source=www.qipaotu.com Font Awesome icons
   */
  public function useFontAwesome() {
    return $this->addCssSrc("https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css");
  }

  /**
   * Sets up the Foundation icons
   *
   * @return self for PHP Method Chaining
   * @link   http://zurb.com/playground/foundation-icon-fonts-3 Foundation icons
   */
  public function useFoundationIcons() {
    return $this->addCssSrc("https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css");
  }
  

  /**
   * Sets up the Foundation framework related Javascript and CSS files
   *
   * @return self for PHP Method Chaining
   */
  public function enableSPHP() {
    $this->metaTags()->setViewport("width=device-width, initial-scale=1.0");
    $this->metaTags()->setCharset("UTF-8");
    $this->addCssSrc(Configuration::httpHost() . "sphp/css/sphp6.styles.all.css");
    return $this;
  }

  /**
   * Appends an {@link \Sphp\Html\Programming\ScriptSrc} pointing to the given `src`
   *
   * @param  string $src the file path of the script file
   * @param  boolean $async true for asynchronous execution, false otherwise
   * @return self for PHP Method Chaining
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
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_link_media.asp media attribute
   */
  public function addCssSrc($href, $media = "screen") {
    $this->content()["links"][] = (new Link($href, "stylesheet", $media))
            ->setType("text/css");
    return $this;
  }

  /**
   * Adds a shortcut icon to the object
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @param  string $type the MIME type of the linked document
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_link_type.asp type attribute
   * @link   http://www.iana.org/assignments/media-types complete list of standard MIME types
   */
  public function addShortcutIcon($href, $type = "image/ico") {
    $link = new Link($href, "shortcut icon");
    $link->setType($type);
    $this->addContent($link);
    return $this;
  }

  /**
   * Adds content component to the object
   *
   * @param  MetaDataInterface $component content the component to add
   * @return self for PHP Method Chaining
   */
  public function addContent(MetaDataInterface $component) {
    if ($component instanceof Title) {
      $this->setTitle($component);
    } else if ($component instanceof StyleTag) {
      $this->style[] = $component;
    } else if ($component instanceof BaseTag) {
      $this->content()->set("baseAddr", $component);
    } else if ($component instanceof Link) {
      $this->content()["links"][] = $component;
    } else if ($component instanceof Meta) {
      $this->metaTags()->addMetaTag($component);
    } else if ($component instanceof ScriptInterface) {
      $this->scripts()->append($component);
    }
    return $this;
  }

  /**
   * Returns the container of all the existing {@link Meta} components
   *
   * @return MetaContainer containing all {@link Meta} components
   */
  public function metaTags() {
    return $this->content()->get("meta");
  }

}
