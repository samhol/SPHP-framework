<?php

/**
 * HttpCodeCollection.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Http;

use Sphp\Stdlib\Path;
use Sphp\Stdlib\Parser;
use Sphp\Exceptions\InvalidArgumentException;
use Iterator;

/**
 * Implements a HTTP code object collection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HttpCodeCollection implements Iterator {

  /**
   *
   * @var array 
   */
  private static $errors;

  /**
   * 
   */
  public function __construct() {
    if (!is_array(self::$errors)) {
      self::$errors = Parser::fromFile(Path::get()->local('/sphp/yaml/http_errors.yaml'));
    }
    foreach(self::$errors as $code => $v) {
      $this->codes[$code] = new HttpCode($code, $v['message'], $v['description']);
    }
  }

  /**
   * Returns
   *
   * @param  int $code HTTP message code
   * @return string
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function getCode($code = null) {
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
   * @throws \Sphp\Exceptions\InvalidArgumentException
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
   * @throws \Sphp\Exceptions\InvalidArgumentException
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
  public function contains($code) {
    return array_key_exists($code, self::$errors);
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->codes);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->codes);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->codes);
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    reset($this->codes);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid() {
    return false !== current($this->codes);
  }
}
