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

  /**
   */
  public function testInvalidConstructorCall() {
    $this->expectException(InvalidAttributeException::class);
    new CoordinateAttribute('', []);
  }

  /**
   */
  public function testEmptySetting() {
    $this->attr->set(null);
    $this->assertCount(0, $this->attr);
    $this->assertSame(false, $this->attr->getValue());
  }

  /**
   * @return string[]
   */
  public function rawSequences(): array {
    return [
        [range(-5, 5)],
        [range(1, 3)],
    ];
  }

  /**
   * @dataProvider rawSequences
   */
  public function testSetting($value) {
    $attr = new CoordinateAttribute('foo');
    $attr->set($value);

    //var_dump("$attr");
    $expected = 'foo="' . implode(',', $value) . '"';
    $this->assertSame($expected, "$attr");
    //$this->assertEquals($this->attrs->getValue(), $expected);
  }

  /**
   */
  public function testInvalidSetting() {
    $attr = new CoordinateAttribute('foo', ['maxlength' => 4]);
    $this->expectException(InvalidAttributeException::class);
    $attr->set(range(1, 10));
    $attr->set(range('a', 'f'));

    //var_dump("$attr");
    //$this->assertEquals($this->attrs->getValue(), $expected);
  }

  /**
   */
  public function testDemanding() {
    $this->attr->demand();
    $this->assertTrue($this->attr->isDemanded());
    $this->assertEquals("$this->attr", $this->attr->getName());
  }

}
