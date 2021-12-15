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
use Sphp\Reflection\PropertyReflector;
use Sphp\Reflection\ClassReflector;
use Sphp\Reflection\Exceptions\ReflectionException;
use ReflectionProperty;

/**
 * Class ClassMethodReflectorTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ClassPropertyReflectorTest extends TestCase {

  public function validPropertyDataMap(): array {
    $arr = [];
    $arr[] = [\A\B\AC::class, 'p1'];
    $arr[] = [\A\B\C::class, 'p2'];
    $arr[] = [\A\B\C::class, 'sp1'];
    $arr[] = [\A\B\T3::class, 'sp1'];
    $arr[] = [\A\B\C::class, 'sp2'];
    $arr[] = [new \A\B\C, 'p1'];
    return $arr;
  }

  /**
   * @dataProvider validPropertyDataMap
   *
   * @param  string|object $class
   * @param  string $memberName
   * @return void
   */
  public function testConstructor($class, string $memberName): void {
    $classRef = new ClassReflector($class);
    $coreMemberRef = new ReflectionProperty($class, $memberName);
    $memberRef = new PropertyReflector($class, $memberName);
    $this->assertEquals($memberName, $memberRef->name);
    $this->assertEquals($classRef, $memberRef->getCurrentClass());
    $this->assertEquals($coreMemberRef->class, $memberRef->getDeclaringClass()->name);
    $this->assertSame((string) $coreMemberRef, (string) $memberRef);
  }

  public function invalidProperytDataMap(): array {
    $arr = [];
    $arr[] = [\A\B\AC::class, 'p2'];
    $arr[] = [\A\B\C::class, 'not'];
    $arr[] = [\A\B\C::class, '*'];
    return $arr;
  }

  /**
   * @dataProvider invalidProperytDataMap
   *
   * @param  string|object $class
   * @param  string $memberName
   * @return void
   */
  public function testInvalidConstructorCalls($class, string $memberName): void {
    $this->expectException(ReflectionException::class);
    new PropertyReflector($class, $memberName);
  }

}
