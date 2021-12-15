<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Bootstrap\Layout;

use PHPUnit\Framework\TestCase;
use Sphp\Bootstrap\Layout\Container;
use Sphp\Bootstrap\Exceptions\BootstrapException;
use Sphp\Bootstrap\Layout\Col;

/**
 * The ContainerTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ContainerTest extends TestCase {

  /**
   * @return array
   */
  public function containerTypes(): array {
    $types = [];
    $types[] = ['container', 'container'];
    $types[] = [null, 'container'];
    $types[] = ['fluid', 'container-fluid'];
    $types[] = ['container-fluid', 'container-fluid'];
    $types[] = ['sm', 'container-sm'];
    $types[] = ['container-sm', 'container-sm'];
    return $types;
  }

  /**
   * @dataProvider containerTypes
   *  
   * @param string|null $type
   * @param string $className
   * @return void
   */
  public function testConstructorWithParam(?string $type, string $className): void {
    $container = new Container($type);
    $this->assertTrue($container->hasCssClass($className));
    $this->assertCount(1, $container->cssClasses());
  }

  /**
   * @return array
   */
  public function constructorParams(): array {
    $types = [];
    $types[] = [range('a', 'e')];
    return $types;
  }

  /**
   * @dataProvider constructorParams
   *  
   * @param string[] $param
   */
  public function testConstructorParams(array $param) {
    foreach ($param as $type) {
      $container = new Container($type, $param);
      $this->assertTrue($container->hasCssClass("container-$type"));
      $this->assertCount(1, $container->cssClasses());
    }
  }

  /**
   * @return void
   */
  public function testDefaultConstructor(): void {
    $container = new Container();
    $this->assertTrue($container->hasCssClass('container'));
  }

  /**
   * @dataProvider containerTypes
   * 
   * @param string|null $type
   * @param string $className
   * @return void
   */
  public function testSetType(?string $type, string $className): void {
    $c1 = new Container($type);
    $c2 = new Container();
    $this->assertSame($c2, $c2->setType($type));
    $this->assertEquals((string) $c1, (string) $c2);
    $this->assertTrue($c1->hasCssClass($className));
    $this->assertTrue($c2->hasCssClass($className));
    $this->assertCount(1, $c2->cssClasses());
  }

  /**
   * @return void
   */
  public function testInvalidConstructorCall(): void {
    $this->expectException(BootstrapException::class);
    new Container('foo');
  }

  public function testAppendRow(): void {
    $content = 'foo';
    $container = new Container();
    $row = $container->appendRow($content);
    $expected = new Col();
    $expected->append($content);
    $this->assertSame($expected->getHtml(), $row->contentToString());
    $this->assertCount(1, $container);
  }

}
