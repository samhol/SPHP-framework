<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Sphp\Html\Foundation\Sites\Containers\Callout;

/**
 * Description of Viewer
 *
 * @author Sami Holck
 */
class Viewer implements \Sphp\Html\ContentInterface {

  use Sphp\Html\ContentTrait;

  private $converter;
  private $code;

  public function __construct(\Sphp\Core\Http\HttpErrorParser $converter, $code) {

    $this->converter = $converter;

    $this->code = $code;
  }

  public function getHtml() {
    $title = $this->code . ': ' . $this->converter->getMessage($this->code);
    $callout = new Callout();
    $callout->setColor('alert');
    $callout->appendMd(<<<TEXT
#$title{.error}
        

TEXT
    );
    return $callout->getHtml();
  }

}
