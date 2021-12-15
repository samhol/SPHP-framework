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
use Sphp\Reflection\ClassReflector;
use Sphp\Reflection\ClassConstantReflector;
use Sphp\Reflection\MethodReflector;
use Sphp\Reflection\PropertyReflector;
use ReflectionMethod;
use ReflectionClass;
use ReflectionProperty;
use Sphp\Reflection\ExtensionReflector;

/**
 * Class ClassReflectorTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ClassReflectorTest extends TestCase {

  public function reflectedData(): array {
    $arr[] = [\DateTime::class, 'date'];
    $arr[] = [\ReflectionClass::class, 'Reflection'];
    $arr[] = [\Sphp\Tests\Foo\BarTrait::class, null];
    $arr[] = [\Sphp\Tests\Foo\FooTrait::class, null];
    $arr[] = [\Sphp\Tests\Foo\AnInterface::class, null];
    $arr[] = [\Sphp\Tests\Foo\AbstractClass::class, null];
    $arr[] = [\Sphp\Tests\Foo\Instantiable::class, null];
    return $arr;
  }

  public function generateInstance(...$args) {
    return new ClassReflector(...$args);
  }

  /**
   * @dataProvider reflectedData
   *
   * @param  string|object  $class
   * @param  string $extension
   * @return void
   */
  public function testExtensionReflection($class, string $extension = null): void {
    $ref = new ClassReflector($class);
    $phpRef = new ReflectionClass($class);
    $this->assertSame($extension, $ref->getExtensionName());
    if ($phpRef->getExtensionName() === false) {
      $this->assertNull($ref->getExtensionName());
      $this->assertNull($ref->getExtension());
    } else {
      $this->assertEquals(new ExtensionReflector($extension), $ref->getExtension());
      $this->assertTrue($ref->isInternal());
    }
  }

  public function modifierNameData(): iterable {
    yield [\Sphp\Tests\Foo\FooTrait::class, 'trait'];
    yield [\Sphp\Tests\Foo\AnInterface::class, 'interface'];
    yield [\Sphp\Tests\Foo\AbstractClass::class, 'abstract class'];
    yield [\Sphp\Tests\Foo\Instantiable::class, 'class'];
    yield [\Sphp\Tests\Foo\FinalClass::class, 'final class'];
  }

  /**
   * @dataProvider modifierNameData
   * 
   * @param  string $className
   * @param  string $modifierName
   * @return void
   */
  public function testGetModifierNames(string $className, string $modifierName): void {
    $ref = new ClassReflector($className);
    $this->assertSame($modifierName, $ref->getModifierNames()); 
  }

  /**
   * @dataProvider reflectedData
   *
   * @param  mixed $class
   * @return void
   */
  public function testReflectionConstants($class): void {
    $phpRef = new ReflectionClass($class);
    $expectedCount = count($phpRef->getConstants());
    $ref = new ClassReflector($class);
    $constRefs = $ref->getReflectionConstants();
    $this->assertCount($expectedCount, $constRefs);
    foreach ($constRefs as $constName => $constRef) {
      $this->assertInstanceOf(ClassConstantReflector::class, $constRef);
      $this->assertTrue($ref->hasConstant($constName));
      $this->assertEquals($constRef, $ref->getReflectionConstant($constName));
    }
  }

  /**
   * @return void
   */
  public function testGetTraits(): void {
    $class = \A\B\C::class;
    $phpRef = new ReflectionClass($class);
    $traitNames = $phpRef->getTraitNames();
    $expectedCount = count($traitNames);
    $ref = new ClassReflector($class);
    $traits = $ref->getTraits();
    $this->assertCount($expectedCount, $traits);
    foreach ($traits as $trait) {
      $this->assertInstanceOf(ClassReflector::class, $trait);
    }
  }

  /**
   * @dataProvider reflectedData
   *
   * @param  mixed $args
   * @return void
   */
  public function testConstructorReflection($args): void {
    $nativeRef = new ReflectionClass($args);
    $nativeConstructor = $nativeRef->getConstructor();
    $ref = new ClassReflector($args);
    $constructor = $ref->getConstructor();
    if ($nativeConstructor === null) {
      $this->assertNull($constructor);
    } else {
      $this->assertInstanceOf(MethodReflector::class, $constructor);
      $this->assertSame($constructor->class, $nativeConstructor->class);
      $this->assertSame($constructor->name, $nativeConstructor->name);
    }
  }

  /**
   * @dataProvider reflectedData
   *
   * @param  mixed $class
   * @return void
   */
  public function testInterfacesReflection($class): void {
    $nativeRef = new ReflectionClass($class);
    $interfaceNames = $nativeRef->getInterfaceNames();
    $ref = new ClassReflector($class);
    $interfaces = $ref->getInterfaces();
    $this->assertCount(count($interfaceNames), $interfaces);
    foreach ($interfaces as $interface) {
      $this->assertInstanceOf(ClassReflector::class, $interface);
      $nativeRef->implementsInterface($interface->name);
      $this->assertContains($interface->name, $interfaceNames);
    }
  }

  /**
   * @dataProvider reflectedData
   *
   * @param  mixed $name
   * @return void
   */
  public function testMethodReflection($name): void {
    $ref = new ClassReflector($name);
    $phpRef = new ReflectionClass($name);
    $flags = [
        null,
        ReflectionMethod::IS_STATIC,
        ReflectionMethod::IS_PUBLIC,
        ReflectionMethod::IS_PROTECTED,
        ReflectionMethod::IS_PRIVATE,
        ReflectionMethod::IS_ABSTRACT,
        ReflectionMethod::IS_FINAL];
    foreach ($flags as $flag) {
      $nativeMethods = $phpRef->getMethods($flag);
      $expectedCount = count($nativeMethods);
      $methods = $ref->getMethods($flag);
      $this->assertCount($expectedCount, $methods);
      foreach ($methods as $methodName => $method) {
        $this->assertInstanceOf(MethodReflector::class, $method);
        $this->assertTrue($ref->hasMethod($methodName));
        $this->assertTrue($phpRef->hasMethod($methodName));
        $this->assertEquals($method, $ref->getMethod($methodName));
      }
    }
  }

  /**
   * @dataProvider reflectedData
   *
   * @param  mixed $class
   * @return void
   */
  public function testPropertyReflection($class): void {
    $flags = [
        null,
        ReflectionProperty::IS_STATIC,
        ReflectionProperty::IS_PUBLIC,
        ReflectionProperty::IS_PROTECTED,
        ReflectionProperty::IS_PRIVATE];
    $phpRef = new \ReflectionClass($class);
    $ref = new ClassReflector($class);
    foreach ($flags as $flag) {
      $nativeProperties = $phpRef->getProperties($flag);
      $testedRefs = $ref->getProperties($flag);
      $this->assertCount(count($nativeProperties), $testedRefs);
      foreach ($testedRefs as $name => $testedRef) {
        $this->assertInstanceOf(PropertyReflector::class, $testedRef);
        $this->assertTrue($ref->hasProperty($name));
        $testedRef1 = $ref->getProperty($name);
        $this->assertNotNull($testedRef1);
        $this->assertEquals($testedRef, $testedRef1);
      }
    }
  }

  public function arrayMap() {
    $arr[] = [\A\B\I::class];
    $arr[] = [\A\B\T1::class];
    $arr[] = [\A\B\AC::class];
    $arr[] = [\A\B\C::class];
    return $arr;
  }

}
