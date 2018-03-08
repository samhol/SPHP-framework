<?php

/**
 * Meta.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Head;

use Sphp\Html\EmptyTag;

/**
 * Implements an HTML &lt;meta&gt; tag
 *
 *  The &lt;meta&gt; tag provides metadata about the HTML document. Metadata will not be displayed on the page,
 *  but will be machine parsable. Meta elements are typically used to specify page description, keywords, author
 *  of the document, last modified, and other metadata. The metadata can be used by browsers (how to display
 *  content or reload page), search engines (keywords), or other web services.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_meta.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Meta extends EmptyTag implements MetaData {

  /**
   * Constructs a new instance
   * 
   * @param  string[] $attrs an array of attribute name value pairs
   */
  public function __construct(array $attrs = []) {
    parent::__construct('meta');
    $this->attributes()->merge($attrs);
  }

  public function hasNamedContent(): bool {
    return $this->attributeExists('name');
  }

  public function hasName(string $name): bool {
    return $this->hasNamedContent() && $this->getName() == $name;
  }

  public function getName() {
    return $this->getAttribute('name');
  }

  public function hasHttpEquivContent(): bool {
    return $this->attributeExists('http-equiv');
  }

  public function hasHttpEquiv(string $http_equiv): bool {
    return $this->hasHttpEquivContent() && $this->get('http_equiv') == $http_equiv;
  }

  public function getHttpEquiv() {
    return $this->getAttribute('http_equiv');
  }

  public function hasPropertyContent(): bool {
    return $this->attributeExists('property');
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
  public function hasProperty(string $property): bool {
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
    return $this->getAttribute('property');
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
   * @return Meta new meta data object
   * @link   http://ogp.me/ The Open Graph protocol
   * @link   https://developers.facebook.com/docs/concepts/opengraph/ Open Graph Concepts (Facebook)
   * @link   http://en.wikipedia.org/wiki/RDFa RDFa (Wikipedia)
   * @link   http://www.w3.org/MarkUp/2004/02/xhtml-rdf.html XHTML and RDF (W3C)
   */
  public static function property(string $property, string $content): Meta {
    return new static(['property' => $property, 'content' => $content]);
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
   * @return Meta new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_charset.asp charset attribute
   */
  public static function charset(string $charset): Meta {
    return new static(['charset' => $charset]);
  }

  /**
   * Creates a named content meta data object
   *
   * **Notes:**
   * 
   * * The name attribute specifies the name for the metadata.
   * * The name attribute specifies a name for the information/value of the content attribute.
   * * **Note:** If the http-equiv attribute is set, the name attribute should not be set.
   * 
   * @param  string $name specifies a name for the metadata
   * @param  string|array $content the value of the content attribute
   * @return Meta new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public static function namedContent(string $name, $content): Meta {
    if ($name === 'keywords') {
      return static::keywords($content);
    } else {
      return new static(['name' => $name, 'content' => $content]);
    }
  }

  /**
   * Creates a meta component to simulate an HTTP response header
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
   * @return Meta new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_http_equiv.asp http-equiv attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public static function httpEquiv(string $http_equiv, string $content): Meta {
    return new static(['http-equiv' => $http_equiv, 'content' => $content]);
  }

  /**
   * Creates a meta component for web page description
   *
   * @param  string $content the description of the web page
   * @return Meta new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public static function description(string $content): Meta {
    return static::namedContent('description', $content);
  }

  /**
   * Creates a meta component containing information about the author
   *
   * @param  string $content the name of the author of the document
   * @return Meta new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public static function author(string $content): Meta {
    return static::namedContent('author', $content);
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
   * @return Meta new meta data object
   * @link   http://dev.w3.org/csswg/css-device-adapt/ W3C CSS Device Adaptation
   */
  public static function viewport(string $viewport): Meta {
    return static::namedContent('viewport', $viewport);
  }

  /**
   * Creates a meta component for the name of the Web application
   *
   * @param  string $name the name of the Web application that the page represents
   * @return Meta new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public static function applicationName(string $name): Meta {
    return static::namedContent('application-name', $name);
  }

  /**
   * Creates a meta component for a list of keywords about the page
   *
   * Specifies a comma-separated list of keywords - relevant to the page 
   * (Informs search engines what the page is about).
   * 
   * @param  string[]|string,... $keywords a list of keywords
   * @return Meta new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public static function keywords(...$keywords): Meta {
    if (is_array($keywords)) {
      $keywords = implode(', ', \Sphp\Stdlib\Arrays::flatten($keywords));
    }
    return new static(['name' => 'keywords', 'content' => $keywords]);
  }

  /**
   * Creates a meta component for the preferred style sheet to use
   *
   * @param  string $id id of link element of the preferred style sheet to use
   * @return Meta new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_http_equiv.asp http-equiv attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public static function defaultStyle(string $id): Meta {
    return static::httpEquiv('default-style', $id);
  }

  /**
   * Creates a meta component for a time interval for the document to 
   * refresh itself
   *
   * **Note:**This should be used carefully, as it takes the control of a page 
   * away from the user.
   *
   * @param  int $interval time interval for the document to refresh itself
   * @return Meta new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_http_equiv.asp http-equiv attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public static function refresh(int $interval): Meta {
    return static::httpEquiv('refresh', $interval);
  }

}
