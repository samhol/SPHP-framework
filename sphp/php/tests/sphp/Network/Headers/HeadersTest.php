<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network\Headers;

use PHPUnit\Framework\TestCase;

/**
 * Header collection Tests
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class HeadersTest extends TestCase {

  /**
   * @return Headers
   */
  public function testConstructor(): Headers {
    $headers = new Headers();
    $this->assertCount(0, $headers);
    return $headers;
  }

  /**
   * @depends testConstructor
   * @param   Headers $headers
   * @return  Headers
   */
  public function testAppending(Headers $headers): Headers {
    $this->assertFalse($headers->containsHeader('Access-Control-Allow-Origin'));
    $header = $headers->appendAccessControlAllowOrigin('google.com');
    $this->assertInstanceOf(Header::class, $header);
    $this->assertSame('Access-Control-Allow-Origin', $header->getName());
    $this->assertSame('google.com', $header->getValue());
    $this->assertCount(1, $headers);
    $this->assertTrue($headers->containsHeader('Access-Control-Allow-Origin'));
    $this->assertfalse($header->save());
    $this->assertfalse($header->delete());
    $this->assertfalse($header->reset());
    //$this->assertSame('foo-bar', $headers->getValue());
    return $headers;
  }

  public function headerData(): array {

    return [
        ['foo', 'bar'],
        //['foo', null],
        ['foo', true],
        ['foo', time()],
    ];
  }

  protected function validateString(Header $cookie, string $cookieStr) {
    /// echo "$cookieStr\n";
    $name = $cookie->getName();
    $value = $cookie->getValue();
    $this->assertSame($cookie->getName() . ": " . $cookie->getValue(), $cookieStr);
  }

  /**
   * @runInSeparateProcess
   */
  public function testSave() {
    $header = new GenericHeader('foo', 'bar');
    $this->assertTrue($header->save());
    $headers1 = xdebug_get_headers();
    $this->assertArrayHasKey(0, $headers1, 'Headers not send');
    $this->validateString($header, $headers1[0]);
    $header->setValue('bite');
    $this->assertTrue($header->reset());
    $headers2 = xdebug_get_headers();
    $this->assertArrayHasKey(0, $headers2, 'Headers not send');
    $this->validateString($header, $headers2[0]);
    $this->assertTrue($header->delete());
  }

  public function magicData(): array {
    $d = [
        'AccessControlAllowOrigin' => 'Access-Control-Allow-Origin',
        'AccessControlAllowCredentials' => 'Access-Control-Allow-Credentials',
        'AccessControlExposeHeaders' => 'Access-Control-Expose-Headers',
        'AccessControlMaxAge' => 'Access-Control-Max-Age',
        'AccessControlAllowMethods' => 'Access-Control-Allow-Methods',
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
    return $d;
  }

  /**
   * @depends testConstructor
   * @param   Headers $headers
   * @return  Headers
   */
  public function testMagicCall(Headers $headers) {
    $headers = new Headers();
    foreach ($this->magicData() as $callName => $value) {
      if ($headers->containsHeader($value)) {
        $headers->remove($value);
      }
      $this->assertFalse($headers->containsHeader($value), "'$value' exists in headers");
      $call = "append$callName";
      $instance = $headers->$call($value);
      $this->assertInstanceOf(Header::class, $instance);
      $this->assertTrue($headers->containsHeader($value), "'$value' does not exist in headers");
    }
    unset($headers);
  }

}
