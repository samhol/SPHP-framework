<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
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
 * @method \Sphp\Network\Headers\GenericHeader appendAccessControlAllowOrigin(string $content = null) appends a header object
 * @method \Sphp\Network\Headers\GenericHeader setAccessControlAllowOrigin(string $content = null) appends inserts a header object
 * @method \Sphp\Network\Headers\GenericHeader location(string $content = null) creates nd inserts a header object
 * @method \Sphp\Network\Headers\GenericHeader allowOrigin(string $content = null) creates nd inserts a header object
 * @method \Sphp\Network\Headers\GenericHeader allowMethods(string $content = null) creates nd inserts a header object 
 * @method \Sphp\Network\Headers\GenericHeader maxAge(int $maxAge) creates nd inserts a header object
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
  private static $typeMap = [
      'AccessControlAllowOrigin' => 'Access-Control-Allow-Origin',
      'allowOrigin' => 'Access-Control-Allow-Origin',
      'AccessControlAllowCredentials' => 'Access-Control-Allow-Credentials',
      'AccessControlExposeHeaders' => 'Access-Control-Expose-Headers',
      'AccessControlMaxAge' => 'Access-Control-Max-Age',
      'maxAge' => 'Access-Control-Max-Age',
      'AccessControlAllowMethods' => 'Access-Control-Allow-Methods',
      'allowMethods' => 'Access-Control-Allow-Methods',
      'AccessControlAllowHeaders' => 'Access-Control-Allow-Headers',
      'AcceptPatch' => 'Accept-Patch',
      'AcceptRanges' => 'Accept-Ranges',
      'Age' => 'Age',
      'Allow' => 'Allow',
      'AltSvc' => 'Alt-Svc',
      'CacheControl' => 'Cache-Control',
      'Connection' => 'Connection',
      'ContentDisposition' => 'Content-Disposition',
      'ContentEncoding' => 'Content-Encoding',
      'ContentLanguage' => 'Content-Language',
      'ContentLength' => 'Content-Length',
      'ContentLocation' => 'Content-Location',
      'ContentRange' => 'Content-Range',
      'ContentType' => 'Content-Type',
      'Date' => 'Date',
      'DeltaBase' => 'Delta-Base',
      'ETag' => 'ETag',
      'Expires' => 'Expires',
      'IM' => 'IM',
      'LastModified' => 'Last-Modified',
      'Link' => 'Link',
      'RedirectTo' => 'Location',
      'Location' => 'Location',
      'P3P' => 'P3P',
      'Pragma' => 'Pragma',
      'ProxyAuthenticate' => 'Proxy-Authenticate',
      'PublicKeyPins' => 'Public-Key-Pins',
      'RetryAfter' => 'Retry-After',
      'Server' => 'Server',
      'StrictTransportSecurity' => 'Strict-Transport-Security',
      'Trailer' => 'Trailer',
      'TransferEncoding' => 'Transfer-Encoding',
      'Tk' => 'Tk',
      'Upgrade' => 'Upgrade',
      'Vary' => 'Vary',
      'Via' => 'Via',
      'Warning' => 'Warning',
      'WWWAuthenticate' => 'WWW-Authenticate',
      'XFrameOptions' => 'X-Frame-Options',
  ];

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

  public function remove(string $name) {
    foreach ($this->headers as $k => $n) {
      if ($n->getName() === $name) {
        unset($this->headers[$k]);
      }
    }
    return $this;
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
    $nameConversion = preg_replace("/^append/", '', $name);
    if (isset(static::$typeMap[$nameConversion])) {
      $headerName = static::$typeMap[$nameConversion];
    } else {
      throw new BadMethodCallException("$name is not a valid method for a Headers object");
    }
    $reflectionClass = new ReflectionClass(GenericHeader::class);
    array_unshift($arguments, $headerName);
    $instance = $reflectionClass->newInstanceArgs($arguments);
    $this->appendInstance($instance);
    return $instance;
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
