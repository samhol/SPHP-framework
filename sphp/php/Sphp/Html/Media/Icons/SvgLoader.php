<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;

use Sphp\Stdlib\Networks\RemoteResource;
use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\FileSystemException;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements an SVG object loader
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SvgLoader {

  /**
   * @var Filetype|null singleton instance 
   */
  private static $instance;
  private static $src = [];

  /**
   * @var string 
   */
  private $flagPath;

  public function __construct(string $svg = null) {
    $this->svg = $svg;
  }

  public function setFlagPath(string $flagPath) {
    $this->flagPath = $flagPath;
    return $this;
  }

  /**
   * 
   * @param  string $url
   * @param  string $sreenreaderLabel
   * @return Svg
   */
  public static function fromUrl(string $url, string $sreenreaderLabel = null): Svg {
    if (!array_key_exists($url, self::$src)) {
      if (RemoteResource::exists($url)) {
        $opts = array('http' =>
            array(
                'method' => 'GET',
                'timeout' => 5
            )
        );

        $context = stream_context_create($opts);
        self::$src[$url] = file_get_contents($url, false, $context);
      } else {
        throw new InvalidArgumentException("fucked up remote file ($url)");
      }
    }

    return new Svg(self::$src[$url], $sreenreaderLabel);
  }

  /**
   * Returns a new SVG image object instance created from a file
   * 
   * @param  string $file
   * @return Svg new instance
   * @throws FileSystemException if the file cannot be found or is not valid SVG file
   */
  public static function fileToObject(string $file): Svg {
    if (!Filesystem::isFile($file)) {
      throw new FileSystemException("SVG file '$file' cannot be found");
    }

    $doc = new \DOMDocument();
    $loaded = $doc->load($file);
    if (!$loaded) {
      throw new FileSystemException("File '$file' is not valid SVG file");
    }
    return new Svg($doc);
  }

  /**
   * Returns a new SVG image object instance created from a string
   * 
   * @param  string $source The string containing the SVG
   * @return Svg new instance
   * @throws InvalidArgumentException if the input string is not valid SVG
   */
  public static function stringToObject(string $source): Svg {
    $doc = new \DOMDocument();
    $loaded = $doc->loadXML($source);
    if (!$loaded) {
      throw new InvalidArgumentException("Input string is not valid SVG");
    }
  }

  /**
   * Returns the singleton instance
   * 
   * @return SvgLoader singleton instance
   */
  public static function instance(): SvgLoader {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
