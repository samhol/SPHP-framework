<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network\Headers;

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
        ['foo', 'bar', time() + 30, '/foo/bar', 'example.com', true],
        ['foo', 'bar', time() + 30, '/', '12.44.22.100', true, true, 'Lax'],
    ];
  }

  /**
   * @dataProvider cookieData
   * @param string $name
   * @param scalar $value
   * @param int $expiryTime
   * @param string $path
   * @param string $domain
   * @param bool $secureOnly
   * @param bool $httpOnly
   * @param string $sameSiteRestriction
   */
  public function testToString(string $name, $value, int $expiryTime, string $path = null, string $domain = null, bool $secureOnly = false, bool $httpOnly = false, string $sameSiteRestriction = null) {
    $cookie = new Cookie($name);
    $cookie
            ->setValue($value)
            ->setExpiryTime($expiryTime)
            ->setPath($path)
            ->setDomain($domain)
            ->setSecureOnly($secureOnly)
            ->setHttpOnly($httpOnly)
            ->setSameSiteRestriction($sameSiteRestriction);
    $cookieStr = (string) $cookie;

    $this->validateString($cookie, $cookieStr);
  }

  protected function validateString(Cookie $cookie, string $cookieStr) {
    /// echo "$cookieStr\n";
    $name = $cookie->getName();
    $value = $cookie->getValue();
    if ($cookie->isDeleted()) {
      $this->assertRegExp("/^Set-Cookie: $name=deleted;/", $cookieStr);
    } else {
      $this->assertRegExp("/^Set-Cookie: $name=$value;/", $cookieStr);
    }
    if ($cookie->isSecureOnly()) {
      $this->assertRegExp("/; secure/", $cookieStr);
    }
    if ($cookie->isHttpOnly()) {
      $this->assertRegExp("/; httponly/", $cookieStr);
    }
    $this->assertRegExp('/; domain=' . $cookie->getDomain() . '/', $cookieStr);
    $sameSiteRestriction = $cookie->getSameSiteRestriction();
    if ($sameSiteRestriction !== null) {
      $this->assertRegExp("/; SameSite=$sameSiteRestriction/", $cookieStr);
    }
  }

  /**
   * @dataProvider cookieData
   * @param string $name
   * @param scalar $value
   * @param int $expiryTime
   * @param string $path
   * @param string $domain
   * @param bool $secureOnly
   * @param bool $httpOnly
   * @param string $sameSiteRestriction
   */
  public function createCookie(string $name, $value, int $expiryTime, string $path = null, string $domain = null, bool $secureOnly = false, bool $httpOnly = false, string $sameSiteRestriction = null) {
    $cookie = new Cookie($name);
    $cookie
            ->setValue($value)
            ->setExpiryTime($expiryTime)
            ->setPath($path)
            ->setDomain($domain)
            ->setSecureOnly($secureOnly)
            ->setHttpOnly($httpOnly)
            ->setSameSiteRestriction($sameSiteRestriction);
    return $cookie;
  }

  /**
   * @runInSeparateProcess
   *
   * @dataProvider cookieData
   * @param string $name
   * @param scalar $value
   * @param int $expiryTime
   * @param string $path
   * @param string $domain
   * @param bool $secureOnly
   * @param bool $httpOnly
   * @param string $sameSiteRestriction
   */
  public function testSave(string $name, $value, int $expiryTime, string $path = null, string $domain = null, bool $secureOnly = false, bool $httpOnly = false, string $sameSiteRestriction = null) {
    $cookie = $this->createCookie($name, $value, $expiryTime, $path, $domain, $secureOnly, $httpOnly, $sameSiteRestriction);
    $cookie->setValue('bar');
    $cookie->setMaxAge(60 * 60);
    $this->assertTrue($cookie->save());
    $headers = xdebug_get_headers();
    $this->validateString($cookie, $headers[0]);
  }

  /**
   * @runInSeparateProcess
   *
   * @dataProvider cookieData
   * @param string $name
   * @param scalar $value
   * @param int $expiryTime
   * @param string $path
   * @param string $domain
   * @param bool $secureOnly
   * @param bool $httpOnly
   * @param string $sameSiteRestriction
   */
  public function testDelete(string $name, $value, int $expiryTime, string $path = null, string $domain = null, bool $secureOnly = false, bool $httpOnly = false, string $sameSiteRestriction = null) {
    $cookie = $this->createCookie($name, $value, $expiryTime, $path, $domain, $secureOnly, $httpOnly, $sameSiteRestriction);
    $this->assertTrue($cookie->delete());
    $headers1 = xdebug_get_headers();
    //print_r(xdebug_get_headers());
    $this->assertSame((string) $cookie, $headers1[0]);
  }

}
