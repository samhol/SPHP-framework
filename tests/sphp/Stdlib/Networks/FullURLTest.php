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
    return ['scheme', 'host', 'port', 'user', 'pass', 'path', 'query', 'fragment',];
  }

  /**
   * @covers \Sphp\Stdlib\Networks\URL::__construct
   */
  public function testDefaultConstructor() {
    $url = new URL();
    var_dump($url->toArray());
    $this->assertFalse(isset($url['scheme']));
    $this->assertFalse(isset($url['host']));
    $this->assertFalse(isset($url['user']));
    $this->assertFalse(isset($url['username']));
    $this->assertFalse(isset($url['pass']));
    $this->assertFalse(isset($url['password']));
    $this->assertFalse(isset($url['port']));
    $this->assertFalse(isset($url['path']));
    $this->assertFalse(isset($url['query']));
    $this->assertFalse(isset($url['fragment']));
  }

  public function testConstructorWithParam(): URL {
    $url = new URL('https://user:pass@www.example.com:123/path/to/file.ext?name1=value1&name2=value2#fragment');
    foreach ($this->urlpartNames() as $part) {
      $this->assertTrue(isset($url[$part]));
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
        'query' => 'q1 = p1&q2 = p2',
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
  public function testArrayAccess(array $parts) {
    $url = new URL();
    foreach ($parts as $part => $value) {
      $this->assertFalse(isset($url[$part]));
      $url[$part] = $value;
      $this->assertTrue(isset($url[$part]));
      if ($part !== 'query') {
        $this->assertSame($value, $url[$part]);
      }
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
  public function t4estClone(string $urlString) {
    $url = new URL($urlString);
    $clone = clone $url;
    $this->assertTrue($url->equals($clone));
    $this->assertTrue($url == $clone);
    $clone[PHP_URL_FRAGMENT] ='frag';
    $this->assertSame('frag', $clone[PHP_URL_FRAGMENT]);
    $this->assertNotSame('frag', $url[PHP_URL_FRAGMENT]);
    $this->assertFalse($url->equals($clone));
    $this->assertFalse($url == $clone);
  }

}
