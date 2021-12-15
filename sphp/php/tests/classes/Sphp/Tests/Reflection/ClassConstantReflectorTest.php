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
use Sphp\Reflection\ClassConstantReflector;
use ReflectionClassConstant;
use Sphp\Reflection\ClassReflector;
use Sphp\Reflection\Exceptions\ReflectionException;

/**
 * Class ClassMethodReflectorTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ClassConstantReflectorTest extends TestCase {

  public function validDataMap(): array {
    $arr = [];
    $arr[] = [\A\B\I::class, 'C_I'];
    $arr[] = [\A\B\AC::class, 'C_AC'];
    $arr[] = [\A\B\C::class, 'C_C'];
    $arr[] = [\A\B\C::class, 'C_AC'];
    $arr[] = [\A\B\C::class, 'C_I'];
    $arr[] = [new \A\B\C, 'C_I'];
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
    $coreMemberRef = new ReflectionClassConstant($class, $memberName);
    $memberRef = new ClassConstantReflector($class, $memberName);
    $this->assertEquals($memberName, $memberRef->name);
    $this->assertEquals($classRef, $memberRef->getCurrentClass());
    $this->assertEquals($memberRef->class, $memberRef->getCurrentClass()->name);
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
    new ClassConstantReflector($class, $memberName);
  }

}
