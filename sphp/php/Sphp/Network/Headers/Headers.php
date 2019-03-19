<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network\Headers;

use ReflectionClass;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Utility class for PHP header operations
 *
 * @method \Sphp\Network\Headers\Location redirecdTo(string $content = null) creates nd inserts a header object
 * @method \Sphp\Network\Headers\Location location(string $content = null) creates nd inserts a header object
 * @method \Sphp\Network\Headers\AllowOrigin allowOrigin(string $content = null) creates nd inserts a header object
 * @method \Sphp\Network\Headers\AllowMethods allowMethods(string $content = null) creates nd inserts a header object
 * @method \Sphp\Network\Headers\MaxAge maxAge(int $maxAge) creates nd inserts a header object
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Headers {

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
      'maxAge' => MaxAge::class,
  );

  /**
   * Creates a Header object
   *
   * @param  string $name the name of the Header object
   * @param  array $arguments 
   * @return Header the corresponding component
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $arguments): Header {
    if (!isset(static::$typeMap[$name])) {
      throw new BadMethodCallException("Method $name does not exist");
    }
    $reflectionClass = new ReflectionClass(static::$typeMap[$name]);
    $instance = $reflectionClass->newInstanceArgs($arguments);
    return $instance;
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
