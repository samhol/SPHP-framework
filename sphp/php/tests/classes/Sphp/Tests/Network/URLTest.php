<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Network;

use PHPUnit\Framework\TestCase;
use Sphp\Network\URL;
use Sphp\Network\QueryString;

/**
 * @testdox URL class tests
 */
class URLTest extends TestCase {

  /**
   * @param  URL $url
   * @return void
   */
  public function testEmpty(URL $url = null): void {
    if ($url === null) {
      $url = new URL();
    }
    $this->assertFalse($url->containsScheme());
    $this->assertFalse($url->containsHost());
    $this->assertFalse($url->containsPath());
    $this->assertFalse($url->containsUser());
    $this->assertFalse($url->containsPassword());
    $this->assertFalse($url->containsQuery());
    $this->assertFalse($url->containsPort());
    $this->assertFalse($url->containsFragment());

    $this->assertNull($url->getScheme());
    $this->assertNull($url->getHost());
    $this->assertNull($url->getPath());
    $this->assertNull($url->getUser());
    $this->assertNull($url->getPassword());
    $this->assertTrue($url->getQuery()->isEmpty());
    $this->assertNull($url->getPort());
    $this->assertNull($url->getFragment());
  }

  public function testConstructorWithParam(): URL {
    $url = new URL('https://user:pass@www.example.com:123/path/to/file.ext?name1=value1&name2=value2#fragment');
    $this->assertSame('https', $url->getScheme());
    return $url;
  }

  public function testToArray() {
    $url = new URL('https://user:pass@www.example.com:123/path/to/file.ext?a=b&c[1]=1&c[2]=2#fragment');
    $urlArray = $url->toArray();
    $this->assertEquals('https', $urlArray['scheme']);
    $this->assertEquals(123, $urlArray['port']);
    $this->assertEquals((string) (new QueryString('a=b&c[1]=1&c[2]=2')), $urlArray['query']);
    $this->assertSame($urlArray, iterator_to_array($url));
    return $url;
  }

  /**
   * @dataProvider urlStrings
   *
   * @param  string $urlString
   * @return void
   */
  public function testJson(string $urlString): void {
    $url = new URL($urlString);
    $this->assertEquals(json_encode($url->toArray()), $url->toJson());
    $this->assertEquals(json_encode($url->jsonSerialize()), $url->toJson());
  }

  /**
   * @dataProvider urlStrings
   *
   * @param  string $urlString
   * @return void
   */
  public function testTraversingMethods(string $urlString): void {
    $parts = parse_url($urlString);
    //echo "\nhost: " . parse_url($urlString, PHP_URL_HOST) . "\n";
    $url = new URL($urlString);
    //print_r($url);
    $this->assertEquals($parts, $url->toArray());
  }

  public function urlStrings(): iterable {
    yield ['irc://irc.example.com/channel'];
    yield ['http://example.com'];
    yield ['https://www.example.com'];
    yield ['https://www.example.com:344'];
    yield ['ftp://www.example.com'];
    yield ['ftps://ftp.example.com'];
    yield ['http://www.example.com/path?a=foobar'];
    yield ['www.example.com/foo?page=42'];
    yield ['gopher://gopher.hprc.ca/path'];
    yield ['ssh://login@server.com:12345/repository.git'];
  }

  /**
   * @dataProvider urlStrings
   * 
   * @param  string $urlString
   * @return void
   */
  public function testClone(string $urlString): void {
    $url = new URL($urlString);
    //  var_dump($url);
    $clone = clone $url;
    $this->assertTrue($url->equals($clone));
    $this->assertTrue($url == $clone);
    $clone->setFragment('frag');
    $this->assertSame('frag', $clone->getFragment());
    $this->assertNotSame('frag', $url->getFragment());
    $this->assertFalse($url->equals($clone));
    $this->assertFalse($url == $clone);
  }

  public function equalUrlPairs(): iterable {
    yield['http://example.com', 'http://example.com:80'];
    yield['http://www.example.com/path?p1=v1&p2=v2', 'http://www.example.com/path?p2=v2&p1=v1'];
  }

  /**
   * @dataProvider equalUrlPairs
   * 
   * @return void
   */
  public function testEquals($urlString1, $urlString2): void {
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

  /**
   * @return URL
   */
  public function testDefaultConstructor(): URL {
    $url = new URL();
    $this->testEmpty($url);
    return $url;
  }

  /**
   * @depends testDefaultConstructor
   * 
   * @param  URL $url
   * @return URL
   */
  public function testScheme(URL $url): URL {
    $this->assertSame($url, $url->setScheme('https'));
    $this->assertTrue($url->containsScheme());
    $this->assertSame('https', $url->getScheme());
    return $url;
  }

  /**
   * @depends testScheme
   * 
   * @param URL $url
   * @return URL
   */
  public function testPortBasics(URL $url): URL {
    $newPort = 20;
    $this->assertFalse($url->containsPort());
    $this->assertSame(443, $url->resolvePort());
    $this->assertSame($url, $url->setPort($newPort));
    $this->assertTrue($url->containsPort());
    $this->assertSame($newPort, $url->getPort());
    $this->assertSame($url, $url->setPort(null));
    $this->assertFalse($url->containsPort());
    return $url;
  }

  /**
   * @depends testScheme
   * 
   * @param URL $url
   * @return URL
   */
  public function testIpv6Host(URL $url): URL {
    $ipv6 = '2001:0db8:85a3:0000:0000:8a2e:0370:7334';
    $this->assertFalse($url->containsHost());
    $this->assertFalse($url->isIPv6());
    $this->assertSame($url, $url->setHost($ipv6));
    $this->assertTrue($url->containsHost());
    $this->assertTrue($url->isIPv6());
    $this->assertSame($ipv6, $url->getHost());
    $this->assertSame("//[$ipv6]", $url->getAuthority());
    return $url;
  }

  /**
   * @depends testIpv6Host
   * 
   * @param URL $url
   * @return URL
   */
  public function testIpv4Host(URL $url): URL {
    $ipv4 = 'www.example.com';
    $this->assertSame($url, $url->setHost($ipv4));
    $this->assertTrue($url->containsHost());
    $this->assertFalse($url->isIPv6());
    $this->assertSame($ipv4, $url->getHost());
    $this->assertSame("//$ipv4", $url->getAuthority());
    return $url;
  }

  /**
   * @depends testIpv4Host
   * 
   * @param  URL $url
   * @return URL
   */
  public function testUserPass(URL $url): URL {
    $user = 'user';
    $pass = 'pass';
    $this->assertFalse($url->containsUser());
    $this->assertFalse($url->containsPassword());
    $this->assertSame($url, $url->setPassword($pass));
    $this->assertTrue($url->containsPassword());
    $this->assertSame("//www.example.com", $url->getAuthority());
    $this->assertSame($url, $url->setUsername($user));
    $this->assertSame($user, $url->getUser());
    $this->assertSame("//user:pass@www.example.com", $url->getAuthority());
    return $url;
  }

  /**
   * @depends testScheme
   * 
   * @param  URL $url
   * @return URL
   */
  public function testPathBasics(URL $url): URL {
    $newPath = 'a/b';
    $this->assertFalse($url->containsPath());
    $this->assertSame($url, $url->setPath($newPath));
    $this->assertTrue($url->containsPath());
    $this->assertSame($newPath, $url->getPath());
    return $url;
  }

  public function urlStringsForPorts(): iterable {
    yield ['irc://irc.example.com/channel', 194];
    yield ['http://www.example.com', 80];
    yield ['http://www.example.com:1', 1];
    yield ['https://www.example.com', 443];
    yield ['ftp://www.example.com', 21];
    yield ['ftp://ftp.example.com', 21];
    // yield ['ftp.example.com', null];
    yield ['ssh://login@server.com:12345/repository.git', 12345];
    yield ['gopher://gopher.hprc.utoronto.ca/11adaptive.technology', 70];
  }

  /**
   * @dataProvider urlStringsForPorts
   * 
   * @param  string $urlString
   * @param  int $port
   * @return void
   */
  public function testAdvancedPortManipulation(string $urlString, ?int $port): void {
    $url = new URL($urlString);
    $defaultport = getservbyname($url->getScheme(), 'tcp');
    // echo $url . " port: " . $url->resolvePort() . "\n";
    $this->assertSame($port, $url->resolvePort());
    $url->setPort($defaultport);
    $this->assertTrue($url->hasDefaultPort());
    $url->setPort($port + 1);
    $this->assertFalse($url->hasDefaultPort());
    $this->assertSame($port + 1, $url->getPort());
    $this->assertSame($url, $url->setPort(null));
    $this->assertTrue($url->hasDefaultPort());
    //echo $url . "\n";
  }

  public function urlStringsForInvalidPorts(): iterable {
    yield ['daa://example.com/channel'];
  }

  /**
   * @dataProvider urlStringsForInvalidPorts
   * 
   * @param  string $urlString
   * @param  int $port
   * @return void
   */
  public function testResolvePortFailures(string $urlString): void {
    $url = new URL($urlString);
    $this->assertNull($url->resolvePort());
  }

  public function testGetParts(): void {
    $url = new URL('https://john.doe@www.example.com:123/forum/questions/?tag=networking&order=newest#top');
    $this->assertSame('//john.doe@www.example.com:123', $url->getAuthority());
    $this->assertSame('https', $url->getScheme());
    $this->assertSame('/forum/questions/', $url->getPath());
  }

  public function testQuerySettings(): void {
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

  public function outputDataForRFC1738(): iterable {
    yield ['https://a.c/f/b.php?a=b/c&b=c d', 'https://a.c/f/b.php?a=b%2Fc&b=c+d'];
    yield ['https://a.c/f/b.php?a=b/c&b=c d#id', 'https://a.c/f/b.php?a=b%2Fc&b=c+d#id'];
  }

  /**
   * @dataProvider outputDataForRFC1738
   * 
   * @param  string $urlString 
   * @param  string $expected 
   * @return void
   */
  public function testRFC1738Output(string $urlString, string $expected): void {
    $url = new URL($urlString);
    $this->assertSame($expected, (string) $url);
    $this->assertSame($expected, $url->parseToString(PHP_QUERY_RFC1738));
  }

  public function outputDataForRFC3986(): iterable {
    yield ['https://a.c/f/b.php?a=b/c&b=c d', 'https://a.c/f/b.php?a=b%2Fc&b=c%20d'];
    yield ['https://a.c/f/b.php?a=b/c&b=c d#id', 'https://a.c/f/b.php?a=b%2Fc&b=c%20d#id'];
  }

  /**
   * @dataProvider outputDataForRFC3986
   * 
   * @param  string $urlString 
   * @param  string $expected 
   * @return void
   */
  public function testRFC3986Output(string $urlString, string $expected): void {
    $url = new URL($urlString);
    $this->assertSame($expected, $url->parseToString(PHP_QUERY_RFC3986));
  }

  public function xssURLs(): iterable {
    yield ['https://a.com/foo/bar.php?var=<script>alert(document.cookie)</script>'];
  }

  /**
   * @dataProvider xssURLs
   * 
   * @param string $xss
   */
  public function testSanitizedOutput(string $xss): void {
    $url = new URL($xss);
    $this->assertSame((string) $url, $url->parseToString());
  }

}
