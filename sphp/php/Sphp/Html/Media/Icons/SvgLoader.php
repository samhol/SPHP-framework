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

/**
 * Description of SVGLoader
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SvgLoader implements \Sphp\Html\Content {

  use \Sphp\Html\ContentTrait;

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

  public function getHtml(): string {
    return $this->svg;
  }

  /**
   * 
   * @param string $path
   * @param string $sreenreaderLabel
   * @return \Sphp\Html\Media\Icons\Svg
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public static function fromFile(string $path, string $sreenreaderLabel = null): Svg {
    if (!is_file($path)) {
      throw new \Sphp\Exceptions\InvalidArgumentException();
    }
    $svg = file_get_contents($path);
    return new Svg($svg, $sreenreaderLabel);
  }

  /**
   * 
   * @param string $url
   * @param string $sreenreaderLabel
   * @return \Sphp\Html\Media\Icons\Svg
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
        throw new \Sphp\Exceptions\InvalidArgumentException("fucked up remote file ($url)");
      }
    }

    return new Svg(self::$src[$url], $sreenreaderLabel);
  }

  public function getFlag(string $countryCode, float $opacity = 1) {
    if ($this->flagPath !== null) {
      return static::fromFile($this->flagPath . $countryCode . ".svg");
    } else {
      throw new InvalidArgumentException('No flag path was given');
    }
  }

  public static function fileToString(string $file, string $title = null): string {
    $iconfile = new \DOMDocument();
    $iconfile->load($file);
    $svg = $iconfile->getElementsByTagName('svg')->item(0);
    if ($title !== null) {
      $titleNode = $iconfile->getElementsByTagName('title')->item(0);
      if ($titleNode === null) {
        $titleNode = $iconfile->createElement('title');
        //$svg->firstChild;
        $svg->insertBefore($titleNode, $svg->firstChild);
      }
      // $svg->setAttribute('title', $title);
      $titleNode->textContent = $title;
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
