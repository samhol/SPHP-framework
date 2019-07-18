<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network\Headers;

use IteratorAggregate;
use ReflectionClass;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Operable PHP header collection
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
class Headers implements IteratorAggregate {

  /**
   * list of Header
   *
   * @var Header[]
   */
  private static $typeMap = array(
      'location' => GenericHeader::class,
      'redirectTo' => GenericHeader::class,
      'allowOrigin' => GenericHeader::class,
      'contentType' => GenericHeader::class,
      'allowMethods' => GenericHeader::class,
      'maxAge' => GenericHeader::class,
      'Access-Control-Allow-Origin' => GenericHeader::class,
      'Access-Control-Allow-Credentials' => GenericHeader::class,
      'Access-Control-Expose-Headers' => GenericHeader::class,
      'Access-Control-Max-Age' => GenericHeader::class,
      'Access-Control-Allow-Methods' => GenericHeader::class,
      'Access-Control-Allow-Headers' => GenericHeader::class,
      'Accept-Patch' => GenericHeader::class,
      'Accept-Ranges' => GenericHeader::class,
      'Age' => GenericHeader::class,
      'Allow' => GenericHeader::class,
      'Alt-Svc' => GenericHeader::class,
      'Cache-Control' => GenericHeader::class,
      'Connection' => GenericHeader::class,
      'Content-Disposition' => GenericHeader::class,
      'Content-Encoding' => GenericHeader::class,
      'Content-Language' => GenericHeader::class,
      'Content-Length' => GenericHeader::class,
      'Content-Location' => GenericHeader::class,
      'Content-Range' => GenericHeader::class,
      'Content-Type' => GenericHeader::class,
      'Date' => GenericHeader::class,
      'Delta-Base' => GenericHeader::class,
      'ETag' => GenericHeader::class,
      'Expires' => GenericHeader::class,
      'IM' => GenericHeader::class,
      'Last-Modified' => GenericHeader::class,
      'Link' => GenericHeader::class,
      'Location' => GenericHeader::class,
      'P3P' => GenericHeader::class,
      'Pragma' => GenericHeader::class,
      'Proxy-Authenticate	' => GenericHeader::class,
      'Public-Key-Pins' => GenericHeader::class,
      'Retry-After' => GenericHeader::class,
      'Server' => GenericHeader::class,
      'cookie' => Cookie::class,
      'Set-Cookie' => Cookie::class,
      'Strict-Transport-Security' => GenericHeader::class,
      'Trailer' => GenericHeader::class,
      'Transfer-Encoding' => GenericHeader::class,
      'Transfer-Encoding' => GenericHeader::class,
      'Tk' => GenericHeader::class,
      'Upgrade' => GenericHeader::class,
      'Vary' => GenericHeader::class,
      'Via' => GenericHeader::class,
      'Warning' => GenericHeader::class,
      'WWW-Authenticate' => GenericHeader::class,
      'X-Frame-Options' => GenericHeader::class,
  );

  /**
   *
   * @var Header[]
   */
  private $headers;

  /**
   * Constructor
   */
  public function __construct() {
    $this->headers = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->headers);
  }

  public function appendInstance(Header $header) {
    $this->headers[] = $header;
    return $this;
  }

  public function appendNewHeader(string $name, $value): Header {
    $header = new GenericHeader($name, $value);
    $this->appendInstance($header);
    return $header;
  }

  public function containsHeader(string $name) {
    $contains = false;
    foreach ($this->headers as $n) {
      $contains = $n->getName() === $name;
      if ($contains) {
        break;
      }
    }
    return $contains;
  }

  public function save(): bool {
    $success = true;
    foreach ($this->headers as $header) {
      $success = $header->save();
      if (!$success) {
        break;
      }
    }
    return $success;
  }

  public function __call(string $name, array $arguments): Header {
    $nameConversion = $this->createConversion($name);
    if (isset(static::$typeMap[$name])) {
      $class = static::$typeMap[$name];
    } else if (isset(static::$typeMap[$nameConversion])) {
      $class = static::$typeMap[$nameConversion];
    } else {
      $class = GenericHeader::class;
    }
    $reflectionClass = new ReflectionClass($class);
    if ($class === GenericHeader::class) {
      array_unshift($arguments, $name);
    }
    $instance = $reflectionClass->newInstanceArgs($arguments);
    $this->appendInstance($instance);
    return $instance;
  }

  private function createConversion(string $name): string {

    $next_year = function($matches) {
      // as usual: $matches[0] is the complete match
      // $matches[1] the match for the first subpattern
      // enclosed in '(...)' and so on
      return '-' . strtolower($matches[0]);
    };
    return mb_convert_case(preg_replace_callback(
                    "/(?<!^)[A-Z]/",
                    $next_year,
                    $name), MB_CASE_TITLE);
  }

  /**
   * Appends a new cookie to the collection
   * 
   * @param  string $name
   * @param  mixed $value
   * @param  int $maxAge
   * @param  string $path
   * @param  string $domain
   * @param  bool $secureOnly
   * @param  bool $httpOnly
   * @param  string $sameSiteRestriction
   * @return Cookie
   */
  public function setCookie(string $name, $value = null, int $maxAge = 0, string $path = null, string $domain = null, bool $secureOnly = false, bool $httpOnly = false, string $sameSiteRestriction = null): Cookie {
    $cookie = new Cookie($name, $value);
    $cookie->setMaxAge($maxAge);
    $cookie->setPath($path);
    $cookie->setDomain($domain);
    $cookie->setSecureOnly($secureOnly);
    $cookie->setSameSiteRestriction($sameSiteRestriction);
    $cookie->setHttpOnly($httpOnly);
    $this->appendInstance($cookie);
    return $cookie;
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->headers);
  }

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
   * @param string $header
   */
  public static function addHttpHeader(string $header) {
    if (!\headers_sent()) {
      if (!empty($header)) {
        \header($header, false);
        return true;
      }
    }
    return false;
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
  public static function setDownloadDialog(string $originalPath, string $filetype, string $filename, string $charset = 'utf-8') {
    self::setContentType($filetype, $charset);
    header("Content-Disposition: attachment; filename=\"$filename\"");
    readfile($originalPath);
  }

}
