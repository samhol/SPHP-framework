<?php

/**
 * Meta.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Head;

use Sphp\Html\EmptyTag;

/**
 * Class models an HTML &lt;meta&gt; tag
 *
 *  The &lt;meta&gt; tag provides metadata about the HTML document. Metadata will not be displayed on the page,
 *  but will be machine parsable. Meta elements are typically used to specify page description, keywords, author
 *  of the document, last modified, and other metadata. The metadata can be used by browsers (how to display
 *  content or reload page), search engines (keywords), or other web services.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-02-03
 * @link    http://www.w3schools.com/tags/tag_meta.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Meta extends EmptyTag implements MetaInterface {

  /**
   * Constructs a new instance
   * 
   * @param  string[] $attrs an array of attribute name value pairs
   */
  public function __construct(array $attrs = []) {
    parent::__construct('meta', $attrs);
  }

  /**
   * Sets the character encoding for the HTML document
   *
   * **Common <var>$charset</var> values:**
   *  
   * * UTF-8  - Character encoding for Unicode
   * * ISO-8859-1 - Character encoding for the Latin alphabet
   * 
   *
   * In theory, any character encoding can be used, but no browser understands 
   * all of them. The more widely a character encoding is used, the better the 
   * chance that a browser will understand it.
   *
   * @param  string $charset specifies the character encoding for the HTML document
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_meta_charset.asp charset attribute
   */
  public function setCharset($charset) {
    return $this->setAttr('charset', $charset);
  }

  /**
   * Sets the name attribute and the corresponding content attribute
   *
   * **Notes:**
   * 
   * * The name attribute specifies the name for the metadata.
   * * The name attribute specifies a name for the information/value of the content attribute.
   * * **Note:** If the http-equiv attribute is set, the name attribute should not be set.
   * 
   * @param  string $name specifies a name for the metadata
   * @param  string $content the value of the content attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setNamedContent($name, $content) {
    return $this->setAttr('name', $name)->setAttr('content', $content);
  }

  /**
   * Checks whether the name attribute exists or not
   *
   * @return boolean true if the name attribute exists, otherwise false
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   */
  public function hasNamedContent() {
    return $this->attrExists('name');
  }

  /**
   * Checks whether the name attribute has the given value or not
   *
   * @param  string $name the name value of the metadata
   * @return boolean true if the name attribute has the given value, otherwise false
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   */
  public function hasName($name) {
    return $this->hasNamedContent() && $this->getName() == $name;
  }

  /**
   * Returns the value of the name attribute
   *
   * @return string|null the value of the name attribute or null if the 
   *         attribute is not set
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   */
  public function getName() {
    return $this->getAttr('name');
  }

  /**
   * Sets the http-equiv attribute and the corresponding content attribute
   *
   * **Notes:**
   * 
   * * The http-equiv attribute provides an HTTP header for the information/value of the content attribute.
   * * The http-equiv attribute can be used to simulate an HTTP response header
   * * **Note:** If the name attribute is set, the http-equiv attribute should not be set.
   * 
   *
   * @param  string $http_equiv provides an HTTP header for the information/value of the content attribute
   * @param  string $content the value of the content attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_meta_http_equiv.asp http-equiv attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setHttpEquivContent($http_equiv, $content) {
    return $this->setAttr('http-equiv', $http_equiv)->setAttr('content', $content);
  }

  /**
   * Checks whether the http-equiv attribute exists or not
   *
   * @return boolean true if the http-equiv attribute exists, otherwise false
   * @link   http://www.w3schools.com/tags/att_meta_http_equiv.asp http-equiv attribute
   */
  public function hasHttpEquivContent() {
    return $this->attrExists('http-equiv');
  }

  /**
   * Checks whether the http_equiv attribute has the given value or not
   *
   * @param  string $http_equiv the http_equiv value of the metadata
   * @return boolean true if the http_equiv attribute has the given value, otherwise false
   * @link   http://www.w3schools.com/tags/att_meta_http_equiv.asp http_equiv attribute
   */
  public function hasHttpEquiv($http_equiv) {
    return $this->hasHttpEquivContent() && $this->get('http_equiv') == $http_equiv;
  }

  /**
   * Returns the value of the http_equiv attribute
   *
   * @return string|null the value of the http_equiv attribute or null if the 
   *         attribute is not set
   * @link   http://www.w3schools.com/tags/att_meta_http_equiv.asp http_equiv attribute
   */
  public function getHttpEquiv() {
    return $this->getAttr('http_equiv');
  }

  /**
   * Sets the property attribute the corresponding content attribute
   *
   * The Open Graph protocol enables any web page to become a rich object in a social graph.
   * For instance, this is used on Facebook to allow any web page to have the same
   * functionality as any other object on Facebook.
   *
   * @param  string $property the value of the property attribute
   * @param  string $content the value of the content attribute
   * @return self for PHP Method Chaining
   * @link   http://ogp.me/ The Open Graph protocol
   * @link   https://developers.facebook.com/docs/concepts/opengraph/ Open Graph Concepts (Facebook)
   * @link   http://en.wikipedia.org/wiki/RDFa RDFa (Wikipedia)
   */
  public function setPropertyContent($property, $content) {
    return $this->setAttr('property', $property)->setAttr('content', $content);
  }

  /**
   * Checks whether the property attribute exists or not
   *
   * @return boolean true if the property attribute exists, otherwise false
   * @link   http://ogp.me/ The Open Graph protocol
   * @link   https://developers.facebook.com/docs/concepts/opengraph/ Open Graph Concepts (Facebook)
   * @link   http://en.wikipedia.org/wiki/RDFa RDFa (Wikipedia)
   */
  public function hasPropertyContent() {
    return $this->attrExists('property');
  }

  /**
   * Checks whether the property attribute has the given value or not
   *
   * @param  string $property the property value of the metadata
   * @return boolean true if the property attribute has the given value, otherwise false
   * @link   http://ogp.me/ The Open Graph protocol
   * @link   https://developers.facebook.com/docs/concepts/opengraph/ Open Graph Concepts (Facebook)
   * @link   http://en.wikipedia.org/wiki/RDFa RDFa (Wikipedia)
   */
  public function hasProperty($property) {
    return $this->hasPropertyContent() && $this->get('property') == $property;
  }

  /**
   * Returns the value of the property attribute
   *
   * @return string|null the value of the property attribute or null if the 
   *         attribute is not set
   * @link   http://ogp.me/ The Open Graph protocol
   * @link   https://developers.facebook.com/docs/concepts/opengraph/ Open Graph Concepts (Facebook)
   * @link   http://en.wikipedia.org/wiki/RDFa RDFa (Wikipedia)
   */
  public function getProperty() {
    return $this->getAttr('property');
  }

}
