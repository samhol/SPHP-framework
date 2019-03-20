<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Apps;

/**
 * Description of CookieBanner
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CookieBanner extends \Sphp\Html\AbstractComponent {

  public function __construct() {
    parent::__construct('div');
    $this->addCssClass('sphp', 'callout', 'cookie-banner');
  }

  public function setPolicy() {
    
  }

  public function contentToString(): string {
    return '<p>Our website uses cookies. By continuing we assume your permission to deploy cookies, as detailed in our <a href = "yourPolicy">privacy policy</a>.
    <span class = "cookie-accept" title = "Okay, close"><img src = "img/close.png" alt = "Close"/></span></p>';
  }

}
