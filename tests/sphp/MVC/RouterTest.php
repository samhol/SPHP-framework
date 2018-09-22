<?php

namespace Sphp\MVC;
use Sphp\Exceptions\InvalidStateException;
class RouterTest extends \PHPUnit\Framework\TestCase {

  public function testEmptyRouting() {
    $router = new Router();
    $this->expectException(InvalidStateException::class);
    $router->execute();
  }
  /**
   * @return array
   */
  public function urls() {
    $data[] = ['http://samiholck.com/', '/'];
    $data[] = ['http://samiholck.com/index.php', '/index.php/'];
    $data[] = ['http://samiholck.com/user/view/samhol', '/user/view/samhol/'];
    $data[] = ['http://samiholck.com/101', '/101/'];
    $data[] = ['foo', 'foo/'];
    return $data;
  }

  /**
   * 
   * @dataProvider urls
   */
  public function testRouting(string $url, string $expectedPath) {
    $this->expected = $expectedPath;
    $router = new Router();
    $router->setDefaultRoute([$this, 'defaultRoute']);
    $router->route('/index.php', [$this, 'index'])
            ->route('<#user_id>', [$this, 'categories']);
    $router->route('/user/view/<:username>', [$this, 'dir']);
    $router->execute($url);
  }

  public function dir(string $string, string $folder) {
    $this->assertSame('/user/view/samhol/', $string);
    $this->assertSame('samhol', $folder);
  }
  public function index(string $string) {
    $this->assertSame('/index.php/', $string);
  }

  public function categories(string $string) {
    $this->assertTrue(is_numeric($string));
  }

  public function defaultRoute(string $string) {
    $this->assertTrue(is_string($string));
  }

  /**
   * @dataProvider urls
   * 
   * @param string $url
   * @param string $expectedPath
   */
  public function testGetPath(string $url, string $expectedPath) {
    $this->assertSame($expectedPath, Router::getPath($url));
  }

}
