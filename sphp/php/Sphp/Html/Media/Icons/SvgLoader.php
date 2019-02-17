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
   * @param string $path
   * @param string $sreenreaderLabel
   * @return \Sphp\Html\Media\Icons\Svg
   * @throws InvalidArgumentException
   */
  public static function fromFile(string $path, string $sreenreaderLabel = null): Svg {
    if (!is_file($path)) {
      throw new InvalidArgumentException();
    }
    $svg = file_get_contents($path);
    return new Svg($svg, $sreenreaderLabel);
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
   * Returns a new SVG image object instance
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
   * 
   * @param string $file
   * @param string $title
   * @return string
   * @throws FileSystemException
   */
  public static function fileToString(string $file, string $title = null, float $opacity = null): string {
    if (!Filesystem::isFile($file)) {
      throw new FileSystemException("SVG file '$file' cannot be found");
    }
    $iconfile = new \DOMDocument();
    $iconfile->load($file);
    $svg = $iconfile->getElementsByTagName('svg')->item(0);
    if ($title !== null) {
      $titleNode = $iconfile->getElementsByTagName('title')->item(0);
      if ($titleNode === null) {
        $titleNode = $iconfile->createElement('title');
        $svg->insertBefore($titleNode, $svg->firstChild);
      }
      $titleNode->textContent = $title;
    }
    if ($opacity !== null) {
      $svg->setAttribute('opacity', $opacity);
    }
    return $iconfile->saveHTML($svg);
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
