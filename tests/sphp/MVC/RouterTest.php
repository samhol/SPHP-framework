<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\MVC;

use PHPUnit\Framework\TestCase;
use Sphp\Stdlib\Strings;
use Sphp\Exceptions\IllegalStateException;

class RouterTest extends TestCase {

  /**
   * @return array
   */
  public function urls() {
    $data[] = ['http://samiholck.com/', '/'];
    $data[] = ['http://samiholck.com/index.php', '/index.php/'];
    $data[] = ['http://samiholck.com/user/view/samhol', '/user/view/samhol/'];
    $data[] = ['http://samiholck.com/101', '/101/'];
    $data[] = ['/foo', '/foo/'];
    $data[] = ['/', '/'];
    return $data;
  }

  public function testEmptyRouting() {
    $router = new Router();
    $this->assertTrue($router->isEmpty());
    $this->expectException(IllegalStateException::class);
    $router->execute('http://samiholck.com/');
  }

  /**
   * @dataProvider urls
   * @param string|null $url
   */
  public function testRoutingWithMissingRoute($url) {
    $router = new Router();
    $router->route('/foo/bar', [$this, 'defaultRoute']);
    $this->expectException(IllegalStateException::class);
    $router->execute($url);
  }

  /**
   * @dataProvider urls
   * @param string|null $url
   */
  public function testRoutingWithoutDefault($url) {
    $router = new Router();
    $router->route('/', [$this, 'defaultRoute']);
    $this->assertFalse($router->isEmpty());
    $router->route('/index.php', [$this, 'defaultRoute']);
    $router->route('/<#user_id>', [$this, 'defaultRoute']);
    $router->route('/<:username>', [$this, 'alphanum']);
    $router->route('/user/view/<:username>', [$this, 'dir']);
    $router->execute($url);
  }

  /**
   * @dataProvider urls
   * @param string|null $url
   */
  public function testRouting($url) {
    $router = new Router();
    $router->setDefaultRoute([$this, 'defaultRoute']);
    $router->route('/index.php', [$this, 'index'])
            ->route('/<#user_id>', [$this, 'categories']);
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

  public function categories(string $path, string $capture) {
    $this->assertTrue(is_numeric($capture), "$capture is not numeric when using path '$path'");
  }

  public function alphanum(string $path, string $capture) {
    $this->assertTrue(Strings::isAlphanumeric($capture), "$capture is not alphanumeric when using path '$path'");
  }

  public function defaultRoute(string $path) {
    $this->assertTrue(is_string($path));
  }

  /**
   * @dataProvider urls
   * 
   * @param string|null $url
   * @param string $expectedPath
   */
  public function testGetPath($url, string $expectedPath) {
    $this->assertSame($expectedPath, Router::getPath($url));
  }

}
