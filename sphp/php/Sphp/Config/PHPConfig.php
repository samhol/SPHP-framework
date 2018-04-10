<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config;

use Sphp\Exceptions\RuntimeException;
use Sphp\Stdlib\Arrays;

/**
 * Implements class for managing PHP settings
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PHPConfig {

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
   * @param  int $category a named constant specifying the category of the 
   *                       functions affected by the locale setting
   * @param  string $locale the name of the locale
   * @return $this for a fluent interface
   * @throws RuntimeException if the locale functionality is not implemented on 
   *                          the platform, the specified locale does not exist 
   *                          or the category name is invalid
   * @link   http://php.net/manual/en/function.setlocale.php
   */
  public function setLocale(int $category, string $locale) {
    $success = setLocale($category, $locale);
    if (!$success) {
      throw new RuntimeException("Failed setting the locale to '$locale");
    }
    return $this;
  }

  /**
   * Sets the locale information for system responses
   *
   * @param  string|null $locale the locale information for system responses
   * @return $this for a fluent interface
   * @throws RuntimeException if the locale functionality is not implemented on 
   *                          the platform, the specified locale does not exist 
   *                          or the category name is invalid
   * @link   http://php.net/manual/en/function.setlocale.php
   */
  public function setMessageLocale(string $locale) {
    $this->setLocale(\LC_MESSAGES, $locale);
    return $this;
  }

  /**
   * Set the internal character encoding
   *
   * @param  mixed $encoding character encoding: default is `UTF-8`
   * @return $this for a fluent interface
   * @throws RuntimeException if character encoding setting fails
   */
  public function setCharacterEncoding(string $encoding = 'UTF-8') {
    $valid = mb_internal_encoding($encoding);
    if (!$valid) {
      throw new RuntimeException("Failed setting character encoding to '$encoding'");
    }
    return $this;
  }

  /**
   * Sets the default time zone used by all date/time functions in a script
   *
   * @param  string $timezone the time zone identifier
   * @return $this for a fluent interface
   * @throws RuntimeException if given timezone is invalid
   */
  public function setDefaultTimezone(string $timezone) {
    $old = date_default_timezone_get();
    if ($timezone !== $old) {
      $valid = date_default_timezone_set($timezone);
      if (!$valid) {
        throw new RuntimeException("Given timezone string '$timezone' is invalid");
      }
    }
    return $this;
  }

  /**
   * Sets which PHP errors are reported
   *
   * @param  int $level the new error reporting level
   * @return $this for a fluent interface
   * @link   http://php.net/manual/en/function.error-reporting.php PHP error reporting
   */
  public function setErrorReporting(int $level) {
    $old = error_reporting();
    if ($level !== $old) {
      error_reporting($level);
    }
    $display = ($level > 0) ? 1 : 0;
    ini_set('display_errors', $display);
    return $this;
  }

  /**
   * 
   * @return string[]
   */
  public function getCurrentIncludePaths(): array {
    $pathString = get_include_path();
    return array_unique(explode(\PATH_SEPARATOR, $pathString));
  }

  /**
   * Inserts new paths to the include_path configuration option
   * 
   * @param  string|string[],... $paths new include paths
   * @return $this for a fluent interface
   * @throws RuntimeException if insertion of given include paths fails
   * @link   http://php.net/manual/en/function.set-include-path.php PHP manual
   */
  public function insertIncludePaths(...$paths) {
    $flatten = Arrays::flatten($paths);
    $pathArray = array_unique(array_merge($this->getCurrentIncludePaths(), $flatten));
    $newPaths = implode(\PATH_SEPARATOR, $pathArray);
    $isset = set_include_path($newPaths);
    if (!$isset) {
      throw new RuntimeException('Failed inserting given include paths');
    }
    return $this;
  }

}
