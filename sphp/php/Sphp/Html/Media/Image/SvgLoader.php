<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Image;

use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\FileSystemException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;

/**
 * Implements an SVG object loader utility
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SvgLoader {

  /**
   *
   * @var SvgLoader 
   */
  private static $instance;

  /**
   * @var Filetype|null singleton instance 
   */
  private $src = [];

  /**
   * Constructor
   */
  public function __construct() {
    $this->src;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->src);
  }

  public function __invoke(string $path) {
    ;
  }

  /**
   * Returns a new SVG image object instance created from a remote source
   * 
   * @param  string $url
   * @return Svg new instance
   * @throws InvalidArgumentException if the URL cannot be found or contains no valid SVG file
   */
  public function fromUrl(string $url, bool $reload = false): Svg {
    if (!array_key_exists($url, $this->src) || $reload) {
      $opts = ['http' =>
          [
              'method' => 'GET',
              'timeout' => 5
          ]
      ];
      $errThrower = ErrorToExceptionThrower::getInstance(InvalidArgumentException::class);
      $errThrower->start();
      $context = stream_context_create($opts);
      $result = file_get_contents($url, false, $context);
      if ($result === false) {
        throw new InvalidArgumentException("Remote file ($url) is invalid");
      }
      $errThrower->stop();
      $this->src[$url] = file_get_contents($url, false, $context);
    }
    return $this->stringToObject($this->src[$url]);
  }

  /**
   * Returns a new SVG image object instance created from a file
   * 
   * @param  string $file
   * @return Svg new instance
   * @throws FileSystemException if the file cannot be found or is not valid SVG file
   */
  public function fileToObject(string $file): Svg {
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
  public function stringToObject(string $source): Svg {
    $errThrower = ErrorToExceptionThrower::getInstance(InvalidArgumentException::class);
    $errThrower->start();
    $doc = new \DOMDocument();
    $loaded = $doc->loadXML($source);
    $errThrower->stop();
    if (!$loaded) {
      throw new InvalidArgumentException('Input given is not in valid SVG format');
    }
    return new Svg($doc);
  }

  /**
   * Returns a singleton instance
   * 
   * @return singleton instance
   */
  public static function instance(): SvgLoader {
    if (static::$instance === null) {
      static::$instance = new self();
    }
    return static::$instance;
  }

}
