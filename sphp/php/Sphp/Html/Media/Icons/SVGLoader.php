<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Media\Icons;

/**
 * Description of SVGLoader
 *
 * @author samih
 */
class SVGLoader implements \Sphp\Html\Content, IconInterface {

  use \Sphp\Html\ContentTrait;

  public function __construct(string $path, string $sreenreaderLabel = null) {
    $this->svg = file_get_contents($path);
  }

  public function setSreenreaderText(string $sreenreaderLabel = null) {
    
  }

  public function getHtml(): string {
    return $this->svg;
  }

  public static function fromFile(string $path, string $sreenreaderLabel = null): SvgLoader {
    return new static($path, $sreenreaderLabel);
  }

}
