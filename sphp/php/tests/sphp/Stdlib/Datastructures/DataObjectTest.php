<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\NullPointerException;

class DataObjectTest extends TestCase  {

  public function testArrayAccessAndIterator() {
    $mock = new DataObject();
    $items = array(
        'zero' => 0,
        'one' => FALSE,
        'two' => 'good job',
        'three' => new \stdClass(),
        'four' => array(),
    );
    $totalCount = count($items);
    foreach ($items as $key => $value) {
      $this->assertFalse(isset($mock[$key]));
      $mock[$key] = $value;
      $this->assertSame($items[$key], $mock[$key]);
      $this->assertTrue(isset($mock[$key]));
    }
    $this->assertCount($totalCount, $mock);

    // both cycles must pass
    for ($n = 0; $n < 2; ++$n) {
      $i = 0;
      reset($items);
      foreach ($mock as $key => $val) {
        if ($i >= $totalCount) {
          $this->fail("Iterator " . DataObject::class . " overflow!");
        }
        $this->assertEquals(key($items), $key);
        $this->assertEquals(current($items), $val, "Value at position '$key' is not what was expected!");
        next($items);
        ++$i;
      }
      $this->assertEquals($totalCount, $i);
    }
  }

  public function arrayData(): array {
    $data = [];
    $data[] = [[range('a', 'f'), 'array' => range(0, 3)]];
    return $data;
  }

  /**
   * @dataProvider arrayData
   * @param array $data
   */
  public function testFromArray(array $data) {
    $dataObject = DataObject::fromArray($data);
    foreach ($data as $key => $value) {
      $this->assertTrue(isset($dataObject[$key]));
      if (is_array($value)) {
        $this->assertEquals($value, $dataObject[$key]->toArray());
      } else {
        $this->assertEquals($value, $dataObject[$key]);
        $this->assertEquals($value, $dataObject->$key);
      }
    }
  }

  public function testArrayAccessAndMagicProperties(): void {
    $data = new DataObject();
    $this->assertFalse(isset($data[0]));
    $this->assertFalse(isset($data->{0}));
    $obj = new \stdClass();
    $data[0] = $obj;
    $this->assertTrue(isset($data[0]));
    $this->assertTrue(isset($data->{0}));
    $this->assertSame($obj, $data[0]);
    $this->assertSame($obj, $data->{'0'});
    unset($data[0]);
    $this->assertFalse(isset($data[0]));
  }
  

  public function testOffsetGetUndefinedProperties(): void {
    $data = new DataObject();
    $this->assertFalse(isset($data['foo']));
    $this->assertFalse(isset($data->{'foo'}));
    $this->expectException(NullPointerException::class);
    $foo = $data['foo'];
  }
  public function testPointingToUndefinedProperties(): void {
    $data = new DataObject();
    $this->assertFalse(isset($data['foo']));
    $this->assertFalse(isset($data->{'foo'}));
    $this->expectException(NullPointerException::class);
    $foo = $data->foo;
  }


}
