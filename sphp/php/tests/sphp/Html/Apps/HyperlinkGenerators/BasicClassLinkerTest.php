<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Description of AbstractClassLinkerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BasicClassLinkerTest extends TestCase {

  /**
   * 
   * @param  string $className
   * @return BasicClassLinker
   */
  public function createLinker(string $className = BasicClassLinker::class): BasicClassLinker {
    $linker = new BasicClassLinker($className, $this->createUrlGen());
    return $linker;
  }

  public function createUrlGen(): ClassUrlGenerator {
    $gen = $this->getMockBuilder(ClassUrlGenerator::class)
            ->setMethods([
                'getClassUrl',
                'getClassMethodUrl',
                'getClassConstantUrl',
                'getNamespaceUrl'])
            ->getMock();
    $gen->expects($this->any())
            ->method('getClassUrl')
            ->will($this->returnValue('root/class'));
    $gen->expects($this->any())
            ->method('getClassMethodUrl')
            ->will($this->returnValue('root/class-method'));
    $gen->expects($this->any())
            ->method('getClassConstantUrl')
            ->will($this->returnValue('root/class-constant'));
    $gen->expects($this->any())
            ->method('getNamespaceUrl')
            ->will($this->returnValue('root/namespace'));
    return $gen;
  }

  public function testConstructor() {
    $class = \DateTime::class;
    $linker = $this->createLinker($class);
    $classLink = $linker->getLink();
    $this->assertSame((string) $classLink, (string) $linker);
    $this->assertSame($linker->urls()->getClassUrl($class), $classLink->getHref());
    $this->assertSame($class, $linker->getClassName());
  }

  public function testClone() {
    $linker = $this->createLinker();
    $clone = clone $linker;
    $this->assertEquals($clone, $linker);
    $this->assertEquals($clone->urls(), $linker->urls());
    $this->assertNotSame($clone, $linker);
    $this->assertNotSame($clone->urls(), $linker->urls());
  }

  public function classTypes(): array {
    $attrs = [];
    $attrs[] = [\Sphp\Html\AjaxLoaderTrait::class, 'trait'];
    $attrs[] = [AbstractLinker::class, 'abstract-class'];
    $attrs[] = [BasicUrlGenerator::class, 'instantiable-class'];
    $attrs[] = [ApiUrlGenerator::class, 'interface'];
    return $attrs;
  }

  /**
   * @dataProvider classTypes
   * 
   * @param string $class
   * @param string $type
   */
  public function testClassLink(string $class, string $type) {
    $linker = $this->createLinker($class);
    $linker->useAttributes(['foo' => 'bar']);
    $classLink = $linker->getLink();
    $this->assertTrue($classLink->attributeExists('title'));
    $this->assertSame('root/class', $classLink->getHref());
    // echo "\n{$classLink->getAttribute('class')}\n";
    $this->assertTrue($classLink->hasCssClass($type), "$class-API-link does not have '$type' as a CSS-class");
  }

  public function methods(): array {
    $attrs = [];
    $attrs[] = [BasicClassLinker::class, '__construct', 'constructor'];
    $attrs[] = [BasicClassLinker::class, '__destruct', 'destructor'];
    $attrs[] = [BasicClassLinker::class, '__clone', 'instance-method'];
    $attrs[] = [Factory::class, 'sami', 'static-method'];
    return $attrs;
  }

  /**
   * @dataProvider methods
   * @param string $methodName
   * @param string $type
   */
  public function testClassMethodLink(string $class, string $methodName, string $type) {
    $linker = $this->createLinker($class);
    $classMethodLink = $linker->methodLink($methodName);
    $shortClassMethodLink = $linker->methodLink($methodName, false);
    $this->assertSame('root/class-method', $classMethodLink->getHref());
    $this->assertTrue($classMethodLink->attributeExists('title'));
    $this->assertTrue($classMethodLink->hasCssClass($type));
    $this->assertRegExp("/$methodName\(\)$/", $classMethodLink->contentToString());
    $this->assertRegExp("/^$methodName\(\)$/", $shortClassMethodLink->contentToString());
  }

  public function testInvalidMethodLink() {
    $linker = $this->createLinker(\stdClass::class);
    $this->expectException(InvalidArgumentException::class);
    $linker->methodLink('foo');
  }

  public function constants(): array {
    $attrs = [];
    $attrs[] = [\DateTime::class, 'ATOM', 'constant'];
    $attrs[] = [\Sphp\Validators\NotEmpty::class, 'ANY_TYPE', 'constant'];
    return $attrs;
  }

  /**
   * @dataProvider constants
   * @param string $constantName
   * @param string $type
   */
  public function testClassConstantLink(string $class, string $constantName, string $type) {
    $linker = $this->createLinker($class);
    $link = $linker->constantLink($constantName);
    $this->assertSame('root/class-constant', $link->getHref());
    $this->assertTrue($link->attributeExists('title'));
    $this->assertTrue($link->hasCssClass($type));
    $this->assertRegExp("/::$constantName$/", $link->contentToString());
  }

  /**
   * @dataProvider classTypes
   * @param string $constantName
   * @param string $type
   */
  public function testClassNamespaceLink(string $class) {
    $linker = $this->createLinker($class);
    $classRef = new \ReflectionClass($class);
    $namespaceName = $classRef->getNamespaceName();
    $link = $linker->namespaceLink();
    $namedLink = $linker->namespaceLink('foo');
    $shortLink = $linker->shortNamespaceLink();
    $this->assertSame('root/namespace', $link->getHref());
    $this->assertSame('root/namespace', $shortLink->getHref());
    $this->assertTrue($link->attributeExists('title'));
    $this->assertTrue($shortLink->attributeExists('title'));
    $this->assertSame("$namespaceName namespace", $link->getAttribute('title'));
    $this->assertSame("$namespaceName namespace", $shortLink->getAttribute('title'));
    $this->assertSame('foo', $namedLink->contentToString());
    $this->assertTrue($link->hasCssClass('namespace'));
    $this->assertTrue($shortLink->hasCssClass('namespace'));
  }

  public function testClassBreadcrumbs() {
    $linker = $this->createLinker(BasicClassLinker::class);
    $urls = $this->createUrlGen();
    $breadCrumbs = $linker->classBreadGrumbs();
    $parts = explode('\\', BasicClassLinker::class);
    foreach ($breadCrumbs as $no => $breadCrumb) {
      $this->assertSame($parts[$no], $breadCrumb->getHyperlink()->contentToString());
    }
  }

}
