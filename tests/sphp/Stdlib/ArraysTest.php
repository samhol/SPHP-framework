<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib;

use Sphp\Exceptions\OutOfBoundsException;

class ArraysTest extends \PHPUnit\Framework\TestCase {

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

  /**
   *
   * @covers \Sphp\Tools\Arrays::diff
   * @dataProvider diffData
   * @param array $arr1
   * @param array $arr2
   * @param array $diff
   */
  public function atestDiff(array $arr1, array $arr2, array $diff) {
    //print_r(Arrays::diff($arr1, $arr2));
    $this->assertEquals(Arrays::diff($arr1, $arr2), $diff);
  }

  public function testArrayFilterRecursive() {
    $array = [
        'a' => 'a',
        'b' => null,
        'c' => [
            'a' => null,
            'b' => 'b',
        ],
        'd' => [
            'a' => null
        ]
    ];
    $result = Arrays::filterRecursive($array);
    $expected = [
        'a' => 'a',
        'c' => [
            'b' => 'b',
        ],
    ];
    $this->assertSame($expected, $result);
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
            [], 0
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
        [
            ['a' => 'a', 1, 3 => 2, 4 => 'f'], 0
        ],
        [
            ['a' => 'a', 1, 30 => 2, 4 => 'f'], 2
        ],
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
  }

  /**
   */
  public function testPointToKey() {
    $arr = ['a' => 'b', 44, 3 => 2, 'key' => 'value', 'fwe' => 's', 1];
    $arr1 = Arrays::pointToKey($arr, 'key');
    //echo "\n" . $arr1['key'] . " :  [" . key($arr1) .']'. current($arr1) . "\n";
    $this->assertSame($arr['key'], current($arr));
    $this->assertSame(current($arr), current($arr1));
    $this->expectException(OutOfBoundsException::class);
    Arrays::pointToKey($arr, 'foo');
  }

  /**
    public function testPointToValue() {
    $obj = new \stdClass();
    $arr = ['a' => 'b', 44, 3 => 2, 'obj' => $obj, 1];
    $arr1 = Arrays::pointToValue($arr, $obj);
    //echo "\n" . $arr1['key'] . " :  [" . key($arr1) .']'. current($arr1) . "\n";
    $this->assertSame($arr['obj'], current($arr));
    $this->assertSame(current($arr), current($arr1));
    $this->expectException(OutOfBoundsException::class);
    Arrays::pointToKey($arr, 'obj');
    }
   */
  public function toArrayData(): array {
    $data[] = range('a', 'b');
    $data[] = new \ArrayObject(range('a', 'b'));
    return [$data];
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
    $this->expectException(\Sphp\Exceptions\InvalidArgumentException::class);
    Arrays::toArray(new \stdClass());
  }

}
