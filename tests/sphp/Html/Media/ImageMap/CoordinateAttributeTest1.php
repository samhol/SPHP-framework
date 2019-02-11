<?php

namespace Sphp\Tests\Html\Media\ImageMap;

use Sphp\Tests\Html\Attributes\AbstractAttributeObjectTest;
use Sphp\Html\Attributes\Attribute;
use Sphp\Html\Media\ImageMap\CoordinateAttribute;
use Sphp\Exceptions\InvalidArgumentException;

class CoordinateAttributeTest1 extends AbstractAttributeObjectTest {

  public function basicInvalidValues(): array {
    return [
        [new \stdClass],
    ];
  }

  public function basicValidValues(): array {
    return [
        [range(0, 3), '0,1,2,3'],
    ];
  }

  public function createAttr(string $name = 'coords'): Attribute {
    return new CoordinateAttribute($name);
  }

  public function confirmEmpty(CoordinateAttribute $attr) {
    $this->assertCount(0, $attr);
    $this->assertEquals([$attr->getName() => []], $attr->toArray());
    $this->assertEquals([], $attr->getCoordinates());
    $this->assertSame(false, $attr->getValue());
  }

  public function testEmptySetting() {
    $attr = $this->createAttr();
    $attr->setValue(null);
    $this->confirmEmpty($attr);
    $attr->setValue([]);
    $this->confirmEmpty($attr);
    $attr->setValue(false);
    $this->confirmEmpty($attr);
    $attr->setValue(true);
    $this->confirmEmpty($attr);
  }

  /**
   * @return array
   */
  public function rawSequences(): array {
    return [
        [range(0, 3), [0, 1, 2, 3]],
        [array_fill(0, 2, 5), [5, 5]],
        [' 10, 11, 4  ', [10, 11, 4]],
        [5, [5]],
        ['0', [0]]
    ];
  }

  /**
   * @dataProvider rawSequences
   */
  public function testSetting($value, array $expected) {
    $attr = new CoordinateAttribute('foo');
    $attr->setValue($value);

    //var_dump("$attr");
    //$expected = 'foo="' . implode(',', $value) . '"';
    $this->assertSame($expected, $attr->toArray()['foo']);
    //$this->assertEquals($this->attrs->getValue(), $expected);
  }

  public function testObjectSetting() {
    $attr = new CoordinateAttribute('foo');
    $this->expectException(InvalidArgumentException::class);
    $attr->setValue(new \stdClass);
  }

  public function testInvalidStringSetting() {
    $attr = new CoordinateAttribute('foo');
    $this->expectException(InvalidArgumentException::class);
    $attr->setValue('a,b,c');

    //var_dump("$attr");
    //$this->assertEquals($this->attrs->getValue(), $expected);
  }

  /**
   */
  public function testDemanding() {
    $attr = new CoordinateAttribute('foo');
    $attr->forceVisibility();
    $this->assertTrue($attr->isDemanded());
    $this->assertEquals("$attr", $attr->getName());
  }

}
