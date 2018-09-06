<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Images;

use SplFileObject;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Class contains some image manipulation tools
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractImage implements Image {

  /**
   * the original image
   *
   * @var SplFileObject 
   */
  private $src;

  /**
   * the url of the original image
   *
   * @var string 
   */
  private $cacheRoot;

  /**
   * Constructor
   * 
   * @param  string $src
   * @throws InvalidArgumentException
   */
  public function __construct(string $src) {
    try {
      $this->src = new SplFileObject($src, 'r', true);
      $this->setCacheRoot($this->src->getPath());
    } catch (\Exception $ex) {
      throw new InvalidArgumentException($ex->getMessage());
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->src);
  }

  public function getOriginalSrc(): string {
    return $this->src->getPathname();
  }

  public function setCacheRoot(string $path) {
    $this->cacheRoot = $path;
    // echo "cacheRoot: $this->cacheRoot";
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
    $dir = $this->getCacheRoot();
    if (!$this->inCache()) {
      if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
      }
      $filename = $this->getFullCachePath();
      echo " $filename ";
      $this->save($filename);
    }
    return $this;
  }

  /**
   * Returns the directory part of the cached image path
   * 
   * @return string the directory part of the cached image path
   */
  public function getCacheRoot(): string {
    return $this->cacheRoot . '/';
  }

  /**
   * 
   * @return string the full cached image path
   */
  public function getCachePath(): string {
    return $this->cacheRoot . '/';
  }

  /**
   * Returns the http path to the cached image
   * 
   * @return string the http path to the cached image
   */
  public function getFullCachePath(): string {
    return $this->getCacheRoot() . $this->getCacheFilename();
  }

  /**
   * Returns image file extension of the source
   *
   * @return string image file extension of the source
   */
  public function getExtension(): string {
    return $this->src->getExtension();
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
