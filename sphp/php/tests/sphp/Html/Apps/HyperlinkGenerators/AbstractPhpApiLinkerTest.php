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

/**
 * Description of AbstractPhpApiLinkerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractPhpApiLinkerTest extends TestCase {

  /**
   * 
   * @param string $className
   * @return BasicClassLinker
   */
  public function createLinker(string $className = BasicClassLinker::class): BasicPhpApiLinker {
    $linker = new BasicPhpApiLinker($this->createUrlGen(), BasicClassLinker::class, __NAMESPACE__);
    return $linker;
  }

  public function createUrlGen(): ApiUrlGenerator {
    $gen = $this->getMockBuilder(ApiUrlGenerator::class)
            ->setMethods([
                'getRoot',
                'createUrl',
                'getClassUrl',
                'getClassMethodUrl',
                'getClassConstantUrl',
                'getNamespaceUrl',
                'getFunctionUrl',
                'getConstantUrl'])
            ->getMock();
    $gen->expects($this->any())
            ->method('getRoot')
            ->will($this->returnValue('root/'));
    $gen->expects($this->any())
            ->method('createUrl')
            ->will($this->returnValue('createUrl'));
    $gen->expects($this->any())
            ->method('getClassUrl')
            ->will($this->returnValue('root/class'));
    $gen->expects($this->any())
            ->method('getNamespaceUrl')
            ->will($this->returnValue('root/namespace'));
    $gen->expects($this->any())
            ->method('getFunctionUrl')
            ->will($this->returnValue('root/function'));
    $gen->expects($this->any())
            ->method('getConstantUrl')
            ->will($this->returnValue('root/constant'));
    return $gen;
  }

  public function testConstructor() {
    $linker = $this->createLinker();
    $this->assertSame($linker, $linker);
    $classLink = $linker->classLinker(\Sphp\DateTime\Date::class);
  }

  public function functionData(): array {
    $attrs = [];
    $attrs[] = ['trim', 'function'];
    return $attrs;
  }

  /**
   * @dataProvider functionData
   * 
   * @param string $functionName
   * @param string $type
   */
  public function testFunctionLink(string $functionName, string $type) {
    $linker = $this->createLinker($functionName);
    $linker->useAttributes(['foo' => 'bar']);
    $classLink = $linker->functionLink($functionName);
    $this->assertTrue($classLink->attributeExists('title'));
    $this->assertSame('root/function', $classLink->getHref());
    // echo "\n{$classLink->getAttribute('class')}\n";
    $this->assertTrue($classLink->hasCssClass($type), "$functionName-API-link does not have '$type' as a cssclass");
  }

  public function methods(): array {
    $attrs = [];
    $attrs[] = [BasicClassLinker::class, '__construct', 'constructor'];
    $attrs[] = [BasicClassLinker::class, '__destruct', 'destructor'];
    $attrs[] = [BasicClassLinker::class, '__clone', 'instance-method'];
    $attrs[] = [Factory::class, 'sami', 'static-method'];
    return $attrs;
  }

  public function constants(): array {
    $attrs = [];
    $attrs[] = ['MB_CASE_FOLD'];
    return $attrs;
  }

  /**
   * @dataProvider constants
   * @param string $constant
   */
  public function testConstantLink(string $constant) {
    $linker = $this->createLinker();
    $link = $linker->constantLink($constant);
    $namedLink = $linker->constantLink($constant, 'foo');
    $this->assertSame('root/constant', $link->getHref());
    $this->assertTrue($link->attributeExists('title'));
    $this->assertTrue($link->hasCssClass('constant'));
    $this->assertRegExp("/$constant/", $link->contentToString());
    $this->assertSame('foo', $namedLink->contentToString());
  }


  public function namespaceData(): array {
    $attrs = [];
    $attrs[] = [__NAMESPACE__, 'namespace'];
    return $attrs;
  }

  /**
   * @dataProvider namespaceData
   * @param string $constantName
   * @param string $type
   */
  public function testNamespaceLink(string $namespace) {
    $linker = $this->createLinker();
    $link = $linker->namespaceLink($namespace);
    $this->assertSame('root/namespace', $link->getHref());
    $this->assertTrue($link->attributeExists('title'));
    $this->assertSame("The $namespace namespace", $link->getAttribute('title'));
    $this->assertTrue($link->hasCssClass('namespace'));
  }

}
