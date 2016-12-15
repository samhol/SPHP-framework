<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrorController
 *
 * @author Sami Holck
 */
class ErrorController {

  private $currencyConverter;

  public function __construct(\Sphp\Core\Http\HttpErrorParser $currencyConverter) {

    $this->currencyConverter = $currencyConverter;
  }

  public function convert($request) {

    if (isset($request['currency']) && isset($request['amount'])) {

      $this->currencyConverter->set($request['amount'], $request['currency']);
    }
  }

}
