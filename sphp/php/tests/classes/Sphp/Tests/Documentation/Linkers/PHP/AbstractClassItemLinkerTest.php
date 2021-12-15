<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\PHP;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\PHP\AbstractClassItemLinker;
use Sphp\Documentation\Linkers\PHP\PHPApiUrlGeneratorCollection;
use Sphp\Reflection\{
  ClassMemberReflector,
  ClassConstantReflector,
  MethodReflector
};

/**
 * The AbstractClassItemLinkerTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractClassItemLinkerTest extends TestCase {

  private PHPApiUrlGeneratorCollection $urlGen;

  protected function setUp(): void {
    $this->urlGen = new PHPApiUrlGeneratorCollection();
    $this->urlGen->mapPhpDoc('Sphp', '/API/phpdoc/', 'PHPDoc');
  }

  public function reflectors(): iterable {
    yield [new ClassConstantReflector(\DateTimeInterface ::class, 'ATOM')];
    yield [new ClassConstantReflector(\Sphp\Tests\Foo\Instantiable::class, 'PRIVATE_CONST')];
    yield [new ClassConstantReflector(\Sphp\Tests\Foo\AbstractClass::class, 'PROTECTED_CONST')];
    yield [new MethodReflector(\Sphp\Tests\Foo\AbstractClass::class, 'protectedFunction')];
    yield [new MethodReflector(\Sphp\Tests\Foo\Instantiable::class, 'protectedFunction')];
  }

  /**
   * @dataProvider reflectors
   * 
   * @param ClassMemberReflector $ref
   * @return void
   */
  public function testGetters(ClassMemberReflector $ref): void {
    $mock = $this->getMockForAbstractClass(AbstractClassItemLinker::class, [$ref, $this->urlGen]);
    $this->assertSame($ref->getCurrentClass()->getNamespaceName(), $mock->getNamespaceName());
    $this->assertSame($ref->getCurrentClass()->getName(), $mock->getClassName());
    $this->assertSame($ref->getCurrentClass()->getShortName(), $mock->getShortClassName());
  }

  /**
   * @dataProvider reflectors
   * 
   * @param ClassMemberReflector $ref
   * @return void
   */
  public function testTraversing(ClassMemberReflector $ref): void {
    $mock = $this->getMockForAbstractClass(AbstractClassItemLinker::class, [$ref, $this->urlGen]);
    $this->assertEqualsCanonicalizing($mock->toArray(), iterator_to_array($mock));
  }

  /**
   * @dataProvider reflectors
   * 
   * @param  ClassMemberReflector $ref
   * @return void
   */
  public function testInvoke(ClassMemberReflector $ref): void {
    $mock = $this->getMockForAbstractClass(AbstractClassItemLinker::class, [$ref, $this->urlGen]);
    $this->assertEquals($mock(), $mock->toHyperlink());
    $this->assertEquals($mock('foo'), $mock->toHyperlink('foo'));
  }

  /**
   * @dataProvider reflectors
   * 
   * @param  ClassMemberReflector $ref
   * @return void
   */
  public function testClone(ClassMemberReflector $ref): void {
    $mock = $this->getMockForAbstractClass(AbstractClassItemLinker::class, [$ref, $this->urlGen]);
    $clone = clone $mock;
    $this->assertEquals($mock->getHyperlinkFactory(), $clone->getHyperlinkFactory());
    $this->assertNotSame($mock->getHyperlinkFactory(), $clone->getHyperlinkFactory());
  }

  /**
   * @dataProvider reflectors
   * 
   * @param  ClassMemberReflector $ref
   * @return void
   */
  public function te1tNavBars(ClassMemberReflector $ref): void {
    $mock = $this->getMockForAbstractClass(AbstractClassItemLinker::class, [$ref, $this->urlGen]);
    $inlineNav = $mock->toInlineNavBar();
    foreach ($mock->toArray() as $linker) {
      $this->assertContains($linker->toShortLink(), $inlineNav);
    }
  }

}
