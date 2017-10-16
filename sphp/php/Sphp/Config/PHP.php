<?php

/**
 * PHP.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config;

/**
 * Utility class for PHP configuration
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class PHP {

  /**
   * @var PHPConfig 
   */
  private static $configurator;

  /**
   * @var Ini[] 
   */
  private static $inis;

  /**
   * Returns the PHP configuration instance
   * 
   * @return PHPConfig singleton PHP configuration instance
   */
  public static function config(): PHPConfig {
    if (self::$configurator === null) {
      self::$configurator = new PHPConfig();
    }
    return self::$configurator;
  }

  /**
   * Returns a named PHP INI configuration instance
   * 
   * @param  string $name the name of the instance
   * @return Ini the instance (created if not present)
   */
  public static function ini(string $name): Ini {
    if (!isset(self::$inis[$name])) {
      return self::storeIni($name, new Ini());
    }
    return self::$inis[$name];
  }

  /**
   * Sets a named PHP INI configuration instance
   * 
   * @param  string $name the name of the instance
   * @return Ini the PHP INI configuration instance stored
   */
  public static function storeIni(string $name, Ini $ini): Ini {
    self::$inis[$name] = $ini;
    return self::$inis[$name];
  }

  /**
   * Checks if the PHP engine is 32bit
   * 
   * @return bool true if the PHP engine is 32bit false otherwise
   */
  public static function is32bit(): bool {
    return PHP_INT_SIZE === 4;
  }

  /**
   * Checks if the PHP engine is 64bit
   * 
   * @return bool true if the PHP engine is 64bit false otherwise
   */
  public static function is64bit(): bool {
    return PHP_INT_SIZE === 8;
  }

  /**
   * Returns the bit version of the PHP engine
   * 
   * @return int the bit version of the PHP engine
   */
  public static function getBitVersion(): int {
    return PHP_INT_SIZE * 8;
  }

}
