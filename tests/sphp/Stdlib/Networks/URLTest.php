<?php

namespace Sphp\Stdlib\Networks;

class URLTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var URL
   */
  protected $http;

  /**
   * @var URL
   */
  protected $https;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->http = new URL("http://username:password@www.example.com/path?param1=value1&param2=value2&bool#fragment");
    $this->https = new URL("https://username:password@www.example.com/path?param1=value1&param2=value2&bool#fragment");
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
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

  public function urlStringsWithSchemes() {
    $url[] = ['irc://irc.example.com/channel'];
    $url[] = ['http://example.com'];
    $url[] = ['http://www.example.com'];
    $url[] = ['https://www.example.com'];
    $url[] = ['ftp://www.example.com'];
    $url[] = ['ftp://ftp.example.com'];
    $url[] = ['http://www.example.com/'];
    $url[] = ['http://www.example.com/path'];
    $url[] = ['http://www.example.com/path/'];
    $url[] = ['http://www.example.com/path?section=17'];
    $url[] = ['http://webreference.com:344/html/tutorial2/2.html?query'];
    $url[] = ['https://webreference.com:344/html/tutorial2/2.html?query'];
    return $url;
  }

  /**
   * @covers \Sphp\Stdlib\Networks\URL::__construct
   * @dataProvider urlStrings
   */
  public function testConstructWithParam($urlString) {
    $url = new URL($urlString);
    $this->assertSame($url->getRaw(), $urlString);
  }

  /**
   * @return array
   */
  public function urlStringsWithCorrectPorts() {
    $url[] = ['irc://irc.example.com/channel', 194];
    $url[] = ['http://example.com', 80];
    $url[] = ['http://www.example.com:344', 344];
    $url[] = ['https://www.example.com', 443];
    $url[] = ['ftp://www.example.com:344', 344];
    $url[] = ['ftp://ftp.example.com', 21];
    $url[] = ['ftps://ftp.example.com', 990];
    $url[] = ['ftps://ftp.example.com:21', 21];
    $url[] = ['http://www.example.com/', 80];
    $url[] = ['http://www.example.com/path?section=17', 80];
    $url[] = ['http://webreference.com:344/html/tutorial2/2.html?query', 344];
    $url[] = ['https://webreference.com:344/html/tutorial2/2.html?query', 344];
    $url[] = ['webreference.com:344/html/tutorial2/2.html?query', 344];
    $url[] = ['webreference.com/html/tutorial2/2.html?query', -1];
    return $url;
  }

  /**
   * @covers \Sphp\Stdlib\Networks\URL::getPort
   * @dataProvider urlStringsWithCorrectPorts
   * 
   * @param string $urlString
   * @param int $expectedPort
   */
  public function testGetSetPort($urlString, $expectedPort) {
    $url = new URL($urlString);
    $this->assertSame($url->getPort(), $expectedPort);
    $url->setPort(10);
    $this->assertSame($url->getPort(), 10);
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
    $this->assertTrue($u1->equals($urlString1));
    $this->assertTrue($u2->equals($urlString2));
    $this->assertTrue($u1->equals($urlString2));
    $this->assertTrue($u2->equals($urlString1));
    $this->assertTrue($u1->equals($u2));
    $this->assertTrue($u2->equals($u1));
  }

  /**
   * 
   * @return mixed[]
   */
  public function arrayData(): array {
    return [
        [[
        'scheme' => 'http',
        'host' => 'www.whatever.com',
        'user' => 'johndoe',
        'pass' => 'password',
        'path' => 'path/to/file.type',
        'query' => 'q1 = p1&q2 = p2',
        'fragment' => 'daa',
        'port' => 21
            ]],
        [[
        'scheme' => 'https',
        'host' => 'www.whatever.com',
        'user' => '',
        'pass' => 'password',
        'path' => 'path/to/file.type',
        'query' => 'q1 = p1&q2 = p2',
        'fragment' => 'daa',
        'port' => 21
            ]],
    ];
  }

  /**
   * 
   * @return mixed[]
   */
  public function setterData(): array {
    return [
        [[
        'scheme' => 'http',
        'host' => 'www.whatever.com',
        'user' => 'johndoe',
        'password' => 'password',
        //'path' => 'path/to/file.type',
        'query' => 'q1 = p1&q2 = p2',
        'fragment' => 'daa',
        //'port' => 21
            ]],
        [[
        'scheme' => 'https',
        'host' => 'whatever.com',
        'user' => 'u',
        'password' => 'p',
        //'path' => 'path/to/file.type',
        'query' => 'q1 = p1&q2 = p2',
        'fragment' => 'daa',
        //'port' => 21
            ]],
    ];
  }

  /**
   * 
   * @dataProvider setterData
   * @param array $data
   */
  public function testSettersGettersAndCheckers(array $data) {
    $url = new URL();
    echo $url->getPath();
    foreach ($data as $key => $value) {
      $par = ucfirst($key);
      $this->assertFalse($url->{"has$par"}(),"has$par failed");
      $url->{"set$par"}($value);
      //$this->assertSame(''.$url->{"get$par"}(), "$value");
      $this->assertTrue($url->{"has$par"}());
    }
  }

  /**
   * @return mixed[]
   */
  public function schemes(): array {
    return [
        ['http', 'https'],
    ];
  }

  /**
   * 
   * @dataProvider urlStrings
   * @param string $data
   */
  public function testScheme($data) {
    $url = new URL($data);
    $scheme = $url->getScheme();
    if (!$url->hasScheme()) {
      $this->assertSame($scheme, '');
    } else {
      $this->assertTrue(strlen($scheme) > 0);
    }
    $url->setScheme('http');
    $this->assertTrue($url->hasScheme());
    $this->assertSame($url->getScheme(), 'http');
  }

  /**
   * @dataProvider urlStrings
   * @param string $urlString
   */
  public function testSetPath($urlString) {
    $url = new URL($urlString);
    $url->setPath();
    $this->assertSame($url->getPath(), '');
    $this->assertFalse($url->hasPath());
    $url->setPath('path/to/file.type');
    $this->assertTrue($url->hasPath());
    $this->assertSame($url->getPath(), 'path/to/file.type');
  }

  /**
   * 
   * @return mixed[]
   */
  public function params(): array {
    return [
        [['p2' => 'v2', 'p3' => "<script>alert('hello')</script>"]],
        [['p2' => '', 'p3' => "<script>alert('hello')</script>"]],
        [['<br>' => '', 'p3' => "<script>alert('hello')</script>"]],
    ];
  }

  /**
   * @depends testEquals
   * @dataProvider urlStrings
   * @param string $urlString
   */
  public function testClone($urlString) {
    $url = new URL($urlString);
    $clone = clone $url;
    $this->assertTrue($url->equals($clone));
    $this->assertTrue($url == $clone);
    $clone->setFragment('frag');
    $this->assertFalse($url->equals($clone));
    $this->assertFalse($url == $clone);
  }

}
