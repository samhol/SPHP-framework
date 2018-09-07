<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Images;

use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\RuntimeException;
use SplFileInfo;

/**
 * Class contains some image manipulation tools
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SimpleCache {

  /**
   * the cache folder
   *
   * @var SplFileInfo
   */
  private $cacheRoot;

  /**
   * Constructor
   * 
   * @param  string $cachePath
   * @throws InvalidArgumentException
   */
  public function __construct(string $cachePath) {
    $this->setCachePath($cachePath);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->image);
  }

  public function setCachePath(string $path) {
    try {
      $this->cacheRoot = Filesystem::mkdir($path);
    } catch (\Exception $ex) {
      throw new InvalidArgumentException("Cachr src: '$path' cannot be set", $ex->getCode(), $ex);
    }
    return $this;
  }

  /**
   * Saves the image at a specified path
   * 
   * * The target file extension is used to determine file format
   * * jpg, jpeg, gif, png, wbmp and xbm are supported
   *
   * @param Image $image
   * @param bool $replace
   * @return string
   * @throws RuntimeException
   */
  public function save(Image $image, bool $replace = false): string {
    try {
      $path = $this->getFullCachePath($image);
      if ($replace) {
        Filesystem::rmFile($path);
      }
      $image->save($path);
    } catch (\Exception $ex) {
      throw new RuntimeException($ex->getMessage());
    }
    return $path;
  }

  /**
   * Returns the directory part of the cached image path
   * 
   * @return string the directory part of the cached image path
   */
  public function getCacheRoot(): string {
    return $this->cacheRoot->getPathname() . '/';
  }

  public function getCacheFilename(Image $image): string {
    $plain = $image->getOriginalSrc() . $image->getWidth() . 'x' . $image->getHeight();
    return md5($plain) . '.' . $image->getExtension();
  }

  /**
   * Returns the http path to the cached image
   * 
   * @return string the http path to the cached image
   */
  public function getFullCachePath(Image $image): string {
    return $this->getCacheRoot() . $this->getCacheFilename($image);
  }

  /**
   * Returns the http path to the cached image
   * 
   * @return boolean 
   */
  public function isCached(Image $image): bool {
    return is_file($this->getFullCachePath($image));
  }

  /**
   * 
   * @param  string $src
   * @return ImagineImage
   */
  public static function create(string $src): ImagineImage {
    return new static($src);
  }

}
