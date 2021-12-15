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
use Sphp\Documentation\Linkers\PHP\ClassConstantLinker;
use Sphp\Reflection\ClassConstantReflector;
use Sphp\Documentation\Linkers\PHP\URLGenerators\PhpDocUrls;
use Sphp\Documentation\Linkers\HyperlinkFactory;
use Sphp\Documentation\Linkers\PHP\PHPApiUrlGeneratorCollection;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;
use Sphp\Stdlib\Strings;

/**
 * Class ClassConstantLinkerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ClassConstantLinkerTest extends TestCase {
 
  protected PHPApiUrlGeneratorCollection $urlGen;

  protected function setUp(): void {
    $this->urlGen = new PHPApiUrlGeneratorCollection();
    $this->urlGen->mapNamespace('Sphp', new PhpDocUrls('/API/phpdoc/'));
  }

  public function constantData(): iterable {
    yield [\ReflectionClass::class, 'IS_IMPLICIT_ABSTRACT'];
    yield [\Sphp\Tests\Foo\AbstractClass::class, 'PROTECTED_CONST'];
    yield [\Sphp\Tests\Foo\Instantiable::class, 'PRIVATE_CONST'];
  }

   
  /**
   * @dataProvider constantData
   * 
   * @param  string $class
   * @param  string $constant
   * @return void
   */
  public function testConstructorAndStaticCreateMethod(string $class, string $constant): void {
    $hlf = new HyperlinkFactory;
    $linker = ClassConstantLinker::create($class, $constant, $this->urlGen, $hlf);
    $ref =  new ClassConstantReflector($class, $constant);
    $expected = "{$linker->getShortClassName()}::{$linker->getConstantName()}";
    $this->assertEquals($linker, new ClassConstantLinker($ref, $this->urlGen, $hlf));
    $link = $linker->toHyperlink();
    $shortLink = $linker->toShortlink();
    $this->assertSame($this->urlGen->getClassConstantUrl($class, $constant), $link->getHref());
    $this->assertSame($expected, $linker->getDefaultContent());
    $this->assertSame($expected, $link->contentToString());
    $this->assertSame($constant, $shortLink->contentToString());
    $this->assertSame($this->urlGen->getClassConstantUrl($class, $constant), $shortLink->getHref());
  }

  /**
   * @dataProvider constantData
   * 
   * @param  string $class
   * @param  string $constant
   * @return void
   */
  public function testNavBarTirle(string $class, string $constant): void {
    $hlf = new HyperlinkFactory;
    $ref = new ClassConstantReflector($class, $constant);
    $linker = new ClassConstantLinker($ref, $this->urlGen, $hlf);
    $expected = Strings::convertCase($ref->getModifierNames(), MB_CASE_TITLE);
    $expected = "$expected Class Constant";
    $this->assertEquals($expected, $linker->getNavBarTitle());
  }

  public function invalidConstantData(): iterable {
    yield [\ReflectionClass::class, 'FOO'];
    yield ['bar', 'IS_EXPLICIT_ABSTRACT'];
  }

  /**
   * @dataProvider invalidConstantData
   * 
   * @param  string $class
   * @param  string $constant
   * @return void
   */
  public function testStaticCreateFailures(string $class, string $constant): void {
    $hlf = new HyperlinkFactory;
    $this->expectException(NonDocumentedFeatureException::class);
    ClassConstantLinker::create($class, $constant, $this->urlGen, $hlf);
  }

}
