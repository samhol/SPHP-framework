<?php

/**
 * AbstractLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

if (!defined("Sphp\Html\Apps\Manual\DEFAULT_APIGEN")) {
  define('Sphp\Html\Apps\Manual\DEFAULT_APIGEN', 'http://documentation.samiholck.com/apigen/');
}

use Sphp\Html\Apps\Manual\DEFAULT_APIGEN;

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
   * @var ApiGen[] 
   */
  private static $apigens = [];
  /**
   *
   * @var ApiGen[] 
   */
  private static $phpManuals = [];

  /**
   * 
   * @param  string $path
   * @return ApiGen
   */
  public static function apigen($path = DEFAULT_APIGEN, $target = "apigen") {
    if ($path === null) {
      $path = DEFAULT_APIGEN;
    }
    if (!array_key_exists($path, self::$apigens)) {
      $instance = new ApiGen(new UrlGenerator($path, $target));
      self::$apigens[$path] = $instance;
    } else {
      $instance = self::$apigens[$path];
    }
    return $instance;
  }

  /**
   * 
   * @param  string|null $path
   * @return self default instance of linker
   */
  public static function get() {
    if (self::$instance === null) {
      self::$instance = (new static());
    }

    return self::$instance;
  }
  /**
   * 
   * @return PHPManual
   */
  public static function phpManual($target = 'phpman') {
    if (self::$phpManuals === null) {
      self::$phpManuals = (new PHPManual($target));
    }

    return new PHPManual($target);
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
