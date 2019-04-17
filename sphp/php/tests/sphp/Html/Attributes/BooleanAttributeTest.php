<?php

namespace Sphp\Tests\Html\Attributes;

use Sphp\Html\Attributes\Attribute;
use Sphp\Html\Attributes\BooleanAttribute;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

class BooleanAttributeTest extends AbstractAttributeObjectTest {

  /**
   * @var BooleanAttribute
   */
  protected $attribute;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->attribute = $this->createAttr();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    $this->attribute = null;
  }

  /**
   * @return Attribute
   */
  public function createAttr(string $name = 'data-boolean-attr'): Attribute {
    return new BooleanAttribute($name);
  }

  public function basicInvalidValues(): array {
    return [
        [new \stdClass()],
    ];
  }

  public function basicValidValues(): array {
    return [
        ['yes', true],
        ['on', true],
        [true, true],
        ['true', true],
        [1, true],
        ['1', true],
        ['off', false],
        ['false', false],
        [false, false],
        [0, false],
        ['0', false],
    ];
  }

  /**
   * @return scalar[]
   */
  public function trueValues(): array {
    return [
        ['yes'],
        ['on'],
        [true],
        ['true'],
        [1],
        ['1'],
    ];
  }

  /**
   * @dataProvider trueValues
   * @param scalar $value
   */
  public function testTrueSetting($value) {
    $this->attribute->setValue($value);
    $this->assertFalse($this->attribute->isProtected());
    $this->assertFalse($this->attribute->isProtected($value));
    $this->assertFalse($this->attribute->isDemanded());
    $this->assertTrue($this->attribute->isVisible());
    $this->assertEquals($this->attribute->getValue(), true);
    $this->assertSame("$this->attribute", $this->attribute->getName());
  }

  /**
   * @return scalar[]
   */
  public function falseValues(): array {
    return [
        //['off'],
        //['false'],
        [false],
        [0],
        ['0'],
    ];
  }

  /**
   * @dataProvider falseValues
   * @param scalar $value
   */
  public function testFalseSetting($value) {
    $attr = $this->createAttr();
    $attr->setValue($value);
    $this->assertFalse($attr->isProtected());
    $this->assertFalse($attr->isProtected($value));
    $this->assertFalse($attr->isDemanded());
    $this->assertFalse($attr->isVisible());
    $this->assertEquals($attr->getValue(), false);
    $this->assertSame("$attr", '');
  }

  /**
   */
  public function testDemanding() {
    $attr = $this->createAttr();
    $this->assertFalse($attr->isDemanded());
    $this->assertFalse($attr->isProtected());
    $attr->forceVisibility();
    $this->assertTrue($attr->isDemanded());
    $this->assertEquals($attr->getName(), "$attr");
    $this->expectException(ImmutableAttributeException::class);
    $attr->setValue('false');
  }

  /**
   * @return string[]
   */
  public function lockMethodData(): array {
    return [
        [true],
        ['a'],
        [' ä ']
    ];
  }

  /**
   * @dataProvider trueValues
   * @param  scalar $value
   */
  public function testLockTrueValues($value) {
    $attr = $this->createAttr();
    $this->assertFalse($attr->isProtected());
    $attr->protectValue($value);
    $this->assertTrue($attr->isProtected());
    $this->assertEquals($attr->getValue(), true);
    $this->assertSame("$attr", $attr->getName());
    $this->expectException(ImmutableAttributeException::class);
    $attr->setValue(false);
  }

  /**
   * @dataProvider falseValues
   * @param  scalar $value
   */
  public function testLockFalseValues($value) {
    $attr = $this->createAttr();
    $this->assertFalse($attr->isProtected());
    $attr->protectValue($value);
    $this->assertTrue($attr->isProtected());
    $this->assertEquals($attr->getValue(), false);
    $this->expectException(ImmutableAttributeException::class);
    $attr->setValue(true);
  }

}
