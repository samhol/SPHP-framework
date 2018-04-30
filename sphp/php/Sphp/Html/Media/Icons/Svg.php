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
class Svg implements \Sphp\Html\Content, IconInterface {

  use \Sphp\Html\ContentTrait;

  private static $src = [];

  public function __construct(string $svg, string $sreenreaderLabel = null) {
    $this->svg = $svg;
  }

  public function setSreenreaderText(string $sreenreaderLabel = null) {
    
  }

  public function getHtml(): string {
    return $this->svg;
  }

  public static function fromFile(string $path, string $sreenreaderLabel = null): Svg {
    if (!is_file($path)) {
      throw new \Sphp\Exceptions\InvalidArgumentException;
    }
    $svg = file_get_contents($path);
    return new static($svg, $sreenreaderLabel);
  }

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
        self::$src[$url] = '<svg></svg>';
      }

      //throw new \Sphp\Exceptions\InvalidArgumentException("fucked up remote file ($url)");
    }

    return new static(self::$src[$url], $sreenreaderLabel);
  }

}
