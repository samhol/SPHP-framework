<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Manual\MVC\Intro;

/**
 * Description of GithubUrlBuilder
 *
 * @author samih
 */
class GithubUrlBuilder {

  //put your code here

  public function __invoke($component): string {
    return "https://github.com/$component";
  }

}
