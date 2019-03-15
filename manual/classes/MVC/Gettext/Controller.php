<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp;

use Sphp\I18n\Gettext\PoFileIterator;

/**
 * Description of Controller
 *
 * @author Sami
 */
class Controller {

  /**
   *
   * @var PoFileIterator
   */
  private $poFileParser;

  public function __construct(PoFileIterator $poFileParser) {
    $this->poFileParser = $poFileParser;
  }

  public function filter(array $request) {
    $result = $this->poFileParser;
    if (isset($request['msgType']) && isset($request['contains'])) {

      $result = $this->poFileParser->set($request['amount'], $request['currency']);
    }
  }

}
