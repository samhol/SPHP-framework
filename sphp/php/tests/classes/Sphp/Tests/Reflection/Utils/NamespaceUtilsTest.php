<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Reflection\Utils;

use PHPUnit\Framework\TestCase;
use Sphp\Reflection\Utils\NamespaceUtils;

class NamespaceUtilsTest extends TestCase {

  /**
   * @return string[]
   */
  public function namespaceMaps(): array {
    $arr = [];
    $arr[] = ['', ['']];
    $arr[] = ['a', ['a']];
    $arr[] = ['a\b', ['a', 'a\b']];
    $arr[] = ['a\b\c', ['a', 'a\b', 'a\b\c']];
    return $arr;
  }

  /**
   * @dataProvider namespaceMaps
   *
   * @param  string $namespace
   * @param  string[] $expected
   * @return void
   */
  public function testExplodeNamespaceArray(string $namespace, array $expected): void {
    $this->assertEquals($expected, NamespaceUtils::explodeNamespaceArray($namespace), "Namespace explosion failed fo $namespace namespace");
  }

  public function subNamespaces(): iterable {
    yield ['', '', true];
    yield ['\\', '\\', true];
    yield ['', '\\', true];
    yield['\\', '', true];
    yield['a', 'a', true];
    yield ['a\\b', 'b\\a\\b', false];
    yield ['a\\b', 'a', false];
    yield ['a', 'a\\b', true];
    yield ['a\\b', 'a\\b', true];
    yield['a\\b', 'a\\b\\c', true];
    yield['a\\b', 'a\\c\\b', false];
    yield ['a\\b\\c', 'b', false];
    yield ['a\\b\\c', 'b\\c', false];
    yield ['ab', 'a\\b', false];
    yield ['a\\b', 'a', false];
  }

  /**
   * @dataProvider subNamespaces
   *
   * @param  object $ref
   * @return void
   */
  public function testIsSubNamespaceOf(string $parent, string $child, bool $isChildren): void {
    //echo "\nparent:\t $parent";
    //echo "\nchild:\t $child";
    $is = NamespaceUtils::isChildNamespaceOf($parent, $child);
    //echo "\n$expectedExtName ?= $extName\n";
    $this->assertSame($isChildren, $is, 'Namespace name cannot be found');
  }

  public function namespaceValidationData(): iterable {
    yield [' ', false];
    yield ['foo', true];
    yield ['', true];
    yield ['foo\\bar', true];
    yield ['2', false];
  }

  /**
   * @dataProvider namespaceValidationData
   *   
   * @param  string $namespace
   * @param  bool $valid
   * @return void
   */
  public function testIsValidNamespace(string $namespace, bool $valid): void {
    $this->assertSame($valid, NamespaceUtils::isValidNamespace($namespace));
  }

}
