<?php

/**
 * Apis.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

if (!defined("Sphp\Html\Apps\Manual\DEFAULT_APIGEN")) {
  define('Sphp\Html\Apps\Manual\DEFAULT_APIGEN', 'http://documentation.samiholck.com/apigen/');
}

use Sphp\Html\Apps\Manual\DEFAULT_APIGEN;

/**
 * A factory for API manual linkers
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
   * @var PHPManual
   */
  private static $phpManual;

  /**
   *
   * @var W3schools[] 
   */
  private static $w3schools;

  /**
   * 
   * @param  string $path
   * @param  string|null $target
   * @return ApiGen
   */
  public static function apigen($path = DEFAULT_APIGEN, $target = "apigen") {
    if ($path === null) {
      $path = DEFAULT_APIGEN;
    }
    if (!array_key_exists($path, self::$apigens)) {
      $instance = new ApiGen(new ApiGenUrlGenerator($path), $target);
      self::$apigens[$path] = $instance;
    } else {
      $instance = self::$apigens[$path];
      $instance->setDefaultTarget($target);
    }
    return $instance;
  }

  /**
   * 
   * @return PHPManual
   */
  public static function phpManual($target = 'phpman') {
    if (self::$phpManual === null) {
      self::$phpManual = (new PHPManual($target));
    } else {
      self::$phpManual->setDefaultTarget($target);
    }

    return self::$phpManual;
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
  public static function w3schools($target = 'w3schools') {
    if (self::$w3schools === null) {
      self::$w3schools = new W3schools($target);
    }else {
      self::$w3schools->setDefaultTarget($target);
    }
    return self::$w3schools;
  }

}
