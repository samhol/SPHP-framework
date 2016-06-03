<?php

/**
 * Img.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

use Sphp\Html\EmptyTag as EmptyTag;
use Sphp\Net\URL as URL;
use Sphp\Images\ImageScaler as ImageScaler;
use Sphp\Core\Types\Strings as Strings;

/**
 * Class Models an HTML &lt;img&gt; tag
 *
 * An {@link self} component represents an image. The image given by the src attribute is
 * the embedded content, and the value of the alt attribute is the img
 * element's fallback content.
 *
 * **Notes:**
 *
 * 1. The {@link self} component tag defines an image in an HTML page.
 * 2. The {@link self} component tag has two required attributes: src and alt.
 * 3. Images are not technically inserted into an HTML page, images are linked to HTML pages.
 * 4. The {@link self} component tag creates a holding space for the referenced image.
 *
 * **Definition and Usage**
 *
 * The alt attribute specifies an alternate text for an image, if the image cannot be displayed.
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-02-15
 * @link    http://www.w3schools.com/tags/tag_img.asp w3schools API link
 * @link    http://www.w3.org/html/wg/drafts/html/master/embedded-content.html#the-img-element W3C API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Img extends EmptyTag implements LazyLoaderInterface, SizeableInterface {

  use SizeableTrait,
      LazyLoaderTrait;

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "img";

  /**
   * Constructs a new instance
   *
   * @param  string|URL $src src attribute
   * @param  string $alt alt attribute
   * @link   http://www.w3schools.com/tags/att_img_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_img_type.asp type attribute
   */
  public function __construct($src = "", $alt = "") {
    parent::__construct(self::TAG_NAME);
    $this->attrs()->demand("alt");
    $this->setSrc($src)
            ->setAlt($alt);
  }

  /**
   * 
   * @param  string $mapName
   * @return self for PHP Method Chaining
   */
  public function useMap($mapName) {
    if (!Strings::startsWith($mapName, "#")) {
      $mapName = "#$mapName";
    }
    $this->attrs()->set("usemap", $mapName);
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
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_img_alt.asp alt attribute
   */
  public function setAlt($alt) {
    return $this->setAttr("alt", $alt);
  }

  /**
   * Returns the alt attribute (an alternate text for an image).
   *
   * **Notes:** The alt attribute specifies an alternate text for an image.
   *
   * @return string the value of the alt attribute
   * @link  http://www.w3schools.com/tags/att_img_alt.asp alt attribute
   */
  public function getAlt() {
    return $this->getAttr("alt");
  }

  /**
   * Returns the object as html-markup string.
   *
   * @return string html-markup of the object
   */
  public function getHtml() {
    $output = parent::getHtml();
    if ($this->isLazy()) {
      $nonLazy = clone $this;
      $nonLazy->setLazy(false);
      $output .= "<noscript>$nonLazy</noscript>";
    }
    return $output;
  }

  /**
   * Returns a new instance of the {@link Img} component containing a scaled image
   *
   * **IMPORTANT:** Remote image manipulation is also supported but it could easily be a huge security risk. 
   * 
   * @param  string $src the path to the image file
   * @param  Size $size the size to fit
   * @return Img new instance of the component containing a resized image
   */
  public static function scaleToFit($src, Size $size) {
    //echo "<pre>";
    //echo "1.: ".number_format(memory_get_usage(true)/1048576, 2)." MB\n";
    $path = (new ImageScaler($src))
            ->scaleToFit($size)
            ->saveToCache()
            ->httpCachePath();
    //echo "4.: ".number_format(memory_get_usage(true)/1048576, 2)." MB\n";
    //echo "</pre>";
    return new Img($path);
  }

  /**
   * Returns a new instance of the {@link Img} component containing a scaled image
   * 
   * **IMPORTANT:** Remote image manipulation is also supported but it could easily be a huge security risk. 
   *
   * @param  string $src the path to the image file
   * @param  float $ratio positive scaling ratio
   * @return Img new instance of the component containing a resized image
   */
  public static function scale($src, $ratio) {
    //echo number_format(memory_get_usage(true)/1048576, 2)." MB\n";
    $path = (new ImageScaler($src))
            ->scale($ratio)
            ->saveToCache()
            ->httpCachePath();
    //echo number_format(memory_get_usage(true)/1048576, 2)." MB\n";
    return new Img($path);
  }

  /**
   * Returns a new instance of the component containing a resizes image
   * 
   * **IMPORTANT:** Remote image manipulation is also supported but it could easily be a huge security risk. 
   *
   * @param  string $src the path to the image file
   * @param  Size $size the new size
   * @return Img new instance of the component containing a resized image
   * @uses   ImageScaler
   */
  public static function resize($src, Size $size) {
    $path = (new ImageScaler($src))
            ->resize($size)
            ->saveToCache()
            ->httpCachePath();
    return new Img($path);
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
   * @return Img new instance of the component containing a resized image
   * @uses   ImageScaler
   */
  public static function widen($src, $width) {
    $path = (new ImageScaler($src))
            ->widen($width)
            ->saveToCache()
            ->httpCachePath();
    return new Img($path);
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
  public static function heighten($src, $height) {
    $path = (new ImageScaler($src))
            ->heighten($height)
            ->saveToCache()
            ->httpCachePath();
    return new Img($path);
  }

}
