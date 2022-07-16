<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib;

use PHPUnit\Framework\TestCase;
use Sphp\Stdlib\Arrays;
use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\InvalidArgumentException; 

class ArraysTest extends TestCase {

  public function diffData() {
    return [
        [
            ["a" => "a", [1, 3 => 2], 4 => "f"],
            ["a" => "a", [1, 3 => 2], 4 => "f"],
            []
        ],
        [
            ["a" => new \stdClass],
            ["b" => new \stdClass],
            ["a" => new \stdClass]
        ],
        [
            [],
            [],
            []
        ],
        [
            [null],
            [],
            [null]
        ],
        [
            [1],
            [1 => 1],
            [0 => 1, 1 => 1]
        ],
    ];
  }

  public function testPointToKey() {
    $arr = ['a' => 'b', 44, 3 => 2, 'key' => 'value', 'fwe' => 's', 1];
    Arrays::pointToKey($arr, 'key');
    //echo "\n" . $arr1['key'] . " :  [" . key($arr1) .']'. current($arr1) . "\n";
    $this->assertSame($arr['key'], current($arr));
    $this->expectException(OutOfBoundsException::class);
    Arrays::pointToKey($arr, 'foo');
  }

  public function testPointToValue() {
    $arr = ['false' => false, 0, 1 => 1, 'key' => 'value', 'null' => null];
    Arrays::pointToValue($arr, false);
    $this->assertSame(false, current($arr));
    Arrays::pointToValue($arr, null);
    $this->assertSame(null, current($arr));
    $this->assertSame('null', key($arr));
    $this->expectException(OutOfBoundsException::class);
    Arrays::pointToValue($arr, 'foobar');
  }

  public function testInArray() {
    $arr = ['false' => false, 0, 1 => 1, 'key' => 'value', 'null' => null, 'array' => ['foo' => [1]]];
    $this->assertTrue(Arrays::inArray('value', $arr));
    $this->assertTrue(Arrays::inArray([1], $arr));
  }

  public function filterTestData(): array {
    return [[
    ['a' => 'a',
        'b' => null,
        'c' => ['a' => null, 'b' => 'b'],
        [null]],
    ['a' => 'a', 'c' => ['b' => 'b']
    ]]
    ];
  }

  /**
   * @dataProvider filterTestData
   * 
   * @param array $arr
   * @param array $arr1
   */
  public function testArrayFilterRecursive(array $arr, array $arr1) {
    $this->assertEquals($arr1, Arrays::filterRecursive($arr));
  }

  public function callBackFilteringData() {
    $input1 = [
        'a' => false,
        'b' => null,
        'c' => [
            'a' => null,
            'b' => 0,
        ],
        'd' => [
            'a' => null
        ]
    ];
    $callable = function ($value) {
      if (is_array($value)) {
        return !empty($value);
      }
      return ($value !== null);
    };
    $exp1 = [
        'a' => false,
        'c' => [
            'b' => 0,
        ],
    ];
    $obj = new \stdClass;
    return [
        [$input1, $callable, $exp1],
        [[], $callable, []],
        [[0], $callable, [0]],
        [[false], $callable, [false]],
        [[$obj], $callable, [$obj]]
    ];
  }

  /**
   * 
   * @dataProvider callBackFilteringData
   * @param array $input
   * @param callable $callBack
   * @param array $expected
   */
  public function testArrayFilterWithCustomCallback(array $input, callable $callBack, array $expected) {
    $result = Arrays::filterRecursive($input, $callBack);
    $this->assertSame($expected, $result);
  }

  public function isSeq(): array {
    return [
        [
            []
        ],
        [
            range(1, 5)
        ],
        [
            [2 => 'a', 3 => 'b', 4 => 'c']
        ],
    ];
  }

  /**
   * 
   * @dataProvider isSeq
   * @param array $input
   * @param callable $callBack
   * @param array $expected
   */
  public function testIsSequential(array $input) {
    $this->assertTrue(Arrays::isSequential($input));
  }

  public function nonSequentialData(): array {
    return [
        [['a' => 'a', 1, 3 => 2, 4 => 'f'], 0],
        [['a' => 'a', 1, 30 => 2, 4 => 'f'], 2],
    ];
  }

  /**
   * @dataProvider nonSequentialData
   * @param array $input
   * @param int $base
   */
  public function testSetSequential(array $input, int $base) {
    $result = Arrays::setSequential($input, $base);
    $this->assertTrue(Arrays::isSequential($result));
    $this->assertSame($result[$base], reset($result));
  }

  public function isMultidimensionalData(): iterable {
    yield [[[]], true];
    yield [[null, []], true];
    yield [[1, 2], false];
  }

  /**
   * @dataProvider isMultidimensionalData
   * 
   * @param  array $array
   * @param  bool $isMulti
   * @return void
   */
  public function testIsMultidimensional(array $array, bool $isMulti): void {
    $this->assertSame($isMulti, Arrays::isMultidimensional($array));
  }

  public function getValuesLikeData(): array {
    return [
        [[1, false, null, 'foo', 'bar', 'foobar', 'FOO', ['foo'], new \stdClass()], 'foo', 2],
        [[1, false, null, 'foo', '0', 'foo0', [0], 0], '0', 3]
    ];
  }

  /**
   * @dataProvider getValuesLikeData
   * 
   * @param  array $haystack
   * @param  scalar $needle
   * @param  int $count
   * @return void
   */
  public function testGetValuesLike(array $haystack, string $needle, int $count): void {
    $result = Arrays::getValuesLike($haystack, $needle);
    $this->assertContainsOnly('scalar', $result);
    $this->assertCount($count, $result);
    foreach ($result as $value) {
      $this->assertTrue(strpos((string) $value, (string) $needle) !== false);
    }
  }

  /** 
   * @return void
   */
  public function testGetKeysLike(): void {
    $haystack = [' 1 ' => 1, 1 => 1, 10 => 1, ' 1.2 ' => 1, 2 => 2, '2' => 2];
    $result = Arrays::findKeysLike($haystack, 1);
    $this->assertCount(4, $result);
    foreach ($result as $key => $value) {
      $this->assertArrayHasKey($key, $haystack);
      $this->assertSame($value, $haystack[$key]);
    }
  }

  /**
   * @return array
   */
  public function implodeWithKeysData(): array {
    return [
        [['F' => 'o', 'o' => 'b', 'a' => 'r'], '', '', 'Foobar'],
        [['Fo' => 'o', 'b' => 'ar'], '-', '', 'Foo-bar'],
        [range('a', 'c'), ',', '=>', '0=>a,1=>b,2=>c'],
    ];
  }

  /**
   * @dataProvider implodeWithKeysData
   * 
   * @param array $array
   * @param string $separator
   * @param string $glue
   * @param string $result
   */
  public function testImplodeWithKeys(array $array, string $separator, string $glue, string $result): void {
    $this->assertEquals($result, Arrays::implodeWithKeys($array, $separator, $glue));
  }

  /**
   * @return array
   */
  public function recursiveImplodeData(): array {
    return [
        [['F' => 'Foobar', 'o' => 'is', 'a' => 'bar of foo'], ' ', 'Foobar is bar of foo'],
        [['F' => 'Foobar', 'o' => ['is'], 'a' => 'bar of foo'], ' ', 'Foobar is bar of foo'],
    ];
  }

  /**
   * @dataProvider recursiveImplodeData
   * 
   * @param array $array
   * @param string $separator
   * @param string $result
   */
  public function testImplode(array $array, string $separator, string $result): void {
    $this->assertEquals($result, Arrays::recursiveImplode($array, $separator));
  }

  public function testImplodeFail(): void {
    $this->expectException(InvalidArgumentException::class);
    Arrays::recursiveImplode(['class' => new \stdClass()]);
  }

  /**
   * @return array
   */
  public function flattenData(): array {
    $obj1 = new \stdClass();
    $obj2 = new \stdClass();
    return [
        [[$obj1, [[false, null], [$obj2, [[1]]]]], [$obj1, false, null, $obj2, 1]],
    ];
  }

  /**
   * @dataProvider flattenData
   * 
   * @param array $array
   * @param string $result
   */
  public function testFlatten(array $array, array $result) {
    $this->assertEquals($result, Arrays::flatten($array));
  }

  /**
   * @return array
   */
  public function copyData(): array {
    $obj1 = new \stdClass();
    $obj2 = new \stdClass();
    return [
        [[$obj1, [false, null], [$obj2, [[1]]]]],
        [['obj' => $obj2], ['ref'] => &$obj2],
    ];
  }

  /**
   * @dataProvider flattenData
   * 
   * @param array $array
   */
  public function testCopy(array $array) {
    $copy = Arrays::copy($array);
    $this->assertEquals($array, $copy);
    $this->assertFalse($array === $copy);
  }

  public function indexedArrays(): array {
    return [
        [shuffle(range(1, 5))],
        [range(1, 5)],
        [0 => [0, 1]],
        [],
    ];
  }

  /**
   * @dataProvider flattenData
   * 
   * @param array $array
   */
  public function testIsIndexed(array $array) {
    $this->assertTrue(Arrays::isIndexed($array));
    $array['foo'] = 'bar';
    $this->assertFalse(Arrays::isIndexed($array));
  }

}
