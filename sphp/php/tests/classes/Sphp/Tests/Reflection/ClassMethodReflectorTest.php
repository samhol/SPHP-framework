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
use Sphp\Reflection\MethodReflector;
use Sphp\Reflection\ClassReflector;
use Sphp\Reflection\ExtensionReflector;
use ReflectionMethod;
use Sphp\Reflection\Exceptions\ReflectionException;
use ReflectionException as CoreReflectionException;

/**
 * Class ClassMethodReflectorTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ClassMethodReflectorTest extends TestCase {

  public function validDataMap(): array {
    $arr = [];
    $arr[] = [\A\B\I::class, 'f1'];
    $arr[] = [\A\B\AC::class, 'sf1'];
    $arr[] = [\A\B\AC::class, 'ft1'];
    $arr[] = [\A\B\C::class, 'f2'];
    $arr[] = [\A\B\C::class, 'sf1'];
    $arr[] = [\A\B\C::class, 'sf2'];
    $arr[] = [\A\B\T3::class, 'ft3'];
    $arr[] = [\A\B\C::class, 'ft3'];
    $arr[] = [new \A\B\C, 'f1'];
    $arr[] = [new \A\B\C, 'sf2'];
    return $arr;
  }

  /**
   * @dataProvider validDataMap
   *
   * @param  string|object $class
   * @param  string $memberName
   * @return void
   */
  public function testConstructor($class, string $memberName): void {
    $classRef = new ClassReflector($class);
    $coreMemberRef = new ReflectionMethod($class, $memberName);
    $memberRef = new MethodReflector($class, $memberName);
    //var_dump(\Reflection::getModifierNames($memberRef->getModifiers()));
    $this->assertEquals($memberName, $memberRef->name);
    $this->assertEquals($classRef, $memberRef->getCurrentClass());
    $this->assertEquals($coreMemberRef->getDeclaringClass()->name, $memberRef->getDeclaringClass()->name);
    $this->assertSame((string) $coreMemberRef, (string) $memberRef);
  }

  public function invalidDataMap(): array {
    $arr = [];
    $arr[] = [\A\B\AC::class, 'o'];
    $arr[] = [\A\B\C::class, 'not'];
    $arr[] = [\A\B\C::class, '*'];
    return $arr;
  }

  /**
   * @dataProvider invalidDataMap
   *
   * @param  string|object $class
   * @param  string $memberName
   * @return void
   */
  public function testInvalidConstructorCalls($class, string $memberName): void {
    $this->expectException(ReflectionException::class);
    new MethodReflector($class, $memberName);
  }

  public function propertyDataMap(): array {
    $arr = [];
    $arr[] = [\A\B\I::class, 'f1'];
    $arr[] = [\A\B\AC::class, 'ft1'];
    $arr[] = [\A\B\C::class, 'f2'];
    $arr[] = [\A\B\T3::class, 'ft3'];
    $arr[] = [\A\B\C::class, 'ft3'];
    $arr[] = [new \A\B\C, 'f1'];
    return $arr;
  }

  /**
   * @dataProvider propertyDataMap
   *
   * @param  string|object $class
   * @param  string $memberName
   * @return void
   */
  public function testGetProperty($class, string $memberName): void {
    $corerRef = new ReflectionMethod($class, $memberName);
    $ref = new MethodReflector($class, $memberName);
    try {
      $corePrototype = $corerRef->getPrototype();
      $this->assertEquals($corePrototype->name, $ref->getPrototype()->name);
    } catch (CoreReflectionException $ex) {
      $this->expectException(ReflectionException::class);
      $this->expectExceptionMessage($ex->getMessage());
      $ref->getPrototype();
    }
  }

  public function extensionDataMap(): array {
    $arr = [];
    $arr[] = [\A\B\I::class, 'f1', null];
    $arr[] = [\A\B\T1::class, 'ft1', null];
    $arr[] = [new \A\B\C, 'f1', null];
    $arr[] = [ReflectionMethod::class, 'getExtension', 'Reflection'];
    return $arr;
  }

  /**
   * @dataProvider extensionDataMap
   *
   * @param  string|object  $function
   * @param  string $extension
   * @return void
   */
  public function testExtensionReflection($class, string $memberName, string $extension = null): void {
    $ref = new MethodReflector($class, $memberName);
    $this->assertSame($extension, $ref->getExtensionName());
    if ($ref->isInternal()) {
      $this->assertSame($extension, $ref->getExtensionName());
      $this->assertEquals(new ExtensionReflector($extension), $ref->getExtension());
    }
  }

}
