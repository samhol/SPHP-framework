<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Config;

/**
 * Description of PHP
 *
 * @author samih
 */
abstract class PHP {

  /**
   * @var PHPConfig 
   */
  private static $configurator;

  /**
   * 
   * 
   * @return PHPConfig
   */
  public static function config(): PHPConfig {
    if (self::$configurator === null) {
      self::$configurator = new PHPConfig();
    }
    return self::$configurator;
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
