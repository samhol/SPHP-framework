<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Networks;

use Sphp\Exceptions\RuntimeException;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;

class FullURLTest extends \PHPUnit\Framework\TestCase {

  public function urlpartNames(): array {
    return [
        'scheme',
        'host',
        'port',
        'user',
        'pass',
        'path',
        'query',
        'fragment',
        PHP_URL_SCHEME,
        PHP_URL_HOST,
        PHP_URL_PORT,
        PHP_URL_USER,
        PHP_URL_PASS,
        PHP_URL_PATH,
        PHP_URL_QUERY,
        PHP_URL_FRAGMENT];
  }

  /**
   * @param \Sphp\Stdlib\Networks\URL $url
   */
  public function testEmpty(URL $url = null) {
    if ($url === null) {
      $url = new URL();
    }
    foreach ($this->urlpartNames() as $part) {
      $this->assertFalse(isset($url[$part]), "URL part '$part' should not be present in an empty URL");
      if (is_int($part)) {
        $this->assertFalse($url->contains($part));
      }
    }
  }

  public function testDefaultConstructor() {
    $url = new URL();
    $this->testEmpty($url);
  }

  public function testConstructorWithParam(): URL {
    $url = new URL('https://user:pass@www.example.com:123/path/to/file.ext?name1=value1&name2=value2#fragment');
    foreach ($this->urlpartNames() as $part) {
      $this->assertTrue(isset($url[$part]), "URL $part is not set");
      unset($url[$part]);
      $this->assertFalse(isset($url[$part]));
    }

    return $url;
  }

  public function urlParts() {
    return [
        [[
        'scheme' => 'http',
        'host' => 'www.whatever.com',
        'user' => 'johndoe',
        'pass' => 'password',
        'path' => 'path/to/file.type',
        'query' => 'q1=p1&q2=p2',
        'fragment' => 'frag',
        'port' => 21
            ]],
        [[
        'scheme' => 'https',
        'host' => 'www.whatever.com',
        'user' => '',
        'pass' => 'password',
        'path' => 'path/to/file.type',
        'query' => 'q1 = p1&q2 = p2',
        'port' => 200
            ]],
    ];
  }

  /**
   * @dataProvider urlParts
   */
  public function testArrayAccessAndIterator(array $array) {
    $url = new URL();
    foreach ($array as $key => $data) {
      $this->assertFalse(isset($url[$key]));
      $url[$key] = $data;
      $this->assertTrue(isset($url[$key]));
      if ($key !== 'query') {
        $this->assertSame($data, $url[$key]);
      }
    }
    foreach ($url as $part => $value) {
      $this->assertSame($value, $url[$part]);
    }
  }

  public function testIssetInvalidPartName() {
    $url = new URL();
    $this->assertFalse(isset($url['foo']));
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testUnsetInvalidPartName() {
    $url = new URL();
    unset($url['foo']);
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testSetInvalidPartName() {
    $url = new URL();
    $url['foo'] = 'bar';
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testGetInvalidPartName() {
    $url = new URL();
    $bar = $url['foo'];
  }

  /**
   * @expectedException BadMethodCallException
   */
  public function testInvalidMethodCall() {
    $url = new URL();
    $url->getFoo();
  }

  public function urlStrings() {
    $url[] = ['irc://irc.example.com/channel'];
    $url[] = ['http://example.com'];
    $url[] = ['http://www.example.com'];
    $url[] = ['https://www.example.com'];
    $url[] = ['ftp://www.example.com'];
    $url[] = ['ftp://ftp.example.com'];
    $url[] = ['http://www.example.com/'];
    $url[] = ['http://www.example.com/path'];
    $url[] = ['www.example.com/foo'];
    $url[] = ['http://www.example.com/path/'];
    $url[] = ['www.example.com/foo/'];
    $url[] = ['http://www.example.com/path?section=17'];
    $url[] = ['www.example.com/foo?page=42'];
    $url[] = ['http://webreference.com:344/html/tutorial2/2.html?query'];
    return $url;
  }

  /**
   * @dataProvider urlStrings
   * @param string $urlString
   */
  public function testClone(string $urlString) {
    $url = new URL($urlString);
    $clone = clone $url;
    $this->assertTrue($url->equals($clone));
    $this->assertTrue($url == $clone);
    $clone[PHP_URL_FRAGMENT] = 'frag';
    $this->assertSame('frag', $clone[PHP_URL_FRAGMENT]);
    $this->assertNotSame('frag', $url[PHP_URL_FRAGMENT]);
    $this->assertFalse($url->equals($clone));
    $this->assertFalse($url == $clone);
  }

  public function equalUrlPairs(): array {
    $url[] = ['http://example.com', 'http://example.com:80'];
    $url[] = ['http://www.example.com/path?p1=v1&p2=v2', 'http://www.example.com/path?p2=v2&p1=v1'];
    return $url;
  }

  /**
   * 
   * @covers \Sphp\Stdlib\Networks\URL::equals
   * @dataProvider equalUrlPairs
   */
  public function testEquals($urlString1, $urlString2) {
    $u1 = new URL($urlString1);
    $u2 = new URL($urlString2);
    //var_dump($u1->toString(), $u2->toString());
    $this->assertTrue($u1->equals($urlString1));
    $this->assertTrue($u2->equals($urlString2));
    $this->assertTrue($u1->equals($urlString2));
    $this->assertTrue($u2->equals($urlString1));
    $this->assertTrue($u1->equals($u2));
    $this->assertTrue($u2->equals($u1));
  }

  public function testSettersGettersAndCheckers() {
    $url = new URL();
    $this->assertSame($url, $url->setScheme('http'));
    $this->assertSame('http', $url->getScheme());
    $this->assertSame($url, $url->setUser('user 1'));
    $this->assertSame('user 1', $url->getUser());
    $this->assertSame('user%201', $url->getUser(true));
    $this->assertSame($url, $url->setPassword('pass'));
    $this->assertSame('pass', $url->getPassword());
    $this->assertTrue($url->hasDefaultPort());
    $this->assertSame(80, $url->getPort());
    $this->assertSame($url, $url->setPort(1010));
    $this->assertFalse($url->hasDefaultPort());
    $this->assertSame(1010, $url->getPort());
    $this->assertSame($url, $url->setFragment('frag 1'));
    $this->assertSame('frag 1', $url->getFragment());
    $this->assertSame('frag%201', $url->getFragment(true));
  }

}
