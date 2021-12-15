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
use Sphp\Documentation\Linkers\PHP\URLGenerators\SamiUrls;

/**
 * Implementation of SamiTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SamiURLsTest extends AbstractPHPApiUrlGeneratorTest {

  public function createUrlGen(string $root = '', string $apiName = 'sami doc'): PHPApiUrlGenerator {
    return new SamiUrls($root, $apiName);
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
    $map[] = [\ReflectionClass::class, \ReflectionClass::class . '.html'];
    $map[] = [\Doctrine\ORM\Query\ResultSetMapping::class, 'Doctrine/ORM/Query/ResultSetMapping.html'];
    return $map;
  }

  public function classPropertyMap(): array {
    $map = [];
    $map[] = [\ReflectionClass::class, 'name', 'ReflectionClass.html#property_name'];
    $map[] = [\Doctrine\ORM\Query\ResultSetMapping::class, 'isMixed', 'Doctrine/ORM/Query/ResultSetMapping.html#property_isMixed'];
    return $map;
  }

  public function classMethodMap(): array {
    $map = [];
    $map[] = [\ReflectionClass::class, 'format', 'ReflectionClass.html#method_format'];
    $map[] = [\Doctrine\ORM\Query\ResultSetMapping::class, 'addEntityResult', 'Doctrine/ORM/Query/ResultSetMapping.html#method_addEntityResult'];
    $map[] = ['n\\s\\C', 'f', 'n/s/C.html#method_f'];
    return $map;
  }

  public function classConstantMap(): array {
    $map = [];
    $map[] = [\ReflectionClass ::class, 'IS_DEPRECATED', 'ReflectionClass.html'];
    $map[] = ['n\\s\\C', 'CONST', 'n/s/C.html'];
    return $map;
  }

  public function functionMap(): array {
    $map = [];
    $map[] = ['abs', 'search.html'];
    $map[] = ['n\\s\\f', 'search.html'];
    return $map;
  }

  public function constantMap(): array {
    $map = [];
    $map[] = ['C', 'search.html'];
    $map[] = ['\\C', 'search.html'];
    $map[] = ['A\\B\\C', 'search.html'];
    return $map;
  }

  public function namespaceMap(): array {
    $map = [];
    $map[] = ['', '.html'];
    $map[] = ['\\', '.html'];
    $map[] = ["\Sphp\Tests\Foo", 'Sphp/Tests/Foo.html'];
    $map[] = ['A\\B\\', 'A/B.html'];
    return $map;
  }

}
