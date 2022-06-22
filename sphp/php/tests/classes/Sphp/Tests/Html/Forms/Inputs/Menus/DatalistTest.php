<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Forms\Inputs\Menus;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Forms\Inputs\Menus\Datalist;
use Sphp\Html\Forms\Inputs\Menus\Option;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Class DatalistTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DatalistTest extends TestCase {

  /**
   * @return Datalist
   */
  public function testEmptyConstructor(): Datalist {
    $obj = new Datalist();
    $this->assertCount(0, $obj);
    return $obj;
  }

  public function constructorData(): iterable {
    yield [...range('a', 'c')];
    yield [...range(1, 4)];
    yield [
        new Option('foo', 'select foo'),
        'a',
        'b',
        2,
        1.3
    ];
  }

  /**
   * @dataProvider constructorData
   * @return void
   */
  public function testConstructorWithParams(string|int|float|Option ...$option): void {
    $obj = new Datalist(...$option);
    $this->assertCount(count($option), $obj);
    $obj1 = new Datalist();
    $obj1->appendData($option);
    $this->assertEquals($obj, $obj1);
  }

  public function insertionData(): iterable {
    yield [range('a', 'c')];
    yield [
        [
            Option::class => new Option('foo', 'select foo'),
            'a' => 'b'
        ]
    ];
  }

  /**
   * @dataProvider insertionData
   * 
   * @param array $options
   */
  public function testArrayAppending(array $options): void {
    $obj = new Datalist();
    $this->assertCount(0, $obj);
    $obj->appendData($options);
    $this->assertCount(count($options), $obj);
  }

  public function invelidOptionData(): iterable {
    yield [null];
    yield [true];
    yield [false];
    yield [new Datalist];
  }

  /**
   * @depends testEmptyConstructor
   * @dataProvider invelidOptionData
   * 
   * @param  mixed ... $data
   * @return void
   */
  public function testAppendInvaliddData(mixed ... $data): void {
    $obj = new Datalist();
    $this->expectException(InvalidArgumentException::class);
    $obj->appendData($data);
  }

}
