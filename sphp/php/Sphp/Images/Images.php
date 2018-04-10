<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Images;

use Sphp\Objects\Datetime as Datetime;

/**
 * Class contains some image manipulation tools
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Images {

  private static $extNames = [
      \IMAGETYPE_GIF => "gif",
      \IMAGETYPE_JPEG => "jpg",
      \IMAGETYPE_PNG => "png",
      \IMAGETYPE_SWF => "swf",
      \IMAGETYPE_PSD => "psd",
      \IMAGETYPE_SWF => "swf",
      \IMAGETYPE_BMP => "bmp",
      \IMAGETYPE_TIFF_II => "tiff", //(Intel byte order)
      \IMAGETYPE_TIFF_MM => "tiff", //(Motorola byte order)
      \IMAGETYPE_JPC => "jpc",
      \IMAGETYPE_JP2 => "jp2",
      \IMAGETYPE_JPX => "jpx",
      \IMAGETYPE_JB2 => "jb2",
      \IMAGETYPE_SWC => "swc",
      \IMAGETYPE_IFF => "iff",
      \IMAGETYPE_WBMP => "wbmp",
      \IMAGETYPE_XBM => "xbm"
  ];

  /**
   * Loads an image
   *
   * @param  string $imgSrc to the image file
   * @return resource an image resource identifier on success, false on errors
   */
  public static function loadImage($imgSrc) {
    $imageType = exif_imagetype($imgSrc);
    if (!$imageType) {
      return self::loadTextImage("Unsupported imagetype or not an image");
    } else {
      if ($imageType == IMAGETYPE_GIF) {
        return self::loadGIF($imgSrc);
      } else if ($imageType == IMAGETYPE_JPEG) {
        return self::loadJPEG($imgSrc);
      } else if ($imageType == IMAGETYPE_PNG) {
        return self::loadPNG($imgSrc);
      } else {
        return self::loadTextImage("Unsupported imagetype");
      }
    }
  }

  /**
   * Loads an image containing given text
   *
   * @param string $text
   * @param int $width the width of the image
   * @param int $height the height of the image
   * @return resource an image resource identifier on success, false on errors
   */
  public static function loadTextImage($text = "", $width = 800, $height = 600) {
    $im = imagecreatetruecolor($width, $height);
    $bgc = imagecolorallocate($im, 255, 255, 255);
    $tc = imagecolorallocate($im, 0, 0, 0);
    imagefilledrectangle($im, 0, 0, 300, 50, $bgc);
    imagestring($im, 1, 5, 5, $text, $tc);
    return $im;
  }

  /**
   * Loads a png image
   *
   * @param  string $imgSrc to the image file
   * @return resource an image resource identifier on success, false on errors
   */
  public static function loadPNG($imgSrc) {
    $im = @imagecreatefrompng($imgSrc);
    if (!$im) {
      return self::loadTextImage("Error Loading png image");
    }
    return $im;
  }

  /**
   * Loads a jpeg image
   *
   * @param  string $imgSrc to the image file
   * @return resource an image resource identifier on success, false on errors
   */
  public static function loadJPEG($imgSrc) {
    $im = @imagecreatefromjpeg($imgSrc);
    if (!$im) {
      return self::loadTextImage("Error Loading jpeg image");
    }
    return $im;
  }

  /**
   * Loads a gif image
   *
   * @param  string $imgSrc to the image file
   * @return resource an image resource identifier on success, false on errors
   */
  public static function loadGIF($imgSrc) {
    $im = @imagecreatefromgif($imgSrc);
    if (!$im) {
      return self::loadTextImage('Error Loading gif image');
    }
    return $im;
  }

  /**
   * Checks if the given path points to an image file
   *
   * @param string $imgSrc to the image file
   * @return boolean true if the given path points to an image file; false otherwise
   */
  public static function isImage($imgSrc) {
    return @getimagesize($imgSrc) !== false;
  }

  /**
   * Checks if the given path points to an Imagine image file
   *
   * @param string $imgSrc to the image file
   * @return boolean true if the given path points to an Imagine image file; false otherwise
   */
  public static function isImagineImage($imgSrc) {
    try {
      $imagine = new \Imagine\Gd\Imagine();
      $imagine->open($imgSrc);
      return true;
    } catch (\Exception $e) {
      return false;
    }
  }

  /**
   * Returns image information in an array
   *
   * @param  string $imgSrc to the image file
   * @return array image information or an empty array if the file is not an image
   */
  public static function getImageInfo(string $imgSrc): array {
    $data = array();
    if (!static::isImage($imgSrc)) {
      return $data;
    }
    $arr = getimagesize($imgSrc);
    $data["width"] = $arr[0];
    $data["height"] = $arr[1];
    $data["mime"] = $arr["mime"];
    $data["ext"] = self::getImageTypeExt($imgSrc);
    if (isset($arr["bits"])) {
      $data["bits"] = $arr["bits"];
    }
    if (is_file($imgSrc)) {
      $splInfo = new \SplFileInfo($imgSrc);
      $splInfo->getSize();
      $data['lastAccess'] = new Datetime(fileatime($imgSrc));
      $data['modified'] = new Datetime(filemtime($imgSrc));
      $data['basename'] = basename($imgSrc);
      $data['dirname'] = dirname($imgSrc);
      $data['absoluteDir'] = dirname(realpath($imgSrc));
      $data['size_B'] = $splInfo->getSize();
      $data['size_kB'] = intval(round($data["size_B"] / 1024));
      $data['ext'] = $splInfo->getExtension();
    } else {
      $data["lastAccess"] = new Datetime(fileatime($imgSrc));
      $data["modified"] = new Datetime(filemtime($imgSrc));
      $size = filesize($imgSrc);
      $data["size_B"] = $size;
      $data["size_kB"] = intval(round($size / 1024));
    }
    //print_r(pathinfo($imgSrc));
    $pathInfo = pathinfo($imgSrc);
    //print_r(getimagesize($imgSrc));
    $data['filename'] = $pathInfo["filename"];
    $data['basename'] = $pathInfo["basename"];
    $data['extension'] = $pathInfo["extension"];
    $data['filename'] = $pathInfo["filename"];

    return $data;
  }

  /**
   * Returns image file extension of the source
   *
   * @param  string $src path to the image file
   * @return string image file extension of the source or `'unknown'` if file was not recognized as an image
   */
  public static function getImageTypeExt(string $src): string {
    $ext = exif_imagetype($src);
    if (!array_key_exists($ext, self::$extNames)) {
      $type = "unknown";
    } else {
      $type = self::$extNames[$ext];
    }
    return $type;
  }

}
