<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\PHP\URLGenerators;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\PHP\PHPApiUrlGenerator;

/**
 * Class AbstractPHPApiUrlGeneratorTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractPHPApiUrlGeneratorTest extends TestCase {

  /**
   * @return PHPApiUrlGenerator
   */
  abstract public function createUrlGen(): PHPApiUrlGenerator;

  /**
   * @return array<int, array<int, string>>
   */
  abstract public function namespaceMap(): array;

  /**
   * @dataProvider namespaceMap
   * 
   * @param string $namespace
   * @param string $path
   * @return void
   */
  public function testNamespaceURLs(string $namespace, string $path): void {
    $urlGen = $this->createUrlGen();
    $start = $urlGen->getRootUrl();
    $url = $urlGen->getNamespaceUrl($namespace);
    $this->assertSame($start . $path, $url);
  }

  /**
   * @return array<int, array<int, string>>
   */
  abstract public function classMap(): array;

  /**
   * @dataProvider classMap
   * 
   * @param string $className
   * @param string $path
   * @return void
   */
  public function testClassURLs(string $className, string $path): void {
    $urlGen = $this->createUrlGen();
    $start = $urlGen->getRootUrl();
    $url = $urlGen->getClassUrl($className);
    $this->assertSame($start . $path, $url);
  }

  /**
   * @return array<int, array<int, string>>
   */
  abstract public function classPropertyMap(): array;

  /**
   * @dataProvider classPropertyMap
   * 
   * @param  string $className
   * @param  string $property
   * @param  string $path
   * @return void
   */
  public function testClassPropertyURLs(string $className, string $property, string $path): void {
    $urlGen = $this->createUrlGen();
    $start = $urlGen->getRootUrl();
    $url = $urlGen->getClassPropertyUrl($className, $property);
    $this->assertSame($start . $path, $url);
  }

  /**
   * @return array<int, array<int, string>>
   */
  abstract public function classMethodMap(): array;

  /**
   * @dataProvider classMethodMap
   * 
   * @param  string $className
   * @param  string $method
   * @param  string $path
   * @return void
   */
  public function testClassMethodURLs(string $className, string $method, string $path): void {
    $urlGen = $this->createUrlGen();
    $start = $urlGen->getRootUrl();
    $url = $urlGen->getClassMethodUrl($className, $method);
    $this->assertSame($start . $path, $url);
  }

  /**
   * @return array<int, array<int, string>>
   */
  abstract public function classConstantMap(): array;

  /**
   * @dataProvider classConstantMap
   * 
   * @param  string $className
   * @param  string $constant
   * @param  string $path
   * @return void
   */
  public function testClassConstantURLs(string $className, string $constant, string $path): void {
    $urlGen = $this->createUrlGen();
    $start = $urlGen->getRootUrl();
    $url = $urlGen->getClassConstantUrl($className, $constant);
    $this->assertSame($start . $path, $url);
  }

  /**
   * @return array<int, array<int, string>>
   */
  abstract public function functionMap(): array;

  /**
   * @dataProvider functionMap
   * 
   * @param  string $function
   * @param  string $path
   * @return void
   */
  public function testFunctionURLs(string $function, string $path): void {
    $urlGen = $this->createUrlGen();
    $start = $urlGen->getRootUrl();
    $url = $urlGen->getFunctionUrl($function);
    $this->assertSame($start . $path, $url);
  }

  /**
   * @return array<int, array<int, string>>
   */
  abstract public function constantMap(): array;

  /**
   * @dataProvider constantMap
   * 
   * @param  string $constant
   * @param  string $path
   * @return void
   */
  public function testConstantUrls(string $constant, string $path): void {
    $urlGen = $this->createUrlGen();
    $start = $urlGen->getRootUrl();
    $url = $urlGen->getConstantUrl($constant);
    $this->assertSame($start . $path, $url);
  }

}
