<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Stdlib\Arrays;

/**
 * Implements an HTML &lt;meta&gt; factory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_meta.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class Meta {

  /**
   * Creates a property meta data object attribute the corresponding content
   *
   * The Open Graph protocol enables any web page to become a rich object in 
   * a social graph. For instance, this is used on Facebook to allow any web 
   * page to have the same functionality as any other object on Facebook.
   *
   * @param  string $property the property attribute
   * @param  string $content the content attribute
   * @return MetaTag new meta data object
   * @link   http://ogp.me/ The Open Graph protocol
   * @link   https://developers.facebook.com/docs/concepts/opengraph/ Open Graph Concepts (Facebook)
   * @link   http://en.wikipedia.org/wiki/RDFa RDFa (Wikipedia)
   * @link   http://www.w3.org/MarkUp/2004/02/xhtml-rdf.html XHTML and RDF (W3C)
   */
  public static function property(string $property, string $content): MetaTag {
    return new MetaTag(['property' => $property, 'content' => $content]);
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
   * @return MetaTag new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_charset.asp charset attribute
   */
  public static function charset(string $charset): MetaTag {
    return new MetaTag(['charset' => $charset]);
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
   * @return MetaTag new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public static function namedContent(string $name, $content): MetaTag {
    if ($name === 'keywords') {
      return static::keywords($content);
    } else {
      return new MetaTag(['name' => $name, 'content' => $content]);
    }
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
   * @param  string $content the value of the content attribute
   * @return MetaTag new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_http_equiv.asp http-equiv attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public static function httpEquiv(string $http_equiv, string $content): MetaTag {
    return new MetaTag(['http-equiv' => $http_equiv, 'content' => $content]);
  }

  /**
   * Creates a meta component for web page description
   *
   * @param  string $content the description of the web page
   * @return MetaTag new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public static function description(string $content): MetaTag {
    return static::namedContent('description', $content);
  }

  /**
   * Creates a meta component containing information about the author
   *
   * @param  string $author the name of the author of the document
   * @return MetaTag new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public static function author(string $author): MetaTag {
    return static::namedContent('author', $author);
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
   * @return MetaTag new meta data object
   * @link   http://dev.w3.org/csswg/css-device-adapt/ W3C CSS Device Adaptation
   */
  public static function viewport(string $viewport = 'width=device-width, initial-scale=1.0'): MetaTag {
    return static::namedContent('viewport', $viewport);
  }

  /**
   * Creates a meta component for the name of the Web application
   *
   * @param  string $name the name of the Web application that the page represents
   * @return MetaTag new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public static function applicationName(string $name): MetaTag {
    return static::namedContent('application-name', $name);
  }

  /**
   * Creates a meta component for a list of keywords about the page
   *
   * Specifies a comma-separated list of keywords - relevant to the page 
   * (Informs search engines what the page is about).
   * 
   * @param  string[]|string,... $keywords a list of keywords
   * @return MetaTag new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public static function keywords(...$keywords): MetaTag {
    if (is_array($keywords)) {
      $keywords = implode(', ', Arrays::flatten($keywords));
    }
    return new MetaTag(['name' => 'keywords', 'content' => $keywords]);
  }

  /**
   * Creates a meta component for the preferred style sheet to use
   *
   * @param  string $id id of link element of the preferred style sheet to use
   * @return MetaTag new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_http_equiv.asp http-equiv attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public static function defaultStyle(string $id): MetaTag {
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
   * @return MetaTag new meta data object
   * @link   http://www.w3schools.com/tags/att_meta_http_equiv.asp http-equiv attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public static function refresh(int $interval): MetaTag {
    return static::httpEquiv('refresh', $interval);
  }

}
