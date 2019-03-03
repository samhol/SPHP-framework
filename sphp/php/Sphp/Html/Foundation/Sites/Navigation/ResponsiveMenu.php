<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

/**
 * Description of ResponsiveMenu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ResponsiveMenu extends AbstractMenu {

  public function setDefaultrOientation(string $orientation) {
    if ($orientation === Menu::VERTICAL) {
      $this->cssClasses()->add('vertical');
    } else {
      $this->cssClasses()->remove('vertical');
    }
    return $this;
  }

  public function setOrientationFor(string $orientation, string $screenSize) {
    $this->cssClasses()->add("$screenSize-$orientation");

    return $this;
  }

}
