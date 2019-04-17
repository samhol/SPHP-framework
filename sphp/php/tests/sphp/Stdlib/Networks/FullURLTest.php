<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network;

use Sphp\Exceptions\InvalidArgumentException;

class FullURLTest extends \PHPUnit\Framework\TestCase {

  public function getAlias(int $part): string {

    $arr = [
        URL::SCHEME => 'scheme',
        URL::HOST => 'host',
        URL::PORT => 'port',
        URL::USER => 'user',
        URL::PASS => 'pass',
        URL::PATH => 'path',
        URL::QUERY => 'query',
        URL::FRAGMENT => 'fragment',];
    return $arr[$part];
  }

  public function urlpartNames(): array {
    return [
        URL::SCHEME,
        URL::HOST,
        URL::PORT,
        URL::USER,
        URL::PASS,
        URL::PATH,
        URL::QUERY,
        URL::FRAGMENT];
  }

  /**
   * @param \Sphp\Network\URL $url
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
      $this->assertTrue($url->contains($part), "URL $part is not set");
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
   */
  public function testToArray() {
    $url = new URL('https://user:pass@www.example.com:123/path/to/file.ext?a=b&c[1]=1&c[2]=2#fragment');
    $urlArray = $url->toArray();
    $this->assertEquals('https', $urlArray['scheme']);
    $this->assertEquals(123, $urlArray['port']);
    $this->assertEquals((new QueryString('a=b&c[1]=1&c[2]=2'))->toArray(), $urlArray['query']);
    return $url;
  }

  /**
   * @dataProvider urlStrings
   *
   * @param string $urlString
   */
  public function testJson(string $urlString) {
    $url = new URL($urlString);
    $this->assertEquals(json_encode($url->toArray()), $url->toJson());
    $this->assertEquals(json_encode($url->jsonSerialize()), $url->toJson());
  }

  /**
   * @dataProvider urlParts
   *
   * @param array $array
   */
  public function testArrayAccessAndIterator(array $array) {
    $url = new URL();
    foreach ($array as $key => $data) {
      $this->assertFalse(isset($url[$key]));
      $url[$key] = $data;
      if ($data === '' || $data === null) {
        $this->assertFalse(isset($url[$key]), "URL alias $key exist vithout a proper value");
      } else {
        $this->assertTrue(isset($url[$key]), "URL $key does should have $data as its value");
        if ($key === 'query') {
          $query = new QueryString($data);
          $this->assertEquals($query, $url[$key]);
        } else {
          $this->assertSame($data, $url[$key]);
        }
      }
    }
    foreach ($url as $part => $value) {
      $this->assertSame($value, $url[$part]);
    }
  }

  public function testIssetInvalidPartName() {
    $url = new URL();
    $this->expectException(InvalidArgumentException::class);
    $this->assertFalse(isset($url['foo']));
  }

  public function testUnsetInvalidPartName() {
    $url = new URL();
    $this->expectException(InvalidArgumentException::class);
    unset($url['foo']);
  }

  public function testSetInvalidPartName() {
    $url = new URL();
    $this->expectException(InvalidArgumentException::class);
    $url['foo'] = 'bar';
  }

  public function testGetInvalidPartName() {
    $url = new URL();
    $this->expectException(InvalidArgumentException::class);
    $bar = $url['foo'];
  }

  public function urlStrings() {
    $url[] = ['irc://irc.example.com/channel'];
    $url[] = ['http://example.com'];
    $url[] = ['http://www.example.com'];
    $url[] = ['https://www.example.com'];
    $url[] = ['ftp://www.example.com'];
    $url[] = ['ftps://ftp.example.com'];
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
    $clone[URL::FRAGMENT] = 'frag';
    $this->assertSame('frag', $clone[URL::FRAGMENT]);
    $this->assertNotSame('frag', $url[URL::FRAGMENT]);
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
   * @covers \Sphp\Network\URL::equals
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

  public static function functionMap(int $index): string {
    $map = [
        URL::SCHEME => 'getScheme',
        URL::HOST => 'getHost',
        URL::PORT => 'getPort',
        URL::USER => 'getUser',
        URL::PASS => 'getPassword',
        URL::PATH => 'getPath',
        URL::QUERY => 'getQuery',
        URL::FRAGMENT => 'getFragment',];
    return $map[$index];
  }

  public function indexedUrlParts() {
    return [
        [[
        URL::SCHEME => 'http',
        URL::HOST => 'www.whatever.com',
        URL::USER => 'johndoe',
        URL::PASS => 'password',
        URL::PATH => 'path/to/file.type',
        URL::QUERY => 'q1=p1&q2=p2',
        URL::FRAGMENT => 'frag',
        URL::PORT => 21
            ]],
        [[
        URL::SCHEME => 'https',
        URL::HOST => 'www.whatever.com',
        URL::USER => 'foo',
        URL::PASS => 'password',
        URL::PATH => 'path/to/file.type',
        URL::QUERY => 'q1 = p1&q2 = p2',
        URL::FRAGMENT => 'frag',
        URL::PORT => 200
            ]],
    ];
  }

  /**
   * @dataProvider indexedUrlParts
   * @param array $data
   */
  public function testSettersGettersAndCheckers(array $data) {
    $url = new URL();
    foreach ($data as $part => $value) {
      $this->assertFalse($url->contains($part));
      $this->assertSame($url, $url->setPart($part, $value));
      $this->assertTrue($url->contains($part), $this->getAlias($part) . " does not exist");
      if ($part === URL::QUERY) {
        $this->assertEquals(new QueryString($value), $url->{self::functionMap($part)}());
      } else if ($value === null) {
        $this->assertSame('', $url->{self::functionMap($part)}());
      } else {
        $this->assertSame($value, $url->getPart($part));
        $this->assertSame($value, $url->{self::functionMap($part)}());
      }
    }
  }

  public function urlStringsForPorts() {
    $url[] = ['irc://irc.example.com/channel', 194];
    $url[] = ['http://www.example.com', 80];
    $url[] = ['https://www.example.com', 443];
    $url[] = ['ftp://www.example.com', 21];
    $url[] = ['ftp://ftp.example.com', 21];
    return $url;
  }

  /**
   * @dataProvider urlStringsForPorts
   * @param string $urlString
   * @param int $port
   */
  public function testPort(string $urlString, int $port) {
    $url = new URL($urlString);
    $this->assertSame($port, $url->getPort());
    $this->assertTrue($url->hasDefaultPort());
    $url->setPart(URL::PORT, $port + 1);
    $this->assertFalse($url->hasDefaultPort());
    $this->assertSame($port + 1, $url->getPort());
  }

  /**
   */
  public function testQuerySettings() {
    $url = new URL('http://www.example.com');
    $queryArray = ['foo' => 'bar'];
    $queryString = 'foo=bar';
    $queryObject = new QueryString($queryArray);
    $this->assertSame($url, $url->setQuery($queryString));
    $this->assertEquals($queryObject, $url->getQuery());
    $this->assertSame($url, $url->setQuery(['foo' => 'bar']));
    $this->assertEquals($queryObject, $url->getQuery());
    $this->assertSame($queryObject, $url->setQuery($queryObject)->getQuery());
  }

}
