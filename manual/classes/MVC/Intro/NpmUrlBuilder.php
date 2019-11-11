<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Manual\MVC\Intro;

/**
 * Description of NpmUrlBuilder
 *
 * @author samih
 */
class NpmUrlBuilder {

  //put your code here<?php
  //put your code here

  public function __invoke($component): string {
    return "https://www.npmjs.com/package/$component";
  }

  public function build(string $component): string {
    return "https://www.npmjs.com/package/$component";
  }

}
