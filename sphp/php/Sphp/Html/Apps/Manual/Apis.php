<?php

/**
 * AbstractLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

/**
 * A factory class for api linkers
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Apis {

  /**
   * 
   * @param type $path
   * @return ApiGen
   */
  public static function apigen($path = null) {
    if ($path === null) {
      $path = 'http://documentation.samiholck.com/apigen/';
    }
    return ApiGen::get($path);
  }

  /**
   * 
   * @return PHPManual
   */
  public static function phpManual() {
    return PHPManual::get();
  }

  /**
   * 
   * @return FoundationDocsLinker
   */
  public static function foundation() {
    return FoundationDocsLinker::get();
  }

  /**
   * 
   * @return W3schools
   */
  public static function w3schools() {
    return W3schools::get();
  }

}
