<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Reflection;

use PHPUnit\Framework\TestCase;
use Sphp\Reflection\{
  ReflectorIterator,
  ExtensionReflector,
  ClassConstantReflector,
  Reflector,
  ClassReflector,
  MethodReflector,
  FunctionReflector,
  ConstantReflector
};

/**
 * The ReflectorParserTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ReflectorIteratorTest extends TestCase {

  public function reflectors(): iterable {
    yield from $this->extensionReflectors();
    yield from $this->methodReflectors();
    yield from $this->classReflectors();
    yield from $this->classConstantReflectors();
    yield from $this->constantReflectors();
    yield from $this->functionReflectors();
    // yield [new \ReflectionParameter ('\Sphp\Tests\Foo\func1', 'baz')];
  }

  /**
   * @dataProvider reflectors
   * 
   * @param  Reflector $ref
   * @return void
   */
  public function testCommonFeatures($ref): void {
    $parser = new ReflectorIterator($ref);
    $array = $parser->toArray();
    $this->assertEquals($array, iterator_to_array($parser));
    $this->assertArrayHasKey('type', $array);
    $this->assertArrayHasKey('name', $array);
    $this->assertSame($array['name'], $ref->getName());
    $this->assertJson($parser->toJson());
    // echo $parser->toJson();
    //\Sphp\Tests\Foo\func1(2);
    //print_r((new \ReflectionFunction ("\Sphp\Tests\Foo\\func1"))->getParameters()[0]);
    //print_r(new \ReflectionParameter ([\Sphp\Tests\Foo\FinalClass::class,'baz'], 'bar'));
  }

  public function classReflectors(): iterable {
    yield [new ClassReflector(\DateTimeInterface::class)];
    yield [new ClassReflector(\DateTime::class)];
    yield [new ClassReflector(\Sphp\Tests\Foo\AnInterface::class)];
    yield [new ClassReflector(\Sphp\Tests\Foo\AbstractClass::class)];
    yield [new ClassReflector(\Sphp\Tests\Foo\Instantiable::class)];
    yield [new \ReflectionClass(\Sphp\Tests\Foo\FinalClass::class)];
  }

  /**
   * @dataProvider classReflectors
   * 
   * @param  \ReflectionClass $ref
   * @return void
   */
  public function testClasses(\ReflectionClass $ref): void {
    $parser = new ReflectorIterator($ref);
    $array = $parser->toArray();
    $this->assertArrayHasKey('isInterface', $array);
    $this->assertArrayHasKey('isTrait', $array);
    $this->assertArrayHasKey('isAbstract', $array);
    $this->assertArrayHasKey('isFinal', $array);
    //$this->assertArrayHasKey('constants', $array);
  }

  public function classConstantReflectors(): iterable {
    yield [new ClassConstantReflector(\ReflectionClass::class, 'IS_FINAL')];
    yield [new \ReflectionClassConstant(\Sphp\Tests\Foo\FinalClass::class, 'PUBLIC_CONST')];
    yield [new \ReflectionClassConstant(\Sphp\Tests\Foo\AnInterface::class, 'PUBLIC_CONST')];
  }

  /**
   * @dataProvider classConstantReflectors
   * 
   * @param  \ReflectionClassConstant $ref
   * @return void
   */
  public function testClassConstants(\ReflectionClassConstant $ref): void {
    $parser = new ReflectorIterator($ref);
    $array = $parser->toArray();
    //print_r($array);
    $this->assertArrayHasKey('isPublic', $array);
    $this->assertArrayHasKey('isProtected', $array);
    $this->assertArrayHasKey('isPrivate', $array);
    $this->assertArrayHasKey('value', $array);
    //$this->assertEquals($array, iterator_to_array($parser));
    //\Sphp\Tests\Foo\func1(2);
    //print_r((new \ReflectionFunction ("\Sphp\Tests\Foo\\func1"))->getParameters()[0]);
    //print_r(new \ReflectionParameter ([\Sphp\Tests\Foo\FinalClass::class,'baz'], 'bar'));
  }

  public function methodReflectors(): iterable {
    yield [new MethodReflector(\ReflectionClass::class, 'getName')];
    yield [new \ReflectionMethod(\Sphp\Tests\Foo\AnInterface::class, 'fromInterface')];
    yield [new \ReflectionMethod(\Sphp\Tests\Foo\FinalClass::class, '__construct')];
  }

  /**
   * @dataProvider methodReflectors
   * 
   * @param  \ReflectionMethod $ref
   * @return void
   */
  public function testMethods(\ReflectionMethod $ref): void {
    $parser = new ReflectorIterator($ref);
    $array = $parser->toArray();
    // print_r($array);
    $this->assertArrayHasKey('isPublic', $array);
    $this->assertArrayHasKey('isProtected', $array);
    $this->assertArrayHasKey('isPrivate', $array);
    //$this->assertArrayHasKey('value', $array);
    //$this->assertEquals($array, iterator_to_array($parser));
    //\Sphp\Tests\Foo\func1(2);
    //print_r((new \ReflectionFunction ("\Sphp\Tests\Foo\\func1"))->getParameters()[0]);
    //print_r(new \ReflectionParameter ([\Sphp\Tests\Foo\FinalClass::class,'baz'], 'bar'));
  }

  public function constantReflectors(): iterable {
    yield [new ConstantReflector('PHP_INT_MAX')];
    yield [new ConstantReflector('\Sphp\Tests\Foo\FOO_CONST')];
  }

  /**
   * @dataProvider constantReflectors
   * 
   * @param  ConstantReflector $ref
   * @return void
   */
  public function testConstants(ConstantReflector $ref): void {
    $parser = new ReflectorIterator($ref);
    $array = $parser->toArray();
    // print_r($array);
    $this->assertArrayHasKey('inNamespace', $array);
    $this->assertArrayHasKey('namespaceName', $array);
    $this->assertArrayHasKey('shortName', $array);
    $this->assertArrayHasKey('isMagicConstant', $array);
    $this->assertArrayHasKey('value', $array);
  }

  public function functionReflectors(): iterable {
    yield [new \ReflectionFunction('abs')];
    yield [new FunctionReflector('abs')];
    yield [new FunctionReflector('\Sphp\Tests\Foo\foo')];
  }

  /**
   * @dataProvider functionReflectors
   * 
   * @param  \ReflectionFunction $ref
   * @return void
   */
  public function testFunctions(\ReflectionFunction $ref): void {
    $parser = new ReflectorIterator($ref);
    $array = $parser->toArray();
    //print_r($array);
    $this->assertArrayHasKey('isDisabled', $array);
  }

  public function extensionReflectors(): iterable {
    yield [new \ReflectionExtension('spl')];
    yield [new ExtensionReflector('Core')];
  }

  /**
   * @dataProvider extensionReflectors
   * 
   * @param  \ReflectionExtension $ref
   * @return void
   */
  public function testExtensions(\ReflectionExtension $ref): void {
    $parser = new ReflectorIterator($ref);
    $array = $parser->toArray();
    //print_r($array);
    $this->assertArrayHasKey('version', $array);
    $this->assertArrayHasKey('isTemporary', $array);
    $this->assertArrayHasKey('isPersistent', $array);
  }

  public function reflectionParameters(): iterable {
    yield [(new \ReflectionFunction("\Sphp\Tests\Foo\\func1"))->getParameters()[0]];
    yield [(new \ReflectionFunction("abs"))->getParameters()[0]];
  }

  /**
   * @dataProvider reflectionParameters
   * 
   * @param  \ReflectionParameter $ref
   * @return void
   */
  public function testParameters(\ReflectionParameter $ref): void {
    $parser = new ReflectorIterator($ref);
    $array = $parser->toArray();
    //print_r($array);
    $this->assertArrayHasKey('isVariadic', $array);
  }

}
