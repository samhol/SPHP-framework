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
use Sphp\Reflection\FunctionReflector;
use Sphp\Reflection\ExtensionReflector;
use ReflectionFunction;

/**
 * Class ClassMethodReflectorTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FunctionReflectorTest extends TestCase {

  /**
   * @return string[]
   */
  public function validFunctionMap(): array {
    $fun1 = function(bool $foo = true) {
      
    };
    $rev = function(bool $bar = true)use ($fun1) {
      return !$fun1($bar);
    };
    $arr = [];
    $arr[] = [$fun1];
    $arr[] = [$rev];
    $arr[] = ['f'];
    $arr[] = ['f1'];
    $arr[] = ['array_key_exists', 'standard'];
    $arr[] = ['filter_has_var', 'filter'];
    return $arr;
  }

  /**
   * @dataProvider validFunctionMap
   *
   * @param  string|object $function
   * @return void
   */
  public function testConstructor($function): void {
    $ref = new FunctionReflector($function);
    $phpRef = new ReflectionFunction($function);
    $this->assertEquals($phpRef->getName(), $ref->getName());
    $this->assertSame((string) $phpRef, (string) $ref);
  }

  /**
   * @dataProvider validFunctionMap
   *
   * @param  string|object $function
   * @return void
   */
  public function testClosureScope($function): void {
    $ref = new FunctionReflector($function);
    $phpRef = new ReflectionFunction($function);
    if ($ref->getClosureScopeClass() !== null) {
      $this->assertEquals($phpRef->getClosureScopeClass()->name, $ref->getClosureScopeClass()->name);
    } else {
      $this->assertNull($ref->getClosureScopeClass());
    }
  }

  /**
   * @dataProvider validFunctionMap
   *
   * @param  string|object  $function
   * @param  string $extension
   * @return void
   */
  public function testExtensionReflection($function, string $extension = null): void {
    $ref = new FunctionReflector($function);
    $this->assertSame($extension, $ref->getExtensionName());
    if ($ref->isInternal()) {
      $this->assertSame($extension, $ref->getExtensionName());
      $this->assertEquals(new ExtensionReflector($extension), $ref->getExtension());
    }
  }

  /**
   * @dataProvider validFunctionMap
   *
   * @param  string|object  $function
   * @param  string $extension
   * @return void
   */
  public function testParameterTypeAndReturnTypeReflection($function): void {
    $ref = new FunctionReflector($function);
    $phpRef = new \ReflectionFunction($function);
    if ($ref->getNumberOfParameters() > 0) {
      $parameters = $ref->getParameters();
      $this->assertCount($ref->getNumberOfParameters(), $parameters);
      foreach ($parameters as $name => $parameter) {
        $this->assertInstanceof(\ReflectionParameter::class, $parameter);
      }
    }
  }

}
