<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Html\AbstractComponent;
use Sphp\Html\ContentIteratorAggregate;
use Sphp\Html\ContentIterator;
use Sphp\Html\Head\Links\ImmutableLinkData;
use Sphp\Html\Utils\Mime;

/**
 * Implementation of an HTML head tag
 *
 * The &lt;head&gt; tag is a container for all the head elements.
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_head.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Head extends AbstractComponent implements ContentIteratorAggregate {

  private MetaContainer $content;

  /**
   * Constructor
   *
   * @param string|null $title the title of the HTML document
   * @param string|null $charset the character set of the HTML document
   */
  public function __construct(?string $title = null, ?string $charset = null) {
    parent::__construct('head');
    $this->content = new MetaContainer();
    if ($title !== null) {
      $this->meta()->setTitle($title);
    }
    if ($charset !== null) {
      $this->meta()->insert(MetaFactory::build()->charset($charset));
    }
  }

  /**
   * Returns the meta content container
   * 
   * @return MetaContainer
   */
  public function meta(): MetaContainer {
    return $this->content;
  }

  /**
   * Sets the title of the HTML page
   *
   * @param  string $title 
   * @return Title
   */
  public function setTitle(string $title): Title {
    $obj = new Title($title);
    $this->meta()->insert($obj);
    return $obj;
  }

  /**
   * Sets the base address of the HTML page
   * 
   * @param  string $href
   * @param  string $target
   * @return Base
   */
  public function setBaseAddress(string $href, string $target = null, int $priority = 0): Base {
    $obj = new Base($href, $target);
    $this->container->insert($obj->getHash(), $obj, $priority);
    return $obj;
  }

  /**
   * Sets a meta data object
   *
   * @param  string $path 
   * @return ExternalScript
   */
  public function setScriptSrc(string $path): ExternalScript {
    $component = new ExternalScript($path);
    $this->meta()->insert($component);
    return $component;
  }

  /**
   * Creates a property meta data object attribute the corresponding content
   *
   * The Open Graph protocol enables any web page to become a rich object in 
   * a social graph. For instance, this is used on Facebook to allow any web 
   * page to have the same functionality as any other object on Facebook.
   *
   * @param  string $property the property attribute
   * @param  string $content the content attribute
   * @return ImmutableMeta new meta data object
   * @link   http://ogp.me/ The Open Graph protocol
   * @link   https://developers.facebook.com/docs/concepts/opengraph/ Open Graph Concepts (Facebook)
   * @link   http://en.wikipedia.org/wiki/RDFa RDFa (Wikipedia)
   * @link   https://www.w3.org/MarkUp/2004/02/xhtml-rdf.html XHTML and RDF (W3C)
   */
  public function setProperty(string $property, string $content): ImmutableMeta {
    $component = new ImmutableMeta(['property' => $property, 'content' => $content]);
    $this->meta()->insert($component);
    return $component;
  }

  /**
   * Creates a character encoding meta data object
   *
   * In theory, any character encoding can be used, but no browser understands 
   * all of them. The more widely a character encoding is used, the better the 
   * chance that a browser will understand it.
   * 
   * Common <var>$charset</var> values:
   *  
   * * `UTF-8` - Character encoding for Unicode
   * * `ISO-8859-1` - Character encoding for the Latin alphabet
   *
   * @param  string $charset specifies the character encoding for the HTML document
   * @return ImmutableMeta new meta data object
   * @link   https://www.w3schools.com/tags/att_meta_charset.asp charset attribute
   */
  public function setCharset(string $charset): ImmutableMeta {
    $component = new ImmutableMeta(['charset' => $charset]);
    $this->meta()->insert($component);
    return $component;
  }

  /**
   * Creates a named content meta data object
   *
   * **Notes:**
   * 
   * * The name attribute specifies the name for the metadata.
   * * The name attribute specifies a name for the information/value of the content attribute.
   * * **Note:** If the `http-equiv` attribute is set, the name attribute should not be set.
   * 
   * @param  string $name specifies a name for the metadata
   * @param  string|array $content the value of the content attribute
   * @return ImmutableMeta new meta data object
   * @link   https://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   https://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function insertNamedContent(string $name, $content): ImmutableMeta {
    if ($name === 'keywords') {
      $component = $this->keywords($content);
    } else {
      $component = new ImmutableMeta(['name' => $name, 'content' => $content]);
    }
    $this->meta()->insert($component);
    return $component;
  }

  /**
   * Creates a meta component to simulate an HTTP response header
   *
   * **Notes:**
   * 
   * * The `http-equiv` attribute provides an HTTP header for the information/value of the content attribute.
   * * The `http-equiv` attribute can be used to simulate an HTTP response header
   * * **Note:** If the name attribute is set, the `http-equiv` attribute should not be set.
   * 
   *
   * @param  string $http_equiv provides an HTTP header for the information/value of the content attribute
   * @param  scalar $content the value of the content attribute
   * @return ImmutableMeta new meta data object
   * @link   https://www.w3schools.com/tags/att_meta_http_equiv.asp http-equiv attribute
   * @link   https://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function insertHttpEquiv(string $http_equiv, $content): ImmutableMeta {
    $component = new ImmutableMeta(['http-equiv' => $http_equiv, 'content' => $content]);
    $this->meta()->insert($component);
    return $component;
  }

  /**
   * Creates a meta component for web page description
   *
   * @param  string $content the description of the web page
   * @return ImmutableMeta new meta data object
   * @link   https://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   https://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setDescription(string $content): ImmutableMeta {
    return $this->insertNamedContent('description', $content);
  }

  /**
   * Creates a meta component containing information about the author
   *
   * @param  string $author the name of the author of the document
   * @return ImmutableMeta new meta data object
   * @link   https://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   https://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setAuthor(string $author): ImmutableMeta {
    return $this->insertNamedContent('author', $author);
  }

  /**
   * Creates a meta component for viewport settings
   *
   * The meta viewport tag contains instructions to the browser in the matter
   * of viewports and zooming. In particular, it allows web developers to set
   * the width of the layout viewport relative to which CSS declarations
   * such as width: 20% are calculated.
   *
   * @param  string $viewport comma delimited values
   * @return ImmutableMeta new meta data object
   * @link   http://dev.w3.org/csswg/css-device-adapt/ W3C CSS Device Adaptation
   */
  public function setViewport(string $viewport = 'width=device-width, initial-scale=1.0'): ImmutableMeta {
    return $this->insertNamedContent('viewport', $viewport);
  }

  /**
   * Creates a meta component for the name of the Web application
   *
   * @param  string $name the name of the Web application that the page represents
   * @return ImmutableMeta new meta data object
   * @link   https://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   https://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setApplicationName(string $name): ImmutableMeta {
    return $this->insertNamedContent('application-name', $name);
  }

  /**
   * Creates a meta component for a list of keywords about the page
   *
   * Specifies a comma-separated list of keywords - relevant to the page 
   * (Informs search engines what the page is about).
   * 
   * @param  string ...$keywords a list of keywords
   * @return ImmutableMeta new meta data object
   * @link   https://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   https://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setKeywords(string ...$keywords): ImmutableMeta {
    $keywords = implode(',', $keywords);
    return new ImmutableMeta(['name' => 'keywords', 'content' => $keywords]);
  }

  /**
   * Creates a meta component for the preferred style sheet to use
   *
   * @param  string $id id of link element of the preferred style sheet to use
   * @return ImmutableMeta new meta data object
   * @link   https://www.w3schools.com/tags/att_meta_http_equiv.asp http-equiv attribute
   * @link   https://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setDefaultStyle(string $id): ImmutableMeta {
    return $this->insertHttpEquiv('default-style', $id);
  }

  /**
   * Creates a meta component for a time interval for the document to 
   * refresh itself
   *
   * **Note:**This should be used carefully, as it takes the control of a page 
   * away from the user.
   *
   * @param  int $interval time interval for the document to refresh itself
   * @return ImmutableMeta new meta data object
   * @link   https://www.w3schools.com/tags/att_meta_http_equiv.asp http-equiv attribute
   * @link   https://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setRefresh(int $interval): ImmutableMeta {
    return $this->insertHttpEquiv('refresh', (string) $interval);
  }

  /**
   * Creates an link which points to a CSS style sheet file to the object
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @param  string|null $media what media/device the target resource is optimized for
   * @return ImmutableLinkData new object
   * @link   https://www.w3schools.com/tags/att_link_href.asp href attribute
   * @link   https://www.w3schools.com/tags/att_link_media.asp media attribute
   */
  public function insertStylesheet(string $href, ?string $media = null): ImmutableLinkData {
    $type = Mime::getMime($href);
    $link = new ImmutableLinkData(['rel' => 'stylesheet', 'href' => $href, 'media' => $media, 'type' => $type]);
    $this->meta()->insert($link);
    return $link;
  }

  /**
   * Creates a shortcut icon to the object
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @param  string|null $sizes specifies the sizes of icons for visual media
   * @return ImmutableLinkData new object
   * @link   https://www.w3schools.com/tags/att_link_href.asp href attribute
   */
  public function setIcon(string $href, ?string $sizes = null): ImmutableLinkData {
    $type = Mime::getMime($href);
    $link = new ImmutableLinkData(['rel' => 'icon', 'href' => $href, 'sizes' => $sizes, 'type' => $type]);
    $this->meta()->insert($link);
    return $link;
  }

  /**
   * Creates a shortcut icon to the object
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @param  string|null $sizes specifies the sizes of icons for visual media
   * @return ImmutableLinkData new object
   * @link   https://www.w3schools.com/tags/att_link_href.asp href attribute
   */
  public function setAppleTouchIcon(string $href, ?string $sizes = null): ImmutableLinkData {
    $type = Mime::getMime($href);
    $link = new ImmutableLinkData([
        'rel' => 'apple-touch-icon',
        'href' => $href,
        'sizes' => $sizes,
        'type' => $type]);
    $this->meta()->insert($link);
    return $link;
  }

  /**
   * Creates a shortcut icon to the object
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @return ImmutableLinkData new object
   * @link   https://www.w3schools.com/tags/att_link_href.asp href attribute
   */
  public function setManifest(string $href): ImmutableLinkData {
    $link = new ImmutableLinkData(['rel' => 'manifest', 'href' => $href]);
    $this->meta()->insert($link);
    return $link;
  }

  /**
   * Creates a shortcut icon to the object
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @param  string|null $color specifies the sizes of icons for visual media
   * @return ImmutableLinkData new object
   * @link   https://www.w3schools.com/tags/att_link_href.asp href attribute
   */
  public function setMaskIcon(string $href, ?string $color = null): ImmutableLinkData {
    $link = new ImmutableLinkData(['rel' => 'mask-icon', 'href' => $href, 'color' => $color]);
    $this->meta()->insert($link);
    return $link;
  }

  /**
   * Creates a link to a preloaded source
   * 
   * @param  string $href an URL
   * @param  string $crossorigin
   * @return ImmutableLinkData new object
   * @link   https://www.w3schools.com/tags/att_link_href.asp href attribute
   */
  public function insertPreload(string $href, string $crossorigin = 'anonymous'): ImmutableLinkData {
    $type = Mime::getMime($href);
    $params = ['rel' => 'preload', 'href' => $href, 'crossorigin' => $crossorigin];
    $params['type'] = $type;
    $as = Mime::getContentType($href);
    $params['as'] = $as;
    $link = new ImmutableLinkData($params);
    $this->meta()->insert($link);
    return new ImmutableLinkData($params);
  }

  public function contentToString(): string {
    return $this->content->getHtml();
  }

  public function getIterator(): ContentIterator {
    return $this->content->getIterator();
  }

}
