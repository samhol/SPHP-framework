<?php

/**
 * ExceptionPrinter.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Http;

use Sphp\Core\Path;
use Sphp\Core\Util\FileUtils;
use InvalidArgumentException;

/**
 * The Logger class is responsible for printing the uncaught exceptions as an HTML element
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HttpErrorParser {

  /**
   *
   * @var array 
   */
  private static $errors;

  public function __construct() {
    if (!is_array(self::$errors)) {
      self::$errors = FileUtils::parseYaml(Path::get()->local('/sphp/yaml/http_errors.yaml'));
    }
    foreach(self::$errors as $code => $v) {
      $this->codes[$code] = new HttpCode($code, $v['message'], $v['description']);
    }
  }

  public function currentCode() {
    $errorCode = filter_input(INPUT_SERVER, 'REDIRECT_STATUS', FILTER_SANITIZE_NUMBER_INT);
    return $errorCode;
  }

  /**
   * Returns
   *
   * @param  int $code HTTP message code
   * @return string
   * @throws InvalidArgumentException
   */
  public function getHttpCode($code = null) {
    if ($code === null) {
      $code = $this->currentCode();
    }
    if (!array_key_exists($code, self::$errors)) {
      throw new InvalidArgumentException("HTTP code '$code' has no message stored");
    }
    return $this->codes[$code];
  }

  /**
   * Returns
   *
   * @param  int $code HTTP message code
   * @return string
   * @throws InvalidArgumentException
   */
  public function getMessage($code = null) {
    if ($code === null) {
      $code = $this->currentCode();
    }
    if (!array_key_exists($code, self::$errors)) {
      throw new InvalidArgumentException("HTTP code '$code' has no message stored");
    }
    return self::$errors[$code]['message'];
  }

  /**
   * Returns
   *
   * @param  int $code HTTP message code
   * @return string
   * @throws InvalidArgumentException
   */
  public function getDescription($code = null) {
    if ($code === null) {
      $code = $this->currentCode();
    }
    if (!array_key_exists($code, self::$errors)) {
      throw new InvalidArgumentException("HTTP code '$code' has no description stored");
    }
    return self::$errors[$code]['description'];
  }

  /**
   * Returns
   *
   * @param  int $code HTTP message code
   * @return boolean
   */
  public function exists($code) {
    return array_key_exists($code, self::$errors);
  }

}
