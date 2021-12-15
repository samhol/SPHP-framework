<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\PHP\URLGenerators;

use Sphp\Documentation\Linkers\PHP\PHPApiUrlGenerator;
use Sphp\Documentation\Linkers\PHP\URLGenerators\ApiGenUrls;

/**
 * Implementation of SamiTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ApiGenURLsTest extends AbstractPHPApiUrlGeneratorTest {

  public function createUrlGen(string $root = '', string $apiname = 'ApiGen'): PHPApiUrlGenerator {
    return new ApiGenUrls($root, $apiname);
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

  public function classMap(): array {
    $map = [];
    $map[] = [\ReflectionClass::class, 'class-ReflectionClass.html'];
    $map[] = ['n\\s\\C', 'class-n.s.C.html'];
    return $map;
  }

  public function classPropertyMap(): array {
    $map = [];
    $map[] = [\ReflectionClass::class, 'name', 'class-ReflectionClass.html#$name'];
    $map[] = ['n\\s\\C', 'p', 'class-n.s.C.html#$p'];
    return $map;
  }

  public function classMethodMap(): array {
    $map = [];
    $map[] = [\ReflectionClass::class, 'getName', 'class-ReflectionClass.html#_getName'];
    $map[] = ['n\\s\\C', 'f', 'class-n.s.C.html#_f'];
    return $map;
  }

  public function classConstantMap(): array {
    $map = [];
    $map[] = [\ReflectionClass ::class, 'IS_DEPRECATED', 'class-ReflectionClass.html#IS_DEPRECATED'];
    $map[] = ['n\\s\\C', 'CONST', 'class-n.s.C.html#CONST'];
    return $map;
  }

  public function functionMap(): array {
    $map = [];
    $map[] = ['abs', 'function-abs.html'];
    $map[] = ['n\\s\\f', 'function-n.s.f.html'];
    return $map;
  }

  public function constantMap(): array {
    $map = [];
    $map[] = ['PHP_INT_MAX', 'constant-PHP_INT_MAX.html'];
    $map[] = ['n\\s\\C', 'constant-n.s.C.html'];
    return $map;
  }

  public function namespaceMap(): array {
    $map = [];
    $map[] = ['', 'namespace-none.html'];
    $map[] = ['\\', 'namespace-none.html'];
    $map[] = ["\Sphp\Tests\Foo", 'namespace-Sphp.Tests.Foo.html'];
    $map[] = ['A\\B\\', 'namespace-A.B.html'];
    return $map;
  }

}
