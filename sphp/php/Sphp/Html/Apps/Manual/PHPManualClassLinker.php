<?php

/**
 * PHPManualClassLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

/**
 * PHP class link generator pointing to an exising PHP Manual documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PHPManualClassLinker extends AbstractClassLinker {

  use PHPManualTrait;

  public function __construct($class, PHPManualClassUrlGenerator $p = null) {
    if ($p === null) {
      $p = new PHPManualClassUrlGenerator($class);
    }
    parent::__construct($class, $p);
    $this->setDefaultCssClasses("api phpman");
  }

}
