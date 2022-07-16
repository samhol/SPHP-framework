<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\MVC;

use PHPUnit\Framework\TestCase;
use Sphp\MVC\{Router, RouteData};
use Sphp\Stdlib\Strings;
use Sphp\Exceptions\IllegalStateException;

class RouterTest extends TestCase {

  public function urls(): iterable {
    yield ['http://samiholck.com/', '/'];
    yield ['http://samiholck.com/index.php', '/index.php/'];
    yield ['http://samiholck.com/user/view/samhol', '/user/view/samhol/'];
    yield ['http://samiholck.com/101', '/101/'];
    yield ['/foo', '/foo/'];
    yield ['/', '/'];
  }

  public function testEmptyRouting(): void {
    $router = new Router();
    $this->assertTrue($router->isEmpty());
    $this->expectException(IllegalStateException::class);
    $router->execute('https://samiholck.com/');
  }

  /**
   * @dataProvider urls
   * 
   * @param  string $url
   * @return void
   */
  public function testRoutingWithMissingRoute(string $url): void {
    $router = new Router();
    $router->route('/foo/bar', [$this, 'defaultRoute']);
    $this->expectException(IllegalStateException::class);
    $router->execute($url);
  }

  /**
   * @dataProvider urls
   * 
   * @param  string|null $url
   * @return void
   */
  public function testRoutingWithoutDefault(string $url): void {
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
   * 
   * @param  string $url
   * @return void
   */
  public function testRouting(string $url): void {
    $router = new Router();
    $router->setDefaultRoute([$this, 'defaultRoute']);
    $router->route('/index.php', [$this, 'index'])
            ->route('/<#user_id>', [$this, 'categories']);
    $router->route('/user/view/<:username>', [$this, 'dir']);
    $router->execute($url);
  }

  public function dir(RouteData $routeData): void {
    $this->assertSame('/user/view/samhol/', $routeData->getPath());
    $this->assertSame('samhol', $routeData->getParam(0));
  }

  public function index(RouteData $routeData): void {
    $this->assertSame('/index.php/', $routeData->getPath());
  }

  public function categories(RouteData $routeData): void { 
    $this->assertTrue(is_numeric($routeData->getParam(0)), "capture is not numeric when using path '{$routeData->getPath()}'");
  }

  public function alphanum(RouteData $routeData): void {
    $this->assertMatchesRegularExpression('/^[[:alnum:]]*$/',$routeData->getParam(0), "capture is not alphanumeric when using path '{$routeData->getPath()}'");
  }

  public function defaultRoute(RouteData $routeData): void {
    $this->assertIsString($routeData->getPath());
  }

  /**
   * @dataProvider urls
   * 
   * @param  string $url
   * @param  string $expectedPath
   * @return void
   */
  public function testGetPath(string $url, string $expectedPath): void {
    $this->assertSame($expectedPath, Router::getPath($url));
  }

}
