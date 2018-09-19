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
 * Defines an HTML &lt;link&gt; tag
 * 
 *  The &lt;link&gt; tag defines the relationship between a document and an
 *  external resource. The &lt;link&gt; tag is most used to link to style
 *  sheets.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface LinkInterface extends HeadContent, NonVisualContent {

  /**
   * Returns the location of the linked document
   *
   * **Notes:**
   * 
   * 1. The href attribute specifies the location (URL) of the external resource 
   *    (most often a style sheet file).
   * 
   * @return string the location of the linked document
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   */
  public function getHref();

  /**
   * Returns the relationship between the current document and the linked one
   *
   * **Notes:** The rel attribute specifies the relationship
   *  between the current document and the linked document/resource.
   *
   * **Values:**
   *
   * * `alternate` Links to an alternate version of the document
   *   (i.e. print page, translated or mirror)
   * * `author` Links to the author of the document
   * * `help` Links to a help document
   * * `icon` Imports an icon to represent the document
   * * `license` Links to copyright information for the document
   * * `next` Indicates that the document is a part of a series,
   *   and that the next document in the series is the referenced document
   * * `prefetch` Specifies that the target resource should be cached
   * * `prev` Indicates that the document is a part of a series,
   *   and that the previous document in the series is the referenced document
   * * `search` Links to a search tool for the document
   * * `stylesheet` URL to a style sheet to import
   *
   * @return string the relationship between the current document and the linked one
   * @link   http://www.w3schools.com/tags/att_link_rel.asp rel attribute
   */
  public function getRel();

  /**
   * Returns the MIME type of the linked document
   *
   * **Note:** The type attribute specifies the MIME type of the linked
   *  document.
   *
   * @return string|null the MIME type of the linked document
   * @link   http://www.w3schools.com/tags/att_link_type.asp type attribute
   * @link   http://www.iana.org/assignments/media-types complete list of standard MIME types
   */
  public function getType();

  /**
   * Returns the value of the media attribute
   *
   * **Notes:**
   *
   * * The media attribute specifies what media/device the target resource
   *   is optimized for.
   * * This attribute is mostly used with CSS style sheets to specify
   *   different styles for different media types.
   * * The media attribute can accept several values.
   *
   * @return string|null what media/device the target resource is optimized for
   * @link   http://www.w3schools.com/tags/att_link_media.asp media attribute
   */
  public function getMedia();

  /**
   * Returns the value of the media attribute
   *
   * **Notes:**
   *
   * * The media attribute specifies what media/device the target resource
   *   is optimized for.
   * * This attribute is mostly used with CSS style sheets to specify
   *   different styles for different media types.
   * * The media attribute can accept several values.
   *
   * @return string|null what media/device the target resource is optimized for
   * @link   http://www.w3schools.com/tags/att_link_media.asp media attribute
   */
  public function getSizes();
}
