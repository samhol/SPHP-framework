<?php

/**
 * PathFinder.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core;

use Sphp\Data\Arrayable as Arrayable;

/**
 * Class implements an absolute path finder 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
 * @version 1.0.0
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
   * @param  string $localRoot
   * @param  string $httpRoot the root path to the sphp directory
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
      if (true) {
        
      }
      $this->httpRoot = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
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
