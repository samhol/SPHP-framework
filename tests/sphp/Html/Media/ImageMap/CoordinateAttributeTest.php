<?php

namespace Sphp\Html\Media\ImageMap;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Html\Attributes\Attribute;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

class CoordinateAttributeTest extends TestCase {

  /**
   * @var CoordinateAttribute 
   */
  protected $attr;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->attr = $this->createAttr();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->attr = null;
  }

  /**
   * 
   * @param string $name
   * @return Attribute
   */
  public function createAttr(string $name = 'class'): Attribute {
    return new CoordinateAttribute($name);
  }

  public function confirmEmpty(CoordinateAttribute $attr) {
    $this->assertCount(0, $attr);
    $this->assertEquals([$attr->getName() => []], $attr->toArray());
    $this->assertEquals([], $attr->getCoordinates());
    $this->assertSame(false, $attr->getValue());
  }

  /**
   */
  public function testInvalidConstructorCall() {
    $this->expectException(InvalidAttributeException::class);
    new CoordinateAttribute('', []);
  }

  /**
   */
  public function testConstructorCall(): CoordinateAttribute {
    $attr = new CoordinateAttribute('coords');
    $this->assertEquals('coords', $attr->getName());
    $this->confirmEmpty($attr);
    return $attr;
  }

  /**
   * @depends testConstructorCall
   * @param   CoordinateAttribute $attr
   */
  public function testEmptySetting(CoordinateAttribute $attr) {
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
    $this->assertSame($expected, $attr->getCoordinates());
    //$this->assertEquals($this->attrs->getValue(), $expected);
  }

  /**
   * @expectedException  \Sphp\Exceptions\InvalidArgumentException
   */
  public function testObjectSetting() {
    $attr = new CoordinateAttribute('foo');
    $attr->setValue(new \stdClass);

    //var_dump("$attr");
    //$this->assertEquals($this->attrs->getValue(), $expected);
  }
  /**
   * @expectedException  \Sphp\Exceptions\InvalidArgumentException
   */
  public function testInvalidStringSetting() {
    $attr = new CoordinateAttribute('foo');
    $attr->setValue('a,b,c');

    //var_dump("$attr");
    //$this->assertEquals($this->attrs->getValue(), $expected);
  }

  /**
   */
  public function testDemanding() {
    $this->attr->forceVisibility();
    $this->assertTrue($this->attr->isDemanded());
    $this->assertEquals("$this->attr", $this->attr->getName());
  }

}
