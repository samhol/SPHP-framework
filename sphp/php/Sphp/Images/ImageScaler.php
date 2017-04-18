<?php

/**
 * ImageScaler.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Images;

use Sphp\Stdlib\URL;
use Sphp\Html\Media\Size;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;

/**
 * Class contains some image manipulation tools
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-04-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ImageScaler {

  /**
   * the cache folder name of the manipulated image
   *
   * @var string
   */
  private $cacheFolderName;

  /**
   * the url of the original image
   *
   * @var URL 
   */
  private $src;

  /**
   * the image object
   *
   * @var \Imagine\Image\ImageInterface 
   */
  private $image;

  /**
   * the image box object
   *
   * @var \Imagine\Image\Box
   */
  private $originalBox;

  /**
   * the image box object
   *
   * @var \Imagine\Image\Box
   */
  private $box;

  /**
   * Constructs a new instance of the {@link self} object
   * 
   * @param  string|URL $src
   * @throws \InvalidArgumentException
   */
  public function __construct($src) {
    try {
      $this->src = "$src";
      $this->cacheFolderName = md5($this->src) . "/";
      $imagine = new Imagine();
      $this->image = $imagine->open($src);
      $this->originalBox = $this->image->getSize();
      $this->box = $this->image->getSize();
    } catch (\Exception $ex) {
      throw new \InvalidArgumentException("Image src: '$src' is not recognized", $ex->getCode(), $ex);
    }
  }

  /**
   * Destroys the instance
   * 
   * The destructor method will be called as soon as there are no other references 
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->src, $this->image, $this->originalBox, $this->box);
  }

  /**
   * Scales the image to fit the given box (width, height), constraining proportions
   * 
   * @param  Size|Box $size the size to fit
   * @return self for a fluent interface
   * @throws \InvalidArgumentException
   */
  public function scaleToFit($size) {
    if (!($size instanceof Size || $size instanceof Box)) {
      throw new \InvalidArgumentException();
    }
    $box = $this->sizeToBox($size);
    $w = $box->getWidth();
    $h = $box->getHeight();
    //$w = $this->filterWidth($size->getWidth());
    //$h = $this->filterHeight($size->getHeight());
    if ($this->box->getWidth() > $w) {
      $this->box = $this->box->widen($w);
    }
    if ($this->box->getHeight() > $h) {
      $this->box = $this->box->heighten($h);
    }
    return $this;
  }

  /**
   * Filters the width value
   * 
   * * Positive widths are accepted 
   * * null and negative widths => current image width is used
   * 
   * @param  Size|Box $s the size value to parse
   * @return Box the filtered box
   */
  private function sizeToBox($s) {
    if ($s instanceof Size) {
      $height = $s->getHeight();
      $width = $s->getWidth();
      if ($height === false || $height <= 0) {
        $height = $this->box->getHeight();
      }
      if ($width === false || $width <= 0) {
        $width = $this->box->getWidth();
      }
      $s = new Box($width, $height);
    }
    return $s;
  }

  /**
   * Checks whether the size of the original image is changed or not
   * 
   * @return boolean true if the original image size is changed and false otherwise
   */
  private function sizeChanged(Box $box = null) {
    if ($box === null) {
      $box = $this->box;
    }
    return $box->getWidth() !== $this->originalBox->getWidth() || $box->getHeight() !== $this->originalBox->getHeight();
  }

  /**
   * Resizes the image to given height, constraining proportions
   * 
   * @precondition $height >= 0
   * @param  int $height the new height
   * @return self for a fluent interface
   */
  public function heighten($height) {
    $this->box = $this->box->heighten($height);
    return $this;
  }

  /**
   * Resizes the image to given width, constraining proportions
   * 
   * @precondition $width >= 0
   * @param  int $width the new height
   * @return self for a fluent interface
   */
  public function widen($width) {
    $this->box = $this->box->widen($width);
    return $this;
  }

  /**
   * Resizes the image to the given dimensions (width, height)
   * 
   * @param  Size|Box $size the size to fit
   * @return self for a fluent interface
   */
  public function resize($size) {
    $this->box = $this->sizeToBox($size);
    return $this;
  }

  /**
   * Scales the image by multiplying each side by the given ratio
   * 
   * @param  float $ratio the multiplying ratio
   * @return self for a fluent interface
   */
  public function scale($ratio) {
    if ($ratio != 1 && $ratio > 0 && $ratio <= 2) {
      $this->box = $this->box->scale($ratio);
    }
    return $this;
  }

  /**
   * Creates an image object of given size from the original
   * 
   * @param  Box $box optional box object defining the size of the created image
   * @return \Imagine\Image\ImageInterface 
   */
  public function createImage(Box $box = null) {
    $img = clone $this->image;
    if ($box === null) {
      $box = $this->box;
    }
    if ($this->sizeChanged($box)) {
      $img->resize($box);
    }
    return $img;
  }

  /**
   * Checks if the given path points to an Imagine image file
   *
   * @param  Box $box optional box object defining the size of the created image
   * @return boolean true if the given path points to an Imagine image file; false otherwise
   */
  public function show(Box $box = null) {
    //header('Content-type: ' . $this->src->getMimeType());
    //header('Content-Disposition: filename="thumb.' . $this->getExtension());
    echo $this->createImage($box);
  }

  /**
   * Saves the image at a specified path
   * 
   * * The target file extension is used to determine file format
   * * jpg, jpeg, gif, png, wbmp and xbm are supported
   *
   * @param  string $path the file path
   * @param  array  $options the options used on save
   * @return self for a fluent interface
   */
  public function save($path, array $options = []) {
    $this->createImage()->save($path, $options);
    return $this;
  }

  /**
   * Saves the image at a specified path
   * 
   * * The target file extension is used to determine file format
   * * jpg, jpeg, gif, png, wbmp and xbm are supported
   *
   * @return self for a fluent interface
   */
  public function saveToCache() {
    $dir = $this->getCacheDir();
    if (!$this->inCache()) {
      if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
      }
      $filename = $this->getCacheFilename();
      $this->save($dir . $filename);
    }
    return $this;
  }

  /**
   * Returns the directory part of the cached image path
   * 
   * @return string the directory part of the cached image path
   */
  private function getCacheDir() {
    return \Sphp\Images\CACHE . "/" . $this->cacheFolderName;
  }

  /**
   * 
   * @param  Box $box optional box object defining the size of the created image
   * @return string the filename part of the cached image path
   */
  private function getCacheFilename(Box $box = null) {
    if ($box === null) {
      $box = $this->box;
    }
    return $box->getWidth() . "x" . $box->getHeight() . "." . $this->getExtension();
  }

  /**
   * 
   * @param  Box $box optional box object defining the size of the created image
   * @return string the full cached image path
   */
  private function getCachePath(Box $box = null) {
    if ($box === null) {
      $box = $this->box;
    }
    return $this->getCacheDir() . $this->getCacheFilename($box);
  }

  /**
   * Checks whether a cached version of given size
   * 
   * @param  Box $box optional box object defining the size of the created image. 
   *         If none given current size is used.
   * @return boolean true if the image of the size is stored into the cache
   */
  public function inCache(Box $box = null) {
    if ($box === null) {
      $box = $this->box;
    }
    return is_file($this->getCachePath($box));
  }

  /**
   * Returns the http path to the cached image
   * 
   * @param  Box $box optional box object defining the size of the created image. 
   *         If none given ccurrent size is used.
   * @return string the http path to the cached image
   */
  public function httpCachePath(Box $box = null) {
    if ($box === null) {
      $box = $this->box;
    }
    $filename = $this->getCacheFilename($box);
    return \Sphp\Images\CACHE_HTTP . "/" . $this->cacheFolderName . $filename;
  }

  /**
   * Returns image file extension of the source
   *
   * @return string image file extension of the source
   */
  public function getExtension() {
    return Images::getImageTypeExt($this->src);
  }

  /**
   * Returns the object as a string
   *
   * @return string the object as a string
   */
  public function __toString() {
    return $this->createImage()->show($this->getExtension());
  }

}
