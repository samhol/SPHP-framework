<?php

/**
 * Link.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Head;

use Sphp\Html\EmptyTag;
use Sphp\Core\Types\Strings;

/**
 * Implements an HTML &lt;link&gt; tag
 *
 *  The &lt;link&gt; tag defines the relationship between a document and an
 *  external resource. The &lt;link&gt; tag is most used to link to style
 *  sheets.
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-02-03
 * @link    http://www.w3schools.com/tags/tag_link.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Link extends EmptyTag implements HeadComponentInterface {

  /**
   * Constructs a new instance
   *
   * @param  string $href the location of the linked document
   * @param  string $rel the relationship between the current document and the linked one
   * @param  string $media what media/device the target resource is optimized for
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_link_rel.asp rel attribute
   * @link   http://www.w3schools.com/tags/att_link_media.asp media attribute
   */
  public function __construct($href = '', $rel = 'stylesheet', $media = 'screen') {
    parent::__construct('link');
    $this->attrs()->demand('rel');
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
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   */
  public function setHref($href, $encode = true) {
    if ($encode) {
      $href = Strings::htmlEncode($href);
    }
    return $this->setAttr('href', $href);
  }

  /**
   * Returns the value of the href attribute
   *
   * **Notes:**
   * 
   * 1. The href attribute specifies the location (URL) of the external resource 
   *    (most often a style sheet file).
   * 
   *
   * @return string the location of the linked document
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   */
  public function getHref() {
    return $this->getAttr('href');
  }

  /**
   * Sets the value of the rel attribute
   *
   * **Notes:** The required rel attribute specifies the relationship
   *  between the current document and the linked document/resource.
   *
   * **Values:**
   *
   * * <var>alternate</var> Links to an alternate version of the document
   *   (i.e. print page, translated or mirror)
   * * <var>author</var> Links to the author of the document
   * * <var>help</var> Links to a help document
   * * <var>icon</var> Imports an icon to represent the document
   * * <var>license</var> Links to copyright information for the
   *   document
   * * <var>next</var> Indicates that the document is a part of a series,
   *   and that the next document in the series is the referenced document
   * * <var>prefetch</var> Specifies that the target resource should be
   *   cached
   * * <var>prev</var> Indicates that the document is a part of a series,
   *   and that the previous document in the series is the referenced
   *   document
   * * <var>search</var> Links to a search tool for the document
   * * <var>stylesheet</var> URL to a style sheet to import
   *
   *
   * @param  string $rel the relationship between the current document and the linked one
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_link_rel.asp rel attribute
   */
  public function setRel($rel) {
    return $this->setAttr('rel', $rel);
  }

  /**
   * Returns the value of the rel attribute
   *
   * **Notes:** The required rel attribute specifies the relationship
   *  between the current document and the linked document/resource.
   *
   * **Values:**
   *
   * * <var>alternate</var> Links to an alternate version of the document
   *   (i.e. print page, translated or mirror)
   * * <var>author</var> Links to the author of the document
   * * <var>help</var> Links to a help document
   * * <var>icon</var> Imports an icon to represent the document
   * * <var>license</var> Links to copyright information for the
   *   document
   * * <var>next</var> Indicates that the document is a part of a series,
   *   and that the next document in the series is the referenced document
   * * <var>prefetch</var> Specifies that the target resource should be
   *   cached
   * * <var>prev</var> Indicates that the document is a part of a series,
   *   and that the previous document in the series is the referenced
   *   document
   * * <var>search</var> Links to a search tool for the document
   * * <var>stylesheet</var> URL to a style sheet to import
   *
   *
   * @return string the relationship between the current document and the linked one
   * @link   http://www.w3schools.com/tags/att_link_rel.asp rel attribute
   */
  public function getRel() {
    return $this->getAttr('rel');
  }

  /**
   * Sets the value of the type attribute
   *
   * **Notes:** The type attribute specifies the MIME type of the linked
   *  document.
   *
   * @param  string $type the MIME type of the linked document
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_link_type.asp type attribute
   * @link   http://www.iana.org/assignments/media-types complete list of standard MIME types
   */
  public function setType($type) {
    return $this->setAttr('type', $type);
  }

  /**
   * Returns the value of the type attribute
   *
   * **Note:** The type attribute specifies the MIME type of the linked
   *  document.
   *
   * @return string|null  the MIME type of the linked document
   * @link   http://www.w3schools.com/tags/att_link_type.asp type attribute
   * @link   http://www.iana.org/assignments/media-types complete list of standard MIME types
   */
  public function getType() {
    return $this->getAttr('type');
  }

  /**
   * Sets the value of the media attribute
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
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_link_media.asp media attribute
   */
  public function setMedia($media) {
    return $this->setAttr('media', $media);
  }

  /**
   * Returns the value of the media attribute
   *
   * **Notes:**
   *
   * * The media attribute specifies what media/device the target resource
   *   is optimized for.
   * * This attribute is mostly used with CSS stylesheets to specify
   *   different styles for different media types.
   * * The media attribute can accept several values.
   *
   *
   * @return string|null  what media/device the target resource is optimized for
   * @link   http://www.w3schools.com/tags/att_link_media.asp media attribute
   */
  public function getMedia() {
    return $this->getAttr('media');
  }

}
