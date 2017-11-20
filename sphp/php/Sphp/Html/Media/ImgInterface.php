<?php

/**
 * ImgInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

/**
 * Implements an HTML &lt;img&gt; tag
 *
 * This component represents an image. The image given by the src attribute is
 * the embedded content, and the value of the alt attribute is the img
 * element's fallback content.
 *
 * **Notes:**
 *
 * 1. This component defines an image in an HTML page.
 * 2. This component has two required attributes: src and alt.
 * 3. Images are not technically inserted into an HTML page, images are linked to HTML pages.
 * 4. This component creates a holding space for the referenced image.
 *
 * **Definition and Usage**
 *
 * The alt attribute specifies an alternate text for an image, if the image cannot be displayed.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_img.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/embedded-content.html#the-img-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ImgInterface extends MediaSource, SizeableMedia, LazyMedia {

  /**
   * Sets the alt attribute (an alternate text for an image).
   *
   * **Definition and Usage:**
   *
   *  The required alt attribute specifies an alternate text for an image, if
   *  the image cannot be displayed.
   *
   * **Guidelines for the alt text:**
   *
   * 1. The text should describe the image if the image contains information
   * 2. The text should explain where the link goes if the image is inside a linking element
   * 3. Use "" if the image is only for decoration 
   *    (in this case you don't need to define "alt attribute at all")
   *
   * @param  string $alt the alternate text for an image
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_img_alt.asp alt attribute
   */
  public function setAlt(string $alt);

  /**
   * Returns the alt attribute (an alternate text for an image).
   *
   * **Notes:** The alt attribute specifies an alternate text for an image.
   *
   * @return string the value of the alt attribute
   * @link  http://www.w3schools.com/tags/att_img_alt.asp alt attribute
   */
  public function getAlt(): string;
}
