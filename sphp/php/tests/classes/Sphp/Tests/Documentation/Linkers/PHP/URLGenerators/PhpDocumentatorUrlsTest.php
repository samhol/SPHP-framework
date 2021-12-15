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

use Sphp\Documentation\Linkers\PHP\PHPApiUrlGenerator;
use Sphp\Documentation\Linkers\PHP\URLGenerators\PhpDocUrls;

/**
 * Class PhpDocumentatorUrlsTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PhpDocumentatorUrlsTest extends AbstractPHPApiUrlGeneratorTest {
 
  public function createUrlGen(string $root = '', string $name = 'PhpDoc'): PHPApiUrlGenerator {
    return new PhpDocUrls($root, $name);
  }
  /**
   * @return array<int, array<int, string>>
   */
  public function constructorParamMap(): array {
    $map = [];
    $map[] = ['https://www.api.doc/', 'api.doc'];
    $map[] = ['', ''];
    $map[] = ['/', 'foo'];
    return $map;
  }

  /**
   * @dataProvider constructorParamMap
   * 
   * @param string $root
   * @param string $apiName
   * @return void
   */
  public function testConstructor(string $root, string $apiName) {
    $urlGen = $this->createUrlGen($root, $apiName);
    $this->assertSame($root, $urlGen->getRootUrl());
    $this->assertSame($apiName, $urlGen->getApiname());
  }

  public function namespaceMap(): array {
    $map = [];
    $map[] = ['', 'namespaces/default.html'];
    $map[] = ['\\', 'namespaces/default.html'];
    $map[] = ["\Sphp\Tests\Foo", 'namespaces/sphp-tests-foo.html'];
    $map[] = ['A\\B\\', 'namespaces/a-b.html'];
    return $map;
  }

  public function classMap(): array {
    $map = [];
    $map[] = [\ReflectionClass::class, 'classes/ReflectionClass.html'];
    $map[] = [\Sphp\Tests\Foo\Instantiable::class, 'classes/Sphp-Tests-Foo-Instantiable.html'];
    $map[] = ['\\A\\B\\C', 'classes/A-B-C.html'];
    return $map;
  }

  public function classPropertyMap(): array {
    $map = [];
    $map[] = [\ReflectionClass::class, 'name', 'classes/ReflectionClass.html#property_name'];
    $map[] = [\Sphp\Tests\Foo\Instantiable::class, 'lowercase', 'classes/Sphp-Tests-Foo-Instantiable.html#property_lowercase'];
    $map[] = ['A\\B\\C', 'p', 'classes/A-B-C.html#property_p'];
    return $map;
  }

  public function classMethodMap(): array {
    $map = [];
    $map[] = [\ReflectionClass::class, 'getMethod', 'classes/ReflectionClass.html#method_getMethod'];
    $map[] = [\Sphp\Tests\Foo\Instantiable::class, 'protectedFunction', 'classes/Sphp-Tests-Foo-AbstractClass.html#method_protectedFunction'];
    $map[] = ['A\\B\\C', 'm', 'classes/A-B-C.html#method_m'];
    return $map;
  }

  public function classConstantMap(): array {
    $map = [];
    $map[] = [\ReflectionClass ::class, 'IS_FINAL', 'classes/ReflectionClass.html#constant_IS_FINAL'];
    $map[] = [\Sphp\Tests\Foo\Instantiable::class, 'PRIVATE_CONST', 'classes/Sphp-Tests-Foo-Instantiable.html#constant_PRIVATE_CONST'];
    $map[] = [\Sphp\Tests\Foo\Instantiable::class, 'PUBLIC_CONST', 'classes/Sphp-Tests-Foo-AnInterface.html#constant_PUBLIC_CONST'];
    $map[] = ['A\\B\\C', 'D', 'classes/A-B-C.html#constant_D'];
    return $map;
  }

  public function functionMap(): array {
    $map = [];
    $map[] = ['abs', 'namespaces/default.html#function_abs'];
    $map[] = ['n\\s\\f', 'namespaces/n-s.html#function_f'];
    $map[] = ['foobar', 'namespaces/default.html#function_foobar'];
    return $map;
  }

  public function constantMap(): array {
    $map = [];
    $map[] = ['C', 'namespaces/default.html#constant_C'];
    $map[] = ['\\C', 'namespaces/default.html#constant_C'];
    $map[] = ['A\\B\\C', 'namespaces/a-b.html#constant_C'];
    return $map;
  }

}
