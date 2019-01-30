<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

use Sphp\Html\Apps\HyperlinkGenerators\Sami\Sami;
use Sphp\Html\Apps\HyperlinkGenerators\Sami\SamiUrlGenerator;
use Sphp\Html\Apps\HyperlinkGenerators\ApiGen\ApiGen;
use Sphp\Html\Apps\HyperlinkGenerators\ApiGen\ApiGenUrlGenerator;
use Sphp\Html\Apps\HyperlinkGenerators\PHPManual\PHPManual;

/**
 * A factory for API manual linkers
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Factory {

  /**
   * @var Sami[] 
   */
  private static $samis = [];

  /**
   * @var ApiGen[] 
   */
  private static $apigens = [];

  /**
   * @var PHPManual
   */
  private static $phpManual;

  /**
   * @var FoundationDocsLinker
   */
  private static $foundation;

  /**
   * @var W3schools
   */
  private static $w3schools;

  /**
   * Returns a instance
   * 
   * @param  string $path
   * @return ApiGen singleton API linker
   */
  public static function sami(string $path = 'API/sami/'): Sami {
    if (!array_key_exists($path, self::$samis)) {
      $instance = new Sami(new SamiUrlGenerator($path));
      $instance->setDefaultHyperlinkAttributes(['class' => 'api sphp']);
      self::$samis[$path] = $instance;
    } else {
      $instance = self::$samis[$path];
    }
    return $instance;
  }

  /**
   * Returns a singleton instance of ApiGen API linker
   * 
   * @param  string $path
   * @return ApiGen singleton API linker
   */
  public static function apigen(string $path = null): ApiGen {
    if ($path === null) {
      $path = '';
    }
    if (!array_key_exists($path, self::$apigens)) {
      $instance = new ApiGen(new ApiGenUrlGenerator($path));
      self::$apigens[$path] = $instance;
    } else {
      $instance = self::$apigens[$path];
    }
    return $instance;
  }

  /**
   * Returns a singleton instance of PHPManual API linker
   * 
   * @return PHPManual singleton API linker
   */
  public static function phpManual(): PHPManual {
    if (self::$phpManual === null) {
      self::$phpManual = new PHPManual();
      self::$phpManual->setDefaultHyperlinkAttributes(['class' => 'api php']);
    }
    return self::$phpManual;
  }

  /**
   * Returns a singleton instance of Foundation for sites API linker
   * 
   * @return FoundationDocsLinker singleton API linker
   */
  public static function foundation(): FoundationDocsLinker {
    if (self::$foundation === null) {
      self::$foundation = new FoundationDocsLinker();
    }
    return self::$foundation;
  }

  /**
   * Returns a singleton instance of W3schools API linker
   * 
   * @return W3schools singleton API linker
   */
  public static function w3schools(): W3schools {
    if (self::$w3schools === null) {
      self::$w3schools = (new W3schools())->setDefaultHyperlinkAttributes(['class' => 'api']);
    }
    return self::$w3schools;
  }

}
