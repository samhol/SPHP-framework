<?php

/*
 * The MIT License
 *
 * Copyright 2018 Sami Holck <sami.holck@gmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Sphp\Http\Headers;

use Iterator;
use ReflectionClass;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Utility class for PHP header operations
 *
 * @method \Sphp\Http\Headers\Location redirecdTo(string $content = null) creates nd inserts a header object
 * @method \Sphp\Http\Headers\Location location(string $content = null) creates nd inserts a header object
 * @method \Sphp\Http\Headers\AllowOrigin allowOrigin(string $content = null) creates nd inserts a header object
 * @method \Sphp\Http\Headers\AllowMethods allowMethods(string $content = null) creates nd inserts a header object
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Headers implements Iterator {

  private $headers = [];

  /**
   * list of Header
   *
   * @var Header[]
   */
  private static $typeMap = array(
      'location' => Location::class,
      'redirectTo' => Location::class,
      'allowOrigin' => AllowOrigin::class,
      'contentType' => ContentType::class,
      'allowMethods' => AllowMethods::class,
  );

  /**
   * Creates a HTML object
   *
   * @param  string $name the name of the component
   * @param  array $arguments 
   * @return HeaderInterface the corresponding component
   * @throws BadMethodCallException
   */
  public function __call(string $name, array $arguments): Header {
    if (!isset(static::$typeMap[$name])) {
      throw new BadMethodCallException("Method $name does not exist");
    }
    if (is_string(static::$typeMap[$name])) {
      static::$typeMap[$name] = new ReflectionClass(static::$typeMap[$name]);
    }
    $reflectionClass = static::$typeMap[$name];
    if ($reflectionClass->getName() == EmptyTag::class || $reflectionClass->getName() == ContainerTag::class) {
      array_unshift($arguments, $name);
    }
    $instance = static::$typeMap[$name]->newInstanceArgs($arguments);
    $this->headers[$instance->getName()] = $instance;
    return $instance;
  }

  /**
   * 
   * @param  string $name
   * @return bool
   */
  public function contains(string $name): bool {
    return array_key($name, $this->headers);
  }

  /**
   * 
   * @param  Header $header
   * @return eader
   * @throws InvalidArgumentException
   */
  public function set(Header $header): Header {
    if ($this->contains($header->getName())) {
      throw new InvalidArgumentException();
    }
    $this->headers[$header->getName()] = $header;
    return $header;
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->headers);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->headers);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->headers);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->headers);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->headers);
  }

  public function execute() {
    foreach ($this as $header) {
      $header->execute();
    }
  }

  /**
   * 
   * @return type
   */
  public function getHttpResponseCode() {
    return http_response_code();
  }

  /**
   * Sets (not replace) a raw HTTP header
   * 
   * @param string $string
   */
  public static function setHeader(string $string) {
    header($string, false);
  }

  /**
   * Replaces a raw HTTP header
   * 
   * @param string $string
   */
  public static function replaceHeader(string $string) {
    header($string, true);
  }

  /**
   * Redirects the browser to the given location
   * 
   * "Location:" header. Not only does it send this header back to the browser, 
   * but it also returns a REDIRECT (302) status code to the browser unless the 
   * 201 or a 3xx status code has already been set.
   * 
   * @param string|URL $url the URL to redirect
   */
  public static function redirectTo($url) {
    header("Location: $url");
    exit;
  }

  /**
   * Creates a Download dialog
   * 
   * @param string $originalPath
   * @param string $filetype the mime type of the file
   * @param string $filename optional
   * @param string $charset optional
   */
  public static function setDownloadDialog($originalPath, $filetype, $filename, $charset = "utf-8") {
    self::setContentType($filetype, $charset);
    header("Content-Disposition: attachment; filename=\"$filename\"");
    readfile($originalPath);
  }

}
