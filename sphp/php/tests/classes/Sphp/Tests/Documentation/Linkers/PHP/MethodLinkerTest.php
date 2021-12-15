<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\PHP;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\PHP\MethodLinker;
use Sphp\Reflection\MethodReflector;
use Sphp\Documentation\Linkers\HyperlinkFactory;
use Sphp\Documentation\Linkers\PHP\PHPApiUrlGeneratorCollection;
use Sphp\Documentation\Linkers\PHP\NamespaceLinker;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException; 
use Sphp\Stdlib\Strings;

/**
 * Class ClassMethodLinkerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class MethodLinkerTest extends TestCase {

  protected PHPApiUrlGeneratorCollection $urlGen;

  protected function setUp(): void {
    $this->urlGen = new PHPApiUrlGeneratorCollection();
    $this->urlGen->mapPhpDoc('Sphp', '/API/phpdoc/', 'SPHPlayground api docs');
  }

  /**
   * @dataProvider methods
   * 
   * @param  string $class
   * @param  string $method
   * @return void
   */
  public function testConstructor(string $class, string $method): void {
    $classRef = new \ReflectionClass($class);
    $linker = MethodLinker::create($class, $method, $this->urlGen);
    $link = $linker->toHyperlink();
    //$this->assertSame((string) $classLink, (string) $linker);
    $this->assertSame($this->urlGen->getClassMethodUrl($class, $method), $link->getHref());
    $this->assertSame("{$classRef->getShortName()}::$method()", $link->contentToString());
  }

  /**
   * @dataProvider methods
   * 
   * @param  string $class
   * @param  string $method
   * @return void
   */
  public function testClone(string $class, string $method): void {
    $hlf = new HyperlinkFactory;
    $linker = MethodLinker::create($class, $method, $this->urlGen);
    $clone = clone $linker;
    $this->assertEquals($clone, $linker);
    $this->assertNotSame($clone, $linker);
    $this->assertNotSame($hlf, $clone->getHyperlinkFactory());
  }

  public function methods(): iterable {
    yield [\Sphp\Tests\Foo\Instantiable::class, '__construct', 'constructor'];
    yield [\Sphp\Tests\Foo\Instantiable::class, 'staticFunction', 'destructor'];
    yield [\Sphp\Tests\Foo\Instantiable::class, 'protectedFunction', 'instance-method'];
    yield[\DateTime::class, 'format'];
  }

  /**
   * @dataProvider methods
   * 
   * @param  string $class
   * @param  string $method
   * @return void
   */
  public function testNavBarTirle(string $class, string $method): void {
    $hlf = new HyperlinkFactory;
    $ref = new MethodReflector($class, $method);
    $linker = new MethodLinker($ref, $this->urlGen, $hlf);
    $expected = Strings::convertCase($ref->getModifierNames(), MB_CASE_TITLE);
    $expected = "$expected Method";
    $this->assertEquals($expected, $linker->getNavBarTitle());
  }

  public function testInvalidMethodLink() {
    $this->expectException(NonDocumentedFeatureException::class);
    MethodLinker::create('foo', 'bar', $this->urlGen);
  }

  /**
   * @dataProvider methods
   * 
   * @param  string $class
   * @param  string $method
   * @return void
   */
  public function testBasicGettersAndInvoke(string $class, string $method): void {

    $linker = MethodLinker::create($class, $method, $this->urlGen);
    $ref = new MethodReflector($class, $method);
    $this->assertSame($class, $linker->getClassName());
    $this->assertSame($ref->getCurrentClass()->getShortName(), $linker->getShortClassName());
    $this->assertSame($method, $linker->getMethodName());
    $this->assertEquals($linker->toHyperlink(), $linker());
    $this->assertEquals($linker->toHyperlink('foo'), $linker('foo'));
  }

  /**
   * @dataProvider methods
   * 
   * @param  string $class
   * @param  string $method
   * @return void
   */
  public function testNamespacing(string $class, string $method): void {
    $rc = new \ReflectionClass($class);
    $linker = MethodLinker::create($class, $method, $this->urlGen);
    if ($rc->inNamespace()) {
      $nsLinker = new NamespaceLinker($rc->getNamespaceName(), $this->urlGen);
      $this->assertEquals($nsLinker->getUrl(), $linker->namespaceLink()->getUrl());
    } else {
      $this->assertNull($linker->namespaceLink());
    }
  }

  public function testNavBars(): void {
    $class = \Sphp\Html\Lists\Ol::class;
    $method = 'setListType';
    $linker = MethodLinker::create($class, $method, $this->urlGen);
    $arr = $linker->toArray();

    $inlineNavBar = $linker->toInlineNavBar();
    $links = $inlineNavBar->getComponentsByObjectType(A::class);
    $navBar = $linker->toNavBar();
    //print_r($links); 
    foreach ($links as $k => $link) {
      $this->assertEquals($arr[$k]->toShortLink(), $link);
    }
    $this->assertEquals($links, $navBar->getComponentsByObjectType(A::class));
  }

}
