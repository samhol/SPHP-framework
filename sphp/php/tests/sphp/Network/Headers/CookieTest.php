<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network\Headers;

use Sphp\Network\Headers\Cookie;
use PHPUnit\Framework\TestCase;

/**
 * Cookie Tests
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CookieTest extends TestCase {

  /**
   * @return Cookie
   */
  public function testConstructor(): Cookie {
    $cookie = new Cookie('foo');
    $this->assertSame('foo', $cookie->getName());
    return $cookie;
  }

  /**
   * @depends testConstructor
   * @param   Cookie $cookie
   * @return  Cookie
   */
  public function testValue(Cookie $cookie): Cookie {
    $this->assertSame(null, $cookie->getValue());
    $this->assertSame($cookie, $cookie->setValue('foo-bar'));
    $this->assertSame('foo-bar', $cookie->getValue());
    return $cookie;
  }

  /**
   * @depends testConstructor
   * @param   Cookie $cookie
   * @return  Cookie
   */
  public function testDomain(Cookie $cookie): Cookie {
    $this->assertSame(null, $cookie->getDomain());
    $this->assertSame($cookie, $cookie->setDomain('samiholck.com'));
    $this->assertSame('samiholck.com', $cookie->getDomain());
    return $cookie;
  }

  /**
   * @depends testConstructor
   * @param   Cookie $cookie
   * @return  Cookie
   */
  public function testExpiryTime(Cookie $cookie): Cookie {
    $this->assertSame(0, $cookie->getExpiryTime());
    $this->assertSame($cookie, $cookie->setExpiryTime(200));
    $this->assertSame(200, $cookie->getExpiryTime());
    $this->assertSame(0, $cookie->getMaxAge());
    return $cookie;
  }

  /**
   * @depends testConstructor
   * @param   Cookie $cookie
   * @return  Cookie
   */
  public function testMaxAge(Cookie $cookie): Cookie {
    $this->assertSame(0, $cookie->getMaxAge());
    $this->assertSame($cookie, $cookie->setMaxAge(200));
    $this->assertSame(200, $cookie->getMaxAge());
    return $cookie;
  }

  /**
   * @depends testConstructor
   * @param   Cookie $cookie
   * @return  Cookie
   */
  public function testPath(Cookie $cookie): Cookie {
    $this->assertSame('', $cookie->getPath());
    $this->assertSame($cookie, $cookie->setPath('/foo/bar/'));
    $this->assertSame('/foo/bar/', $cookie->getPath());
    return $cookie;
  }

  /**
   * @depends testConstructor
   * @param   Cookie $cookie
   * @return  Cookie
   */
  public function testSameSiteRestriction(Cookie $cookie): Cookie {
    $this->assertSame(null, $cookie->getSameSiteRestriction());
    $this->assertSame($cookie, $cookie->setSameSiteRestriction('Strict'));
    $this->assertSame('Strict', $cookie->getSameSiteRestriction());
    $this->assertSame($cookie, $cookie->setSameSiteRestriction('Lax'));
    $this->assertSame('Lax', $cookie->getSameSiteRestriction());
    return $cookie;
  }

  /**
   * @depends testConstructor
   * @param   Cookie $cookie
   * @return  Cookie
   */
  public function testBooleans(Cookie $cookie): Cookie {
    $this->assertFalse($cookie->isHttpOnly());
    $this->assertFalse($cookie->isSecureOnly());
    $this->assertSame($cookie, $cookie->setSecureOnly(true));
    $this->assertSame($cookie, $cookie->setHttpOnly(true));
    $this->assertTrue($cookie->isHttpOnly());
    $this->assertTrue($cookie->isSecureOnly());
    return $cookie;
  }

  public function cookieData(): array {
    return [
        ['foo', 'bar', time() + 30, '/', 'blaa.foo', true],
        ['foo', '', time() + 30, '/', 'blaa.foo', true],
        ['foo', 'bar', time() + 30, '/', 'blaa.foo', true],
    ];
  }

  /**
   * @dataProvider cookieData
   * @param string $name
   * @param scalar $value
   * @param int $expiryTime
   * @param string $path
   */
  public function testToString(string $name, $value, int $expiryTime, string $path = null) {

    $cookie = new Cookie($name);
    $cookie
            ->setValue($value)
            ->setExpiryTime($expiryTime)
            ->setPath($path);
    if ($cookie->isDeleted()) {
      $this->assertRegExp("/Set-Cookie: $name=deleted;/", (string) $cookie);
    } else {
      $this->assertRegExp("/Set-Cookie: $name=$value;/", (string) $cookie);
    }
  }

  /**
   * @runInSeparateProcess
   */
  public function testSave() {
    $cookie = new Cookie('foo');
    $cookie->setValue('bar');
    $cookie->setMaxAge(60 * 60);
    $this->assertTrue($cookie->save());
    $headers1 = xdebug_get_headers();
    $this->assertRegExp("/foo=bar/", $headers1[0]);
    $this->assertRegExp("/Max-Age=3600/", $headers1[0]);
    $this->assertTrue($cookie->delete());
    //$headers = xdebug_get_headers();
    $headers2 = xdebug_get_headers();
    print_r(xdebug_get_headers());
    $this->assertRegExp("/Max-Age=0/", $headers2[1]);
    //$this->assertArrayHasKey('foo', $_COOKIE);
  }

}
