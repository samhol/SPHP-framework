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
 * Description of AbstractClassLinkerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractClassLinkerTest extends TestCase {

  /**
   * @param  HyperlinkGenerators\UrlGenerator $urlGen
   * @return HyperlinkGenerators\AbstractLinker
   */
  public function createLinker(string $className = AbstractClassLinker::class): AbstractClassLinker {
    $linker = $this->getMockForAbstractClass(AbstractClassLinker::class, [$className, $this->createUrlGen()]);
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
            ->method('getClassMethodUrl')
            ->will($this->returnValue('root/class-method'));
    $gen->expects($this->any())
            ->method('getClassConstantUrl')
            ->will($this->returnValue('root/class-constant'));
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
    $classLink = $linker->getLink();
    //echo $classLink;
    //echo  $linker->methodLink('assertSame');
    $this->assertSame('root/class', $classLink->getHref());
    $classMethodLink = $linker->methodLink('assertSame');
    $this->assertSame('root/class-method', $classMethodLink->getHref());
  }

  public function classTypes(): array {
    $attrs = [];
    $attrs[] = [\Sphp\Html\AjaxLoaderTrait::class, 'trait'];
    $attrs[] = [AbstractClassLinker::class, 'abstract-class'];
    $attrs[] = [UrlGenerator::class, 'instantiable-class'];
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
    $classLink = $linker->getLink();
    $this->assertTrue($classLink->attributeExists('title'));
    $this->assertSame('root/class', $classLink->getHref());
   // echo "\n{$classLink->getAttribute('class')}\n";
    $this->assertTrue($classLink->hasCssClass($type), "$class-API-link does not have '$type' as a cssclass");
  }

  public function methods(): array {
    $attrs = [];
    $attrs[] = [AbstractClassLinker::class, '__construct', 'constructor'];
    $attrs[] = [AbstractClassLinker::class, '__destruct', 'destructor'];
    $attrs[] = [AbstractClassLinker::class, '__clone', 'instance-method'];
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

}
