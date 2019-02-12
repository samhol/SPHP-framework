<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Datastructures\ArrayStack;

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
    $arr1 = Arrays::pointToKey($arr, 'key');
    //echo "\n" . $arr1['key'] . " :  [" . key($arr1) .']'. current($arr1) . "\n";
    $this->assertSame($arr['key'], current($arr));
    $this->assertSame(current($arr), current($arr1));
    $this->expectException(OutOfBoundsException::class);
    Arrays::pointToKey($arr, 'foo');
  }

  public function testPointToValue() {
    $arr = ['false' => false, 0, 1 => 1, 'key' => 'value', 'null' => null];
    $arr1 = Arrays::pointToValue($arr, false);
    $this->assertSame(false, current($arr));
    $this->assertSame('false', key($arr1));
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

  public function toArrayData(): array {
    return [
        [range('a', 'b')],
        [new \ArrayObject(range('a', 'b'))],
        [new ArrayStack(range('a', 'b'))]];
  }

  /**
   * @dataProvider toArrayData
   * @param mixed $mixed
   */
  public function testToArray($mixed) {
    $arrayed = Arrays::toArray($mixed);
    if ($mixed instanceof Datastructures\Arrayable) {
      $expected = $mixed->toArray();
    } else if ($mixed instanceof \Traversable) {
      $expected = iterator_to_array($mixed);
    } else {
      $expected = $mixed;
    }
    $this->assertSame($expected, $arrayed);
  }

  /**
   * @return array
   */
  public function invalidToArray(): array {
    return [
        ['string'],
        [0],
        [false],
        [null],
        [new \stdClass()]
    ];
  }

  /**
   * @dataProvider invalidToArray
   * @param mixed $mixed
   */
  public function testInvalidToArray($mixed) {
    $this->expectException(InvalidArgumentException::class);
    Arrays::toArray($mixed);
  }

  public function getValuesLikeData(): array {
    return [
        [[1, false, null, 'foo', 'bar', 'foobar', 'FOO', ['foo'], new \stdClass()], 'foo', 2],
        [[1, false, null, 'foo', '0', 'foo0', [0], 0], 0, 3]
    ];
  }

  /**
   * @dataProvider getValuesLikeData
   * 
   * @param array $haystack
   * @param scalar $needle
   * @param int $count
   */
  public function testGetValuesLike(array $haystack, $needle, int $count) {
    $result = Arrays::getValuesLike($haystack, $needle);
    $this->assertContainsOnly('scalar', $result);
    $this->assertCount($count, $result);
    foreach ($result as $value) {
      $this->assertTrue(strpos((string) $value, (string) $needle) !== false);
    }
  }

  public function testGetKeysLike() {
    $haystack = [0 => 'zero', '0' => 'zero', 'f00' => 'zero', 1, 2, 'f11' => 10];
    $result = Arrays::findKeysLike($haystack, 0);
    $this->assertContainsOnly('scalar', $result);
    $this->assertCount(2, $result);
    foreach ($result as $key => $value) {
      $this->assertTrue(strpos((string) $key, '0') !== false);
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
  public function testImplodeWithKeys(array $array, string $separator, string $glue, string $result) {
    $this->assertEquals($result, Arrays::implodeWithKeys($array, $separator, $glue));
  }

  /**
   * @return array
   */
  public function recursiveImplodeData(): array {
    return [
        [['F' => 'Foobar', 'o' => 'is', 'a' => 'bar of foo'], ' ', 'Foobar is bar of foo'],
        [['F' => new \Sphp\Html\PlainContainer('Foobar'), 'o' => ['is'], 'a' => 'bar of foo'], ' ', 'Foobar is bar of foo'],
    ];
  }

  /**
   * @dataProvider recursiveImplodeData
   * 
   * @param array $array
   * @param string $separator
   * @param string $result
   */
  public function testImplode(array $array, string $separator, string $result) {
    $this->assertEquals($result, Arrays::recursiveImplode($array, $separator));
  }

  /**
   * @param array $array
   * @param string $separator
   * @param string $result
   */
  public function testImplodeFail() {
    $this->expectException(InvalidArgumentException::class);
    Arrays::recursiveImplode(['F' => new \stdClass()]);
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

  /**
   */
  public function testSecureShuffle() {
    $array = range('a', 'o');
    // $array['p'] = 'p';
    Arrays::secureShuffle($array);
    //print_r($array);
    foreach (range('a', 'o') as $key => $value) {
      $this->assertTrue(in_array($value, $array));
      //$this->assertNotEquals($value, $array[$key]);
    }
    $this->assertFalse($array == range('a', 'o'));
  }

}
