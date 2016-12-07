<?php

/**
 * Router.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core;

use Sphp\Data\Arrayable;

/**
 * Class implements a file system router
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Router implements Arrayable {

  const ROOT = '';
  const SPHP = 'sphp/';
  const SPHP_CSS = 'sphp/css/';
  const SPHP_JS = 'sphp/js';
  const SPHP_IMG_CACHE = 'sphp/image/cache/';

  /**
   * The local path to the document  root
   *
   * @var string
   */
  private $localRoot;

  /**
   * The http path to the document  root
   *
   * @var string
   */
  private $httpRoot;

  /**
   *
   * @var self
   */
  private static $instance;

  /**
   * Constructs a new instance
   * 
   * **IMPORTANT:** 
   * 
   * * the `$localRoot` should be an Absolute path so that all the subfolders are reachable.
   * * If either `$localRoot` or `$httpRoot` is not given the instance uses `$_SERVER` values if present
   * 
   * @throws ConfigurationException if either local or http path cannot be resolved
   */
  protected function __construct() {
    $host = filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_SPECIAL_CHARS);
    if (!is_string($host)) {
      throw new ConfigurationException('HTTP host cannot be resolved');
    }
    $this->httpRoot = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $host . '/';
    $root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_SPECIAL_CHARS);
    if (!is_string($root)) {
      throw new ConfigurationException('Document root not specified');
    }
    $this->localRoot = $root . '/';
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->localRoot, $this->httpRoot);
  }

  /**
   * 
   * @param  string $relativePath
   * @return boolean true if relative path exists and false otherwise
   */
  public function isPathFromRoot($relativePath) {
    return file_exists($this->localRoot . $relativePath);
  }

  /**
   * Returns the http path from the root
   *
   * @param  string $relativePath
   * @return string the http path from the root
   * @throws ConfigurationException if the  path cannot be resolved
   */
  public function http($relativePath = self::ROOT) {
    if (!$this->isPathFromRoot($relativePath)) {
      throw new ConfigurationException("Relative path '$relativePath' does not exist");
    }
    return $this->httpRoot . $relativePath;
  }

  /**
   * Returns the local path from the root
   *
   * @param  string $relativePath
   * @return string the local path from the root
   * @throws ConfigurationException if the path cannot be resolved
   */
  public function local($relativePath = self::ROOT) {
    if (!$this->isPathFromRoot($relativePath)) {
      throw new ConfigurationException("Relative path '$relativePath' does not exist");
    }
    return $this->localRoot . $relativePath;
  }

  /**
   * Loads a local file once to the application
   *
   * @param  string $filePath
   * @return self for PHP Method Chaining
   * @throws ConfigurationException if path cannot be resolved
   */
  public function requireOnce($filePath) {
    $path = $this->local($filePath);
    if (!is_file($path)) {
      throw new ConfigurationException("Relative path '$filePath' contains no file");
    }
    require_once $path;
    return $this;
  }

  /**
   * Returns the string representation of the configuration data
   *
   * @return string the string representation of the configuration data
   */
  public function __toString() {
    return var_export($this->toArray(), true);
  }

  public function toArray() {
    return [
        "http" => $this->http(),
        "file" => $this->local()
    ];
  }

  /**
   * Returns the singleton instance of the file system router
   * 
   * @return self singleton instance of the file system router
   * @throws ConfigurationException if either local or http path cannot be resolved
   */
  public static function get() {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
