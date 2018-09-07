<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Images;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Defines image for some basic transformations
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Image {

  /**
   * Returns current image height
   * 
   * @return int current image height
   */
  public function getHeight(): int;

  /**
   * Returns current image width
   * 
   * @return int current image width
   */
  public function getWidth(): int;

  /**
   * Scales the image to fit the given box (width, height), constraining proportions
   * 
   * @param  int $width width to fit in
   * @param  int $height height to fit in
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function scaleToFit(int $width, int $height);

  /**
   * Resizes the image to given height, constraining proportions
   * 
   * @precondition $height >= 0
   * @param  int $height the new height
   * @return $this for a fluent interface
   */
  public function heighten(int $height);

  /**
   * Resizes the image to given width, constraining proportions
   * 
   * @precondition $width >= 0
   * @param  int $width the new width
   * @return $this for a fluent interface
   */
  public function widen(int $width);

  /**
   * Resizes the image to the given dimensions (width, height)
   * 
   * @param  int $width new width of the image
   * @param  int $height new height of the image
   * @return $this for a fluent interface
   */
  public function resize(int $width, int $height);

  /**
   * Scales the image by multiplying each side by the given ratio
   * 
   * @param  float $ratio the multiplying ratio
   * @return $this for a fluent interface
   */
  public function scale(float $ratio);

  /**
   * Checks if the given path points to an Imagine image file
   *
   * @return boolean true if the given path points to an Imagine image file; false otherwise
   */
  public function show();

  /**
   * Saves the image at a specified path
   * 
   * * The target file extension is used to determine file format
   * * jpg, jpeg, gif, png, wbmp and xbm are supported
   *
   * @param  string $path the file path
   * @return $this for a fluent interface
   */
  public function save(string $path);

  /**
   * Returns image file extension of the source
   *
   * @return string image file extension of the source
   */
  public function getExtension();

  /**
   * Returns the object as a string
   *
   * @return string the object as a string
   */
  public function __toString(): string;
}
