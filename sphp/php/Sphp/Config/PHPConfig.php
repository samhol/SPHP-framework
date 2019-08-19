<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config;

use Sphp\Stdlib\Arrays;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;
use Sphp\Config\Exception\ConfigurationException;

/**
 * Implements class for managing PHP settings
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PHPConfig {

  /**
   * Set the internal character encoding
   *
   * @param  mixed $encoding character encoding: default is `UTF-8`
   * @return $this for a fluent interface
   * @throws ConfigurationException if character encoding setting fails
   */
  public function setCharacterEncoding(string $encoding = 'UTF-8') {
    ErrorToExceptionThrower::getInstance(ConfigurationException::class)->start();
    mb_internal_encoding($encoding);
    ErrorToExceptionThrower::getInstance(ConfigurationException::class)->stop();
    return $this;
  }

  /**
   * Sets the default time zone used by all date/time functions in a script
   *
   * @param  string $timezone the time zone identifier
   * @return $this for a fluent interface
   * @throws ConfigurationException if given timezone is invalid
   */
  public function setDefaultTimezone(string $timezone) {
    $old = date_default_timezone_get();
    if ($timezone !== $old) {
      ErrorToExceptionThrower::getInstance(ConfigurationException::class)->start();
      $valid = date_default_timezone_set($timezone);
      if (!$valid) {
        throw new ConfigurationException("Given timezone string '$timezone' is invalid");
      }
    }
    ErrorToExceptionThrower::getInstance(ConfigurationException::class)->stop();
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
   * Returns all included paths as an array
   * 
   * @return string[] all included paths 
   */
  public function getIncludePaths(): array {
    $pathString = \get_include_path();
    return \array_unique(\explode(\PATH_SEPARATOR, $pathString));
  }

  /**
   * Checks if given path exists in included paths
   * 
   * @return bool true if given path exists in included paths
   */
  public function containsIncludePath(string $path): bool {
    $paths = $this->getIncludePaths();
    return \in_array($path, $paths);
  }

  /**
   * Inserts new paths to the include_path configuration option
   * 
   * @param  string|string[],... $paths new include paths
   * @return $this for a fluent interface
   * @throws ConfigurationException if insertion of given include paths fails
   * @link   http://php.net/manual/en/function.set-include-path.php PHP manual
   */
  public function insertIncludePaths(...$paths) {
    $flatten = Arrays::flatten($paths);
    $pathArray = \array_unique(\array_merge($this->getIncludePaths(), $flatten));
    $newPaths = \implode(\PATH_SEPARATOR, $pathArray);
    $isset = \set_include_path($newPaths);
    if (!$isset) {
      throw new ConfigurationException('Failed inserting given include paths');
    }
    return $this;
  }

}
