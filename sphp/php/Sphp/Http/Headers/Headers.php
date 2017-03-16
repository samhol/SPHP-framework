<?php

/**
 * Headers.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Http\Headers;

/**
 * Utility class for PHP header operations
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-16
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Headers {

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
  public static function setHeader($string) {
    header($string, false);
  }

  /**
   * Replaces a raw HTTP header
   * 
   * @param string $string
   */
  public static function replaceHeader($string) {
    header($string, true);
  }

  /**
   * Sets (replaces) the content type header
   * 
   * @param string $contentType
   */
  public static function setContentType($contentType, $charset = 'UTF-8') {
    self::replaceHeader("Content-type: $contentType; charset=$charset");
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
