<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Html\EmptyTag;
use Sphp\Stdlib\Strings;

/**
 * Implements an HTML &lt;link&gt; tag
 *
 *  The &lt;link&gt; tag defines the relationship between a document and an
 *  external resource. The &lt;link&gt; tag is most used to link to style
 *  sheets.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_link.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class LinkTag extends EmptyTag implements LinkInterface {

  /**
   * Constructs a new instance
   *
   * @param  string $rel the relationship between the current document and the linked one
   * @param  string $href the location of the linked document
   * @param  string $media what media/device the target resource is optimized for
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_link_rel.asp rel attribute
   * @link   http://www.w3schools.com/tags/att_link_media.asp media attribute
   */
  public function __construct(string $rel = nul, string $href = nulll, string $media = null) {
    parent::__construct('link');
    $this->attributes()->demand('rel');
    if ($href !== null) {
      $this->setHref($href);
    }
    if ($rel !== null) {
      $this->setRel($rel);
    }
    if ($media !== null) {
      $this->setMedia($media);
    }
  }

  /**
   * Sets the value of the href attribute
   *
   * **Note:**
   * The href attribute specifies the location (URL) of the external
   *      resource (most often a style sheet file).
   *
   * @param  string $href the location of the linked document
   * @param  boolean $encode converts all applicable characters of the $url to HTML entities
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   */
  public function setHref(string $href, bool $encode = true) {
    if ($encode) {
      $href = Strings::htmlEncode($href);
    }
    $this->attributes()->set('href', $href);
    return $this;
  }

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
  public function getHref() {
    return $this->attributes()->getValue('href');
  }

  /**
   * Sets the relationship between the current document and the linked one
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
   * @param  string $rel the relationship between the current document and the linked one
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_link_rel.asp rel attribute
   */
  public function setRel(string $rel) {
    $this->attributes()->set('rel', $rel);
    return $this;
  }

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
  public function getRel(): string {
    return $this->attributes()->getValue('rel');
  }

  /**
   * Sets the MIME type of the linked document
   *
   * **Notes:** The type attribute specifies the MIME type of the linked
   *  document.
   *
   * @param  string $type the MIME type of the linked document
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_link_type.asp type attribute
   * @link   http://www.iana.org/assignments/media-types complete list of standard MIME types
   */
  public function setType(string $type) {
    $this->attributes()->set('type', $type);
    return $this;
  }

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
  public function getType() {
    return $this->attributes()->getValue('type');
  }

  /**
   * Sets what media/device the target resource is optimized for
   *
   * **Notes:**
   *
   * * The media attribute specifies what media/device the target resource
   *   is optimized for.
   * * This attribute is mostly used with CSS stylesheets to specify
   *   different styles for different media types.
   * * The media attribute can accept several values.
   *
   * @param  string $media what media/device the target resource is optimized for
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_link_media.asp media attribute
   */
  public function setMedia(string $media) {
    $this->attributes()->set('media', $media);
    return $this;
  }

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
  public function getMedia() {
    return $this->attributes()->getValue('media');
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
  public function linkDataToArray(): array {
    return $this->attributes()->toArray();
  }

  public function equals(LinkTag $meta): bool {
    return $meta->getRel() === $this->getRel() && $meta->getHref() === $this->getHref() && $this->getMedia() === $meta->getMedia();
  }

}
