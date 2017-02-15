<?php

/**
 * PHPConfig.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Config;

use Sphp\Data\Arrayable;
use Sphp\Core\Types\Arrays;

/**
 * Implements class for managing PHP settings
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PHPConfig implements Arrayable {

  /**
   * the config variable name value pairs container
   *
   * @var mixed[]
   */
  private $setters = [];

  public function __construct(Ini $ini = null) {
    $this->setters = [];
    if ($ini === null) {
      $ini = new Ini();
    }
    $this->ini = $ini;
  }
  public function __destruct() {
    unset($this->setters, $this->ini);
  }

  /**
   * 
   * @param  string $fun
   * @param  mixed[] $params
   * @param  mixed $callId
   * @return self for PHP Method Chaining
   */
  private function setFunc($fun, array $params = [], $callId = null) {
    if ($callId === null) {
      unset($this->setters[$fun]);
      $callId = 0;
    }
    $this->setters[$fun][$callId] = $params;
    return $this;
  }

  /**
   * Sets the locale information
   *
   * **`$category` constant values:**
   *
   * * {@link LC_ALL} for all of the below
   * * {@link LC_COLLATE} for string comparison, see {@link strcoll()}
   * * {@link LC_CTYPE} for character classification and conversion, for example {@link strtoupper()}
   * * {@link LC_MONETARY} for localeconv()
   * * {@link LC_NUMERIC} for decimal separator (See also {@link localeconv()})
   * * {@link LC_TIME} for date and time formatting with {@link strftime()}
   * * {@link LC_MESSAGES} for system responses (available if PHP was compiled with libintl)
   *
   * @param  int $category a named constant specifying the category of the functions affected by the locale setting:
   * @param  string $locale the name of the locale
   * @return boolean true if the setting was succesfull and false otherwise
   * @link   http://php.net/manual/en/function.setlocale.php
   */
  public function setLocale($category, $locale) {
    $this->setFunc('setLocale', [$locale], $category);
    setLocale($category, $locale) !== false;
    return $this;
  }

  /**
   * Sets the locale information for system responses
   *
   * @param  string|null $locale the locale information for system responses
   * @return boolean true if the setting was succesfull and false otherwise
   * @link   http://php.net/manual/en/function.setlocale.php
   */
  public function setMessageLocale($locale) {
    $this->setLocale(\LC_MESSAGES, $locale);
    return $this;
  }

  /**
   * Set the internal character encoding
   *
   * @param  mixed $encoding character encoding: default is `utf-8`
   * @return self for PHP Method Chaining
   */
  public function setEncoding($encoding = 'UTF-8') {
    $this->setFunc('mb_internal_encoding', [$encoding]);
    mb_internal_encoding($encoding);
    return $this;
  }

  /**
   * Sets the default timezone used by all date/time functions in a script
   *
   * @param  string $timezone the timezone identifier
   * @return self for PHP Method Chaining
   */
  public function setDefaultTimezone($timezone) {
    $this->setFunc('date_default_timezone_set', [$timezone]);
    date_default_timezone_set($timezone);
    return $this;
  }


  /**
   * Sets which PHP errors are reported
   *
   * @param  int $level the new error reporting level
   * @return self for PHP Method Chaining
   */
  public function setErrorReporting($level) {
    $this->setFunc('error_reporting', [$level]);
    error_reporting($level);
    //ini_set("display_errors", "1");
    return $this;
  }
  
  /**
   * 
   * @param  callable $handler
   * @return self for PHP Method Chaining
   */
  public function setExceptionHandler(callable $handler) {
    $this->setFunc('set_exception_handler', [$handler]);
    return $this;
  }

  /**
   * Initializes all PHP settings defined by the instance
   * 
   * Previous settings are replaced
   * 
   * @return self for PHP Method Chaining
   */
  public function init() {
    foreach ($this->setters as $func => $call) {
      foreach ($call as $params) {
        call_user_func_array($func, $params);
      }
    }
    return $this;
  }

  public function toArray() {
    $arr = [];
    $arr['php'] = Arrays::copy($this->setters);
    return $arr;
  }

}
