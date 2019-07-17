<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network\Headers;

use Sphp\Network\Cookies\Cookie;
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
   * @depends testValue
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
   * @depends testDomain
   * @param   Cookie $cookie
   * @return  Cookie
   */
  public function testExpiryTime(Cookie $cookie): Cookie {
    $this->assertSame(0, $cookie->getExpiryTime());
    $this->assertSame($cookie, $cookie->setExpiryTime(200));
    $this->assertSame(200, $cookie->getExpiryTime());
    return $cookie;
  }

  /**
   * @depends testExpiryTime
   * @param   Cookie $cookie
   * @return  Cookie
   */
  public function testPath(Cookie $cookie): Cookie {
    $this->assertSame('/', $cookie->getPath());
    $this->assertSame($cookie, $cookie->setPath('/foo/bar'));
    $this->assertSame('/foo/bar', $cookie->getPath());
    return $cookie;
  }

  /**
   * @depends testPath
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

  /**
   * @runInSeparateProcess
   */
  public function testSave() {
    $cookie = new Cookie('foo');
    $cookie->setValue('bar');
    $cookie->setExpiryTime(time() + 100000);
    $this->assertTrue($cookie->save());
    $headers = xdebug_get_headers();

    print_r($headers);
    //$this->assertArrayHasKey('foo', $_COOKIE);
  }

}
