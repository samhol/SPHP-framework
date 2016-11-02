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

  /**
   * Constructs a new instance
   * 
   * @param string $class
   * @param PHPManualUrlGenerator|null $p
   * @param string|null $defaultTarget
   * @param string|string[]|null $defaultCssClasses
   */
  public function __construct($class, PHPManualUrlGenerator $p = null, $defaultTarget = null, $defaultCssClasses = null) {
    if ($p === null) {
      $p = new PHPManualUrlGenerator();
    }
    parent::__construct($class, $p, $defaultTarget, $defaultCssClasses);
  }

  public function hyperlink($url = null, $content = null, $title = null) {
    if ($title === null) {
      $title = 'PHP manual';
    } else {
      $title = 'PHP manual: ' . $title;
    }
    return parent::hyperlink($url, $content, $title);
  }

}
