<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Pictures;

use Sphp\Html\EmptyTag;
use Sphp\Html\Media\MediaSource;
use Sphp\Html\Media\SizeableMedia;

/**
 * Implementation of an HTML img tag
 *
 * This component represents an image. The image given by the src attribute is
 * the embedded content, and the value of the alt attribute is the img
 * element's fallback content.
 *
 * **Notes:**
 *
 * 1. This component tag defines an image in an HTML page.
 * 2. This component tag has two required attributes: src and alt.
 * 3. Images are not technically inserted into an HTML page, images are linked to HTML pages.
 * 4. This component tag creates a holding space for the referenced image.
 *
 * **Definition and Usage**
 *
 * The alt attribute specifies an alternate text for an image, if the image cannot be displayed.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_img.asp w3schools API
 * @link    https://www.w3.org/html/wg/drafts/html/master/embedded-content.html#the-img-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Img extends EmptyTag implements MediaSource, SizeableMedia {

  /**
   * Constructor
   *
   * @param  string $src specifies the URL of an image
   * @param  string $alt specifies an alternate text for an image
   * @link   https://www.w3schools.com/tags/att_img_src.asp src attribute
   * @link   https://www.w3schools.com/tags/att_img_type.asp type attribute
   */
  public function __construct(string $src = '', string $alt = '') {
    parent::__construct('img');
    $this->attributes()->forceVisibility('alt');
    $this->setSrc($src)
            ->setAlt($alt);
  }

  /**
   * Sets the image map used
   * 
   * @param  string|ImageMap\Map $map the image map name or instance
   * @return $this for a fluent interface
   */
  public function useMap(string|ImageMap\Map|null $map) {
    if ($map instanceof ImageMap\Map) {
      $map = $map->getName();
    }
    if ($map !== null && !str_starts_with($map, '#')) {
      $map = "#$map";
    }
    $this->attributes()->setAttribute('usemap', $map);
    return $this;
  }

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
   * @link   https://www.w3schools.com/tags/att_img_alt.asp alt attribute
   */
  public function setAlt(string $alt) {
    $this->attributes()->setAttribute('alt', $alt);
    return $this;
  }

  /**
   * Returns the alt attribute (an alternate text for an image).
   *
   * **Notes:** The alt attribute specifies an alternate text for an image.
   *
   * @return string the alternate text for the image
   * @link  https://www.w3schools.com/tags/att_img_alt.asp alt attribute
   */
  public function getAlt(): string {
    return $this->attributes()->getValue('alt');
  }

  /**
   * Sets the loading method used in brpwser
   *
   * **Definition and Usage:**
   *
   *  The loading attribute specifies whether a browser should load an image 
   *  immediately or to defer loading of off-screen images until for example the 
   *  user scrolls near them
   * 
   * @param  string $loading the loading method
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_img_loading.asp loading attribute
   */
  public function setLoading(?string $loading) {
    $this->attributes()->setAttribute('loading', $loading);
    return $this;
  }

  /**
   * Sets the path to the image source (The URL of the image file)
   * 
   * @param  string $src the path to the image source (The URL of the image file)
   * @return $this for a fluent interface
   */
  public function setSrc(string $src = null) {
    $this->attributes()->setAttribute('src', $src);
    return $this;
  }

  /**
   * Returns the path to the image source (The URL of the image file)
   *
   * @return string the path to the image source (The URL of the image file)
   */
  public function getSrc(): string {
    return (string) $this->attributes()->getValue('src');
  }

  public function setSize(?int $width, ?int $height) {
    $this->setAttribute('width', $width);
    $this->setAttribute('height', $height);
    return $this;
  }

}
