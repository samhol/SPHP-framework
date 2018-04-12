<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media;

use Sphp\Html\EmptyTag;
use Sphp\Images\ImageScaler;
use Sphp\Stdlib\Strings;

/**
 * Implements an HTML &lt;img&gt; tag
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
 * @link    http://www.w3schools.com/tags/tag_img.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/embedded-content.html#the-img-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Img extends EmptyTag implements ImgInterface {

  use SizeableTrait,
      LazyMediaSourceTrait;

  /**
   * Constructs a new instance
   *
   * @param  string $src specifies the URL of an image
   * @param  string $alt specifies an alternate text for an image
   * @link   http://www.w3schools.com/tags/att_img_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_img_type.asp type attribute
   */
  public function __construct(string $src = '', string $alt = '') {
    parent::__construct('img');
    $this->attributes()->demand('alt');
    $this->setSrc($src)
            ->setAlt($alt);
  }

  /**
   * Sets the image map used
   * 
   * @param  string|ImageMap\Map $map the image map name or instance
   * @return $this for a fluent interface
   */
  public function useMap($map) {
    if ($map instanceof ImageMap\Map) {
      $map = $map->getName();
    }
    if (!Strings::startsWith($map, '#')) {
      $map = "#$map";
    }
    $this->attributes()->set('usemap', $map);
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
   * @link   http://www.w3schools.com/tags/att_img_alt.asp alt attribute
   */
  public function setAlt(string $alt) {
    $this->attributes()->set('alt', $alt);
    return $this;
  }

  /**
   * Returns the alt attribute (an alternate text for an image).
   *
   * **Notes:** The alt attribute specifies an alternate text for an image.
   *
   * @return string the alternate text for the image
   * @link  http://www.w3schools.com/tags/att_img_alt.asp alt attribute
   */
  public function getAlt(): string {
    return $this->attributes()->getValue('alt');
  }

  /**
   * Returns the object as HTML-markup string.
   *
   * @return string HTML-markup of the object
   */
  public function getHtml(): string {
    $output = parent::getHtml();
    if ($this->isLazy()) {
      $nonLazy = clone $this;
      $nonLazy->setLazy(false);
      $output .= "<noscript>$nonLazy</noscript>";
    }
    return $output;
  }

  /**
   * Returns a new instance of the component containing a scaled image
   *
   * **IMPORTANT:** Remote image manipulation is also supported but it could easily be a huge security risk. 
   * 
   * @param  string $src the path to the image file
   * @param  int $width width to fit in
   * @param  int $height height to fit in
   * @return self new instance containing a resized image
   */
  public static function scaleToFit(string $src, int $width, int $height) {
    $path = (new ImageScaler($src))
            ->scaleToFit($width, $height)
            ->saveToCache()
            ->httpCachePath();
    return new static($path);
  }

  /**
   * Returns a new instance of the component containing a scaled image
   * 
   * **IMPORTANT:** Remote image manipulation is also supported but it could easily be a huge security risk. 
   *
   * @param  string $src the path to the image file
   * @param  float $ratio positive scaling ratio
   * @return self new instance containing a resized image
   */
  public static function scale($src, float $ratio) {
    $path = (new ImageScaler($src))
            ->scale($ratio)
            ->saveToCache()
            ->httpCachePath();
    return new static($path);
  }

  /**
   * Returns a new instance of the component containing a resizes image
   * 
   * **IMPORTANT:** Remote image manipulation is also supported but it could easily be a huge security risk. 
   *
   * @param  string $src the path to the image file
   * @param  int $width new width of the image
   * @param  int $height new height of the image
   * @return self new instance containing a resized image
   */
  public static function resize(string $src, int $width, int $height) {
    $path = (new ImageScaler($src))
            ->resize($width, $height)
            ->saveToCache()
            ->httpCachePath();
    return new static($path);
  }

  /**
   * 
   * Returns a new instance of the {@link Img} component containing a widen image
   * 
   * Resizes the original image to given width, constraining proportions
   * 
   * **IMPORTANT:** Remote image manipulation is also supported but it could easily be a huge security risk. 
   *
   * @param  string $src the path to the image file
   * @param  int $width the new width
   * @return self new instance containing a resized image
   * @uses   ImageScaler
   */
  public static function widen(string $src, int $width) {
    $path = (new ImageScaler($src))
            ->widen($width)
            ->saveToCache()
            ->httpCachePath();
    return new static($path);
  }

  /**
   * Returns a new instance of the {@link Img} component containing a scaled image
   * 
   * Resizes the original image to given height, constraining proportions
   * 
   * **IMPORTANT:** Remote image manipulation is also supported but it could easily be a huge security risk. 
   *
   * @param  string $src the path to the image file
   * @param  int $height the new height
   * @return Img new instance of the component containing a resized image
   * @uses   ImageScaler
   */
  public static function heighten(string $src, int $height) {
    $path = (new ImageScaler($src))
            ->heighten($height)
            ->saveToCache()
            ->httpCachePath();
    return new static($path);
  }

}
