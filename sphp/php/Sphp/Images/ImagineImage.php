<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Images;

use Imagine\Gd\Imagine;
use Imagine\Image\BoxInterface;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\RuntimeException;

/**
 * Implements image using Imagine PHP library
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ImagineImage extends AbstractImage {

  /**
   * the image object
   *
   * @var ImageInterface 
   */
  private $image;

  /**
   * Constructor
   * 
   * @param  string $src
   * @param  BoxInterface $box
   * @throws InvalidArgumentException
   */
  public function __construct(string $src = null, BoxInterface $box = null) {
    try {
      $imagine = new Imagine();
      $this->image = $imagine->open($src);
      if ($box !== null) {
        $this->image->resize($size);
      }
      parent::__construct($src);
    } catch (\Exception $ex) {
      throw new InvalidArgumentException("Image src: '$src' is not recognized", $ex->getCode(), $ex);
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->image);
  }

  /**
   * Returns the object as a string
   *
   * @return string the object as a string
   */
  public function __toString(): string {
    return $this->image->show($this->getExtension());
  }

  /**
   * Scales the image to fit the given box (width, height), constraining proportions
   * 
   * @param  int $width width to fit in
   * @param  int $height height to fit in
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function scaleToFit(int $width, int $height) {
    $box = $this->getBox();
    if ($box->getWidth() > $width) {
      $box = $box->widen($width);
    }
    if ($box->getHeight() > $height) {
      $box = $box->heighten($height);
    }
    $this->image->resize($box);
    return $this;
  }

  /**
   * Resizes the image to given height, constraining proportions
   * 
   * @precondition $height >= 0
   * @param  int $height the new height
   * @return $this for a fluent interface
   */
  public function heighten(int $height) {
    $this->image->resize($this->getBox()->heighten($height));
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
    $this->image->resize($this->getBox()->widen($width));
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
    $this->image->resize(new Box($width, $height));
    return $this;
  }

  /**
   * Scales the image by multiplying each side by the given ratio
   * 
   * @param  float $ratio the multiplying ratio
   * @return $this for a fluent interface
   */
  public function scale(float $ratio) {
    if ($ratio > 0) {
      $box = $this->getBox()->scale($ratio);
      $this->image->resize($box);
    } else {
      throw new InvalidArgumentException;
    }
    return $this;
  }

  /**
   * Creates an image object of given size from the original
   * 
   * @return BoxInterface 
   */
  protected function getBox(): BoxInterface {
    return $this->image->getSize();
  }

  /**
   * Checks if the given path points to an Imagine image file
   *
   * @return boolean true if the given path points to an Imagine image file; false otherwise
   */
  public function show(string $format = null) {
    if ($format !== null) {
      $this->image->show($format);
    } else {
      echo $this->image;
    }
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
    try {
      if (!Filesystem::isFile($path)) {
        Filesystem::mkFile($path);
      }
      $this->image->save($path, $options);
    } catch (\Exception $ex) {
      throw new RuntimeException($ex->getMessage());
    }
    return $this;
  }

  public function getHeight(): int {
    return $this->getBox()->getHeight();
  }

  public function getWidth(): int {
    return $this->getBox()->getWidth();
  }

  /**
   * 
   * @param  string $src
   * @return ImagineImage new instance
   */
  public static function create(string $src): ImagineImage {
    return new static($src);
  }

}
