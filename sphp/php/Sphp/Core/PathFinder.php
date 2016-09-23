<?php

/**
 * PathFinder.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core;

use Sphp\Data\Arrayable;

/**
 * Class implements an absolute path finder 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PathFinder implements Arrayable {

  const ROOT = "";
  const SPHP = "sphp/";
  const SPHP_CSS = "sphp/css/";
  const SPHP_JS = "sphp/js";
  const SPHP_IMG_CACHE = "sphp/image/cache/";

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
   * Constructs a new instance
   * 
   * **IMPORTANT:** 
   * 
   * * the `$localRoot` should be an Absolute path so that all the subfolders are reachable.
   * * If either `$localRoot` or `$httpRoot` is not given the instance uses `$_SERVER` values if present
   * 
   * @param  string $localRoot the local filesystem root path
   * @param  string $httpRoot the root url of the application
   * @throws ConfigurationException if paths cannot be resolved
   */
  public function __construct($localRoot = null, $httpRoot = null) {
    $this->initHttpRoot($httpRoot);
    $this->initLocalRoot($localRoot);
  }

  /**
   * 
   * @param  string|null $httpRoot
   * @return self for PHP Method Chaining
   * @throws ConfigurationException if path cannot be resolved
   */
  private function initHttpRoot($httpRoot = null) {
    if ($httpRoot === null) {  
      $host = filter_input(INPUT_SERVER, "HTTP_HOST", FILTER_SANITIZE_SPECIAL_CHARS);
      $this->httpRoot = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $host . '/';
    } else {
      $this->httpRoot = $httpRoot;
      return $this;
    }
  }

  /**
   * 
   * **IMPORTANT:** the `$root` path should be an Absolute path so that all the subfolders are reachable.
   * 
   * @param  string|null $root
   * @return self for PHP Method Chaining
   * @throws ConfigurationException if path cannot be resolved
   */
  private function initLocalRoot($root = null) {
    if ($root === null) {
      $root = filter_input(INPUT_SERVER, "DOCUMENT_ROOT", FILTER_SANITIZE_SPECIAL_CHARS);
      if ($root === false || $root === null) {
        throw new ConfigurationException("document root not specified");
      }
    }
    if (!is_dir($root)) {
      throw new ConfigurationException("path '$root' does not exist");
    }
    $this->localRoot = $root . "/";
    return $this;
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
   * @throws ConfigurationException if path cannot be resolved
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
   * @throws ConfigurationException if path cannot be resolved
   */
  public function local($relativePath = self::ROOT) {
    if (!$this->isPathFromRoot($relativePath)) {
      throw new ConfigurationException("Relative path '$relativePath' does not exist");
    }
    return $this->localRoot . $relativePath;
  }

  /**
   * Loads a local file to the application
   *
   * @param  string $filePath
   * @return self for PHP Method Chaining
   * @throws ConfigurationException if path cannot be resolved
   */
  public function loadFile($filePath) {
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

  /**
   * {@inheritdoc}
   */
  public function toArray() {
    return [
        "http" => $this->http(),
        "file" => $this->local()
    ];
  }

}
