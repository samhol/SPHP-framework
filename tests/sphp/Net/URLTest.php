<?php

namespace Sphp\Net;

class URLTest extends \PHPUnit_Framework_TestCase {

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

  /**
   *
   * @covers Sphp\Net\URL::getPort
   */
  public function testGetPort() {
    $url1 = new URL("http://www.example.com:80/bar.html");
    $url2 = new URL("http://www.example.com/bar.html");
    $url3 = new URL("https://www.example.com/bar.html");
    $url4 = new URL("https://www.example.com/bar.html");
    $this->assertTrue($this->http->getPort() === $url1->getPort());
    $this->assertFalse($url1->getPort() === $url3->getPort());
    $this->assertTrue(443 === $this->https->getPort());
  }

  /**
   *
   * @covers Sphp\Net\URL::getPort
   */
  public function testQuery() {
    $this->assertTrue($this->http->getQuery() === $this->https->getQuery());

    $url = new URL("https://www.example.com/bar.html?a=k/s/p.png");
    $url->setParam("op", FALSE);
    $url->setParam("op1", (new URL("https://www.example.com/bar.html?a=k/s/p.png"))->getRaw());
    $this->assertTrue($url->getParam("op") === FALSE);
    echo $url->getHtml();
  }

  /**
   * 
   *
   * @covers Sphp\Net\URL::getIterator
   */
  public function testGetIterator() {
    
  }

  /**
   * 
   * @covers Sphp\Net\URL::equals
   */
  public function testEquals() {
    $u1 = new URL("http://www.example.com/bar.html?a=b&b=c");
    $u2 = new URL("http://www.example.com/bar.html?b=c&a=b");
    $u3 = new URL("http://www.example.com/bar.html?b=c&amp;a=b");
    $this->assertTrue($u1->equals($u2));
    $this->assertTrue($u2->equals($u1));
    $this->assertTrue($u1->equals($u3));
    $this->assertTrue($u2->equals($u3));
    $this->assertFalse($this->http->equals($this->https));
    $this->assertFalse($this->http->equals($this->https));
  }

  /**
   * 
   * @return mixed[]
   */
  public function arrayData() {
    return [
        [[
        'scheme' => 'http',
        'host' => 'www.whatever.com',
        'user' => 'johndoe',
        'pass' => 'password',
        'path' => 'path/to/file.type',
        'query' => 'q1=p1&q2=p2',
        'fragment' => 'daa',
        'port' => 21
            ]],
        [[
        'scheme' => 'https',
        'host' => 'www.whatever.com',
        'user' => '',
        'pass' => 'password',
        'path' => 'path/to/file.type',
        'query' => 'q1=p1&q2=p2',
        'fragment' => 'daa',
        'port' => 21
            ]],
    ];
  }

  /**
   * 
   * @return mixed[]
   */
  public function schemes() {
    return [
        ['http', 'https'],
    ];
  }

  /**
   * 
   * @dataProvider arrayData
   * @param mixed[] $data
   */
  public function testScheme($data) {
    $url = new URL;
    $this->assertFalse($url->hasScheme());
    $this->assertSame($url->getScheme(), '');
    $url->setScheme($data['scheme']);
    $this->assertTrue($url->hasScheme());
    $this->assertSame($url->getScheme(), $data['scheme']);

    return $url;
  }

  /**
   * @depends testScheme
   * @param mixed[] $url
   */
  public function testSetHost(URL $url) {
    $url->setHost('path/to/file.type');
    $this->assertTrue($url->hasPath());
    $this->assertSame($url->getPath(), 'path/to/file.type');

    return $url;
  }

}
