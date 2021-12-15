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
use Sphp\Reflection\ExtensionReflector;
use ReflectionExtension;
use Sphp\Reflection\ClassReflector;
use Sphp\Reflection\FunctionReflector;
use Sphp\Reflection\ConstantReflector;

/**
 * Class ExtensionReflectorTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ExtensionReflectorTest extends TestCase {

  public function extNameMap(): array {
    $exts = [];
    $exts[] = ['Core'];
    $exts[] = ['spl'];
    $exts[] = ['Session'];
    return $exts;
  }

  public function testGetNameAndToString(): ExtensionReflector {
    $ref = new ExtensionReflector('Core');
    $phpRef = new ReflectionExtension('Core');
    $this->assertSame($phpRef->getName(), $ref->getName()); 
    $this->assertSame((string) $phpRef, (string) $ref);
    return $ref;
  }

  /**
   * @depends testGetNameAndToString
   * 
   * @param  ExtensionReflector $ref
   * @return ExtensionReflector 
   */
  public function testGetClasses(ExtensionReflector $ref): ExtensionReflector {
    $classNames = $ref->getClassNames();
    $classReflectors = $ref->getClasses();
    $this->assertCount(count($classNames), $classReflectors);
    foreach ($classReflectors as $class) {
      $this->assertInstanceof(ClassReflector::class, $class);
      $this->assertContains($class->name, $classNames);
    }
    return $ref;
  }

  /**
   * @depends testGetNameAndToString
   * 
   * @param  ExtensionReflector $ref
   * @return ExtensionReflector
   */
  public function testGetFunctions(ExtensionReflector $ref): ExtensionReflector {
    $coreRef = new \ReflectionExtension($ref->getName());
    $names = array_keys($coreRef->getFunctions());
    $classReflectors = $ref->getFunctions();
    $this->assertCount(count($names), $classReflectors);
    foreach ($classReflectors as $function) {
      $this->assertInstanceof(FunctionReflector::class, $function);
      $this->assertContains($function->name, $names);
    }
    return $ref;
  }

  /**
   * @depends testGetNameAndToString
   * 
   * @param  ExtensionReflector $ref
   * @return ExtensionReflector
   */
  public function testGetConstants(ExtensionReflector $ref): ExtensionReflector {
    $coreRef = new \ReflectionExtension($ref->getName());
    $names = array_keys($coreRef->getConstants());
    // echo $ref;
    $constantReflectors = $ref->getReflectionConstants();
    $this->assertCount(count($names), $constantReflectors);
    foreach ($constantReflectors as $constantReflector) {
      $this->assertInstanceof(ConstantReflector::class, $constantReflector);
      $this->assertContains($constantReflector->getName(), $names);
    }
    return $ref;
  }

}
