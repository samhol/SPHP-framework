<?php

/**
 * ImageScaler.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Images;

use Sphp\Stdlib\Networks\URL;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;

/**
 * Class contains some image manipulation tools
 *
 * @author  Sami Holck <sami.holck@gmail.com>
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
   * @param  string $src
   * @throws \InvalidArgumentException
   */
  public function __construct(string $src) {
    try {
      $this->src = $src;
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
   * @param  int $width width to fit in
   * @param  int $height height to fit in
   * @return $this for a fluent interface
   * @throws \InvalidArgumentException
   */
  public function scaleToFit(int  $width, int $height) {
    if ($this->box->getWidth() > $width) {
      $this->box = $this->box->widen($width);
    }
    if ($this->box->getHeight() > $height) {
      $this->box = $this->box->heighten($height);
    }
    return $this;
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
   * @return $this for a fluent interface
   */
  public function heighten(int $height) {
    $this->box = $this->box->heighten($height);
    return $this;
  }

  /**
   * Resizes the image to given width, constraining proportions
   * 
   * @precondition $width >= 0
   * @param  int $width the new width
   * @return $this for a fluent interface
   */
  public function widen(int $width) {
    $this->box = $this->box->widen($width);
    return $this;
  }

  /**
   * Resizes the image to the given dimensions (width, height)
   * 
   * @param  int $width new width of the image
   * @param  int $height new height of the image
   * @return $this for a fluent interface
   */
  public function resize(int $width, int $height) {
    $this->box = new Box($width, $height);
    return $this;
  }

  /**
   * Scales the image by multiplying each side by the given ratio
   * 
   * @param  float $ratio the multiplying ratio
   * @return $this for a fluent interface
   */
  public function scale(float $ratio) {
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
   * @return $this for a fluent interface
   */
  public function save(string $path, array $options = []) {
    $this->createImage()->save($path, $options);
    return $this;
  }

  /**
   * Saves the image at a specified path
   * 
   * * The target file extension is used to determine file format
   * * jpg, jpeg, gif, png, wbmp and xbm are supported
   *
   * @return $this for a fluent interface
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
  private function getCacheDir(): string {
    return "sphp/image/cache/" . $this->cacheFolderName;
  }

  /**
   * 
   * @param  Box $box optional box object defining the size of the created image
   * @return string the filename part of the cached image path
   */
  private function getCacheFilename(Box $box = null): string {
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
  private function getCachePath(Box $box = null): string {
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
   *         If none given current size is used.
   * @return string the http path to the cached image
   */
  public function httpCachePath(Box $box = null) {
    if ($box === null) {
      $box = $this->box;
    }
    $filename = $this->getCacheFilename($box);
    return "sphp/image/cache/" . $this->cacheFolderName . $filename;
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
  public function __toString(): string {
    return $this->createImage()->show($this->getExtension());
  }

}
