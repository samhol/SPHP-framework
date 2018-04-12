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
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface MetaData extends HeadContent, NonVisualContent {

  /**
   * Checks whether the name attribute exists or not
   *
   * @return boolean true if the name attribute exists, otherwise false
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   */
  public function hasNamedContent(): bool;

  /**
   * Checks whether the name attribute has the given value or not
   *
   * @param  string $name the name value of the metadata
   * @return boolean true if the name attribute has the given value, otherwise false
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   */
  public function hasName(string $name): bool;

  /**
   * Returns the value of the name attribute
   *
   * @return string|null the value of the name attribute or null if the 
   *         attribute is not set
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   */
  public function getName();

  /**
   * Checks whether the http-equiv attribute exists or not
   *
   * @return boolean true if the http-equiv attribute exists, otherwise false
   * @link   http://www.w3schools.com/tags/att_meta_http_equiv.asp http-equiv attribute
   */
  public function hasHttpEquivContent(): bool;

  /**
   * Checks whether the http_equiv attribute has the given value or not
   *
   * @param  string $http_equiv the http_equiv value of the metadata
   * @return boolean true if the http_equiv attribute has the given value, otherwise false
   * @link   http://www.w3schools.com/tags/att_meta_http_equiv.asp http_equiv attribute
   */
  public function hasHttpEquiv(string $http_equiv): bool;

  /**
   * Returns the value of the http_equiv attribute
   *
   * @return string|null the value of the http_equiv attribute or null if the 
   *         attribute is not set
   * @link   http://www.w3schools.com/tags/att_meta_http_equiv.asp http_equiv attribute
   */
  public function getHttpEquiv();

  /**
   * Checks whether the property attribute exists or not
   *
   * @return boolean true if the property attribute exists, otherwise false
   * @link   http://ogp.me/ The Open Graph protocol
   * @link   https://developers.facebook.com/docs/concepts/opengraph/ Open Graph Concepts (Facebook)
   * @link   http://en.wikipedia.org/wiki/RDFa RDFa (Wikipedia)
   */
  public function hasPropertyContent(): bool;

  /**
   * 
   * @param  MetaData $meta
   * @return boolean true if the property attribute exists, otherwise false
   */
  public function overlapsWith(MetaData $meta): bool;

  public function metaToArray(): array;
}
