<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;

use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\FileSystemException;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements an SVG object loader utility
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class SvgLoader {

  /**
   * @var Filetype|null singleton instance 
   */
  private static $src = [];

  /**
   * Returns a new SVG image object instance created from a remote source
   * 
   * @param  string $url
   * @return Svg new instance
   * @throws InvalidArgumentException if the URL cannot be found or contains no valid SVG file
   */
  public static function fromUrl(string $url): Svg {
    if (!array_key_exists($url, self::$src)) {
      $opts = ['http' =>
          [
              'method' => 'GET',
              'timeout' => 5
          ]
      ];
      $context = stream_context_create($opts);
      $result = file_get_contents($url, false, $context);
      if ($result === false) {
        throw new InvalidArgumentException("Remote file ($url) is invalid");
      }
      self::$src[$url] = file_get_contents($url, false, $context);
    }
    return static::stringToObject(self::$src[$url]);
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
      throw new InvalidArgumentException('Input given is not valid SVG');
    }
    return new Svg($doc);
  }

}
