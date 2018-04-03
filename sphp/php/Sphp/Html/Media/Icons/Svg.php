<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Media\Icons;
use Sphp\Stdlib\Networks\RemoteResource;
/**
 * Description of SVGLoader
 *
 * @author samih
 */
class Svg implements \Sphp\Html\Content, IconInterface {

  use \Sphp\Html\ContentTrait;

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
    if (RemoteResource::getMimeType($url) !== "image/svg+xml") {
      throw new \Sphp\Exceptions\InvalidArgumentException("fucked up remote file ($url)");
    }
    $svg = file_get_contents($url);
    return new static($svg, $sreenreaderLabel);
  }

}
