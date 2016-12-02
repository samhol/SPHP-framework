<?php

/**
 * MetaTagContainer.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Head;

use IteratorAggregate;
use Sphp\Html\Container;
use Sphp\Html\TraversableInterface;

/**
 * Class is a container for a {@link Meta} component group
 *
 *  The &lt;meta&gt; tag provides metadata about the HTML document. Metadata will not be displayed on the page,
 *  but will be machine parsable. Meta elements are typically used to specify page description, keywords, author
 *  of the document, last modified, and other metadata. The metadata can be used by browsers (how to display
 *  content or reload page), search engines (keywords), or other web services.
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-02-03
 * @link    http://www.w3schools.com/tags/tag_meta.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MetaContainer implements IteratorAggregate, TraversableInterface {

  use \Sphp\Html\ContentTrait,
      \Sphp\Html\TraversableTrait;

  /**
   * the inner container for the {@link Meta} components
   *
   * @var Container
   */
  private $metaTags;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    $this->metaTags = new Container();
  }

  /**
   * Adds a new {@link MetaInterface} component to the container
   *
   * @param  MetaInterface $content meta information to add
   * @return self for PHP Method Chaining
   */
  public function addMeta(MetaInterface $content) {
    $key = [];
    if ($content->attrExists('charset')) {
      $key[] = 'charset';
    } if ($content->hasNamedContent()) {
      $key[] = "name-" . $content->getName();
    } if ($content->hasHttpEquivContent()) {
      $key[] = "http-equiv-" . $content->getHttpEquiv();
    } if ($content->hasPropertyContent()) {
      $key[] = "property-" . $content->getProperty();
    }
    $k = implode("-", $key);
    $this->metaTags[$k] = $content;
    return $this;
  }

  /**
   * Sets a {@link MetaInterface} component for charset attribute (The character 
   *  encoding for the HTML document).
   *
   * **Common values:**
   *  
   * * UTF-8  - Character encoding for Unicode
   * * ISO-8859-1 - Character encoding for the Latin alphabet
   * 
   * In theory, any character encoding can be used, but no browser understands 
   * all of them. The more widely a character encoding is used, the better the 
   * chance that a browser will understand it.
   *
   * @param  string $charset the character encoding for the HTML document
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_meta_charset.asp charset attribute for HTML5
   * @link   http://www.iana.org/assignments/character-sets/character-sets.xml  IANA character sets
   */
  public function setCharset($charset = 'UTF-8') {
    $metaTag = new Meta();
    $metaTag->setAttr('charset', $charset);
    $this->addMeta($metaTag);
    return $this;
  }

  /**
   * Sets (replaces) a {@link MetaInterface} component including name attribute and 
   *  the corresponding content attribute
   *
   * * The name attribute specifies the name for the metadata.
   * * The name attribute specifies a name for the information/value of the content attribute.
   * * **Note:** If the http-equiv attribute is set, the name attribute should not be set.
   * 
   * @param  string $name specifies a name for the metadata
   * @param  string $content the content attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setNamedContent($name, $content) {
    return $this->addMeta(
                    (new Meta())->setNamedContent($name, $content));
  }

  /**
   * Sets (replaces) a {@link MetaInterface} component including http-equiv 
   *  attribute and the corresponding content attribute
   *
   * * The http-equiv attribute provides an HTTP header for the information/value of the content attribute.
   * * The http-equiv attribute can be used to simulate an HTTP response header
   * * **Note:** If the name attribute is set, the http-equiv attribute should not be set.
   * 
   * @param  string $http_equiv provides an HTTP header for the information/value of the content attribute
   * @param  string $content the content attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_meta_http_equiv.asp http-equiv attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setHttpEquivContent($http_equiv, $content) {
    return $this->addMeta(
                    (new Meta())->setHttpEquivContent($http_equiv, $content));
  }

  /**
   * Sets (replaces) a {@link MetaInterface} component including a property 
   *  attribute the corresponding content attribute
   *
   * The Open Graph protocol enables any web page to become a rich object in 
   * a social graph. For instance, this is used on Facebook to allow any web 
   * page to have the same functionality as any other object on Facebook.
   *
   * @param  string $property the property attribute
   * @param  string $content the content attribute
   * @return self for PHP Method Chaining
   * @link   http://ogp.me/ The Open Graph protocol
   * @link   https://developers.facebook.com/docs/concepts/opengraph/ Open Graph Concepts (Facebook)
   * @link   http://en.wikipedia.org/wiki/RDFa RDFa (Wikipedia)
   * @link   http://www.w3.org/MarkUp/2004/02/xhtml-rdf.html XHTML and RDF (W3C)
   */
  public function setPropertyContent($property, $content) {
    return $this->addMeta(
                    (new Meta())->setPropertyContent($property, $content));
  }

  /**
   * Sets a {@link MetaInterface} component for a description of the web page
   *
   * @param  string $content the description of the web page
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setDescription($content) {
    return $this->setNamedContent('description', $content);
  }

  /**
   * Sets a {@link Meta} component for a list of keywords about the page
   *
   * @param  string $content a list of keywords
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setKeywords($content) {
    return $this->setNamedContent('keywords', $content);
  }

  /**
   * Sets a {@link Meta} component for the name of the author of the document
   *
   * @param  string $content the name of the author of the document
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setAuthor($content) {
    return $this->setNamedContent('author', $content);
  }

  /**
   * Sets a {@link Meta} component for the name of the Web application that
   *  the page represents
   *
   * @param  string $name the name of the Web application that the page represents
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setApplicationName($name) {
    return $this->setNamedContent('application-name', $name);
  }

  /**
   * Sets a {@link Meta} component for the preferred style sheet to use
   *
   * @param  string $id id of link element of the preferred style sheet to use
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_meta_http_equiv.asp http-equiv attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setDefaultStyle($id) {
    return $this->setHttpEquivContent('default-style', $id);
  }

  /**
   * Sets a {@link Meta} component for a time interval for the document to 
   * refresh itself
   *
   * **Note:**The value "refresh" should be used carefully, as it takes 
   *  the control of a page away from the user.
   *
   * @param  int $interval time interval for the document to refresh itself
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_meta_http_equiv.asp http-equiv attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setDocumentRefresh($interval) {
    return $this->setHttpEquivContent('refresh', $interval);
  }

  /**
   * Sets a {@link Meta} component for a viewport settings
   *
   * The meta viewport tag contains instructions to the browser in the matter
   * of viewports and zooming. In particular, it allows web developers to set
   * the width of the layout viewport relative to which CSS declarations
   * such as width: 20% are calculated.
   *
   * @param  string $viewport comma delimited values
   * @return self for PHP Method Chaining
   * @link   http://dev.w3.org/csswg/css-device-adapt/ W3C CSS Device Adaptation
   */
  public function setViewport($viewport) {
    return $this->setNamedContent('viewport', $viewport);
  }

  public function getHtml() {
    return $this->metaTags->getHtml();
  }

  public function getIterator() {
    return $this->metaTags->getIterator();
  }

  public function count() {
    $this->metaTags->count();
  }

}
