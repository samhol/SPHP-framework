<?php

/**
 * PHPConfig.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config;

/**
 * Implements class for managing PHP settings
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PHPConfig {

  /**
   * the config variable name value pairs container
   *
   * @var mixed[]
   */
  private $setters = [];

  /**
   *
   * @var Ini
   */
  private $ini;

  /**
   *
   * @param Ini $ini
   */
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
   * @return Ini
   */
  public function ini() {
    return $this->ini;
  }

  /**
   *
   * @param  string $fun
   * @param  mixed[] $params
   * @return self for a fluent interface
   */
  private function setFunc($fun, array $params = []) {
    $this->setters[] = [$fun, $params];
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
    $this->setFunc('setLocale', [$category, $locale]);
    return $this;
  }

  /**
   * Sets the locale information for system responses
   *
   * @param  string|null $locale the locale information for system responses
   * @return boolean true if the setting was successful and false otherwise
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
   * @return self for a fluent interface
   */
  public function setEncoding($encoding = 'UTF-8') {
    $this->setFunc('mb_internal_encoding', [$encoding]);
    //mb_internal_encoding($encoding);
    return $this;
  }

  /**
   * Sets the default timezone used by all date/time functions in a script
   *
   * @param  string $timezone the timezone identifier
   * @return self for a fluent interface
   */
  public function setDefaultTimezone($timezone) {
    $this->setFunc('date_default_timezone_set', [$timezone]);
    //date_default_timezone_set($timezone);
    return $this;
  }

  /**
   * Sets which PHP errors are reported
   *
   * @param  int $level the new error reporting level
   * @return self for a fluent interface
   * @link   http://php.net/manual/en/function.error-reporting.php PHP error reporting
   */
  public function setErrorReporting($level = 0) {
    $this->setFunc('error_reporting', [$level]);
    $display = ($level > 0) ? 1 : 0;
    $this->ini->set('display_errors', $display);
    return $this;
  }

  /**
   * Sets a user-defined exception handler function
   *
   * @param  callable $handler
   * @return self for a fluent interface
   * @link   http://php.net/manual/en/function.set-exception-handler.php PHP manual
   */
  public function setExceptionHandler(callable $handler) {
    $this->setFunc('set_exception_handler', [$handler]);
    return $this;
  }

  /**
   * Sets a user-defined exception handler function
   *
   * @param  callable $handler
   * @return self for a fluent interface
   * @link   http://php.net/manual/en/function.set-exception-handler.php PHP manual
   */
  public function setErrorHandler(callable $handler) {
    $this->setFunc('set_error_handler', [$handler]);
    return $this;
  }

  /**
   * Initializes all PHP settings defined by the instance
   *
   * Previous settings are replaced
   *
   * @return self for a fluent interface
   */
  public function init() {
    foreach ($this->setters as $call) {
      call_user_func_array($call[0], $call[1]);
    }
    $this->ini->init();
    return $this;
  }

}
