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

  private $code;

  public function __construct(\Sphp\Core\Http\HttpCode $code) {
    $this->code = $code;
  }

  public function getHtml() {
    $cont = new Sphp\Html\Container();
    $cont->appendMd('#' . $this->code->getCode() . ': <small>' . $this->code->getMessage() . '</small>{.error}');
    $cont->appendMd($this->code->getDescription());
    $cont->appendMdFile(__DIR__ . '/general.md');
    return $cont->getHtml();
  }

}
