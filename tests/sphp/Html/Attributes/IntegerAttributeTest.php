<?php

namespace Sphp\Tests\Html\Attributes;

use Sphp\Html\Attributes\Attribute;
use Sphp\Html\Attributes\IntegerAttribute;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

class IntegerAttributeTests extends AbstractAttributeObjectTest {

  /**
   * @var IntegerAttribute 
   */
  protected $attr;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->attr = $this->createAttr();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    $this->attr = null;
  }

  /**
   * @param string $name
   * @param int $min
   * @param int $max
   * @return Attribute
   */
  public function createAttr(string $name = 'attr', int $min = null, int $max = null): Attribute {
    return new IntegerAttribute($name, $min, $max);
  }

  public function basicValidValues(): array {
    return [
        ['0', 0],
        [0, 0],
        [true, 1],
        [false, null],
        ['1', 1],
        [null, null],
    ];
  }

  public function basicInvalidValues(): array {
    return [
        ['foo'],
        [''],
        [new \stdClass],
        [[]],
    ];
  }

  /**
   * @return scalar[]
   */
  public function settingData(): array {
    return [
        ['0', -1, 1],
        [0, -1, 1],
        [true, -1, 1],
        [false, -1, 1],
        [0, -1, 1],
        [-0, -1, 1],
        [0.0, -1, 1],
        [-1, -1, 1],
        [1, -1, 1],
        ['1', -1, 1],
        [null, -1, 1],
    ];
  }

  /**
   * @dataProvider settingData
   * @param type $value
   * @param int $min
   * @param int $max
   */
  public function testLimitSetting($value, int $min = null, int $max = null) {
    $attribute = new IntegerAttribute('data-number-attr', $min, $max);
    $attribute->setValue($value);
    $this->assertFalse($attribute->isDemanded());
    $this->assertEquals($attribute->isVisible(), ($attribute->getValue() !== null || $attribute->getValue() === false));
    $this->assertEquals($attribute->getValue(), $attribute->filterValue($value));
  }

  public function testInvalidLimitSetting() {
    $attribute = new IntegerAttribute('data-number-attr', 1, -1);
    $this->expectException(\Sphp\Exceptions\InvalidArgumentException::class);
    $attribute->setValue(1);
  }
  
  public function testDemanding() {
    $this->attr->forceVisibility();
    $this->assertTrue($this->attr->isDemanded());
    $this->attr->setValue(false);
    $this->attr->clear();
    $this->assertTrue($this->attr->isDemanded());
    $this->assertEquals("$this->attr", $this->attr->getName() . "");
  }

  /**
   * @return string[]
   */
  public function lockMethodData(): array {
    return [
        [-1],
        ['0'],
        [4]
    ];
  }

  /**
   * @dataProvider lockMethodData
   * @param  scalar $value
   */
  public function testProtectMethod($value) {
    $this->assertFalse($this->attr->isProtected());
    $this->attr->protectValue($value);
    $this->assertTrue($this->attr->isProtected());
    $this->assertEquals($this->attr->getValue(), $value);
    $this->expectException(ImmutableAttributeException::class);
    $this->attr->setValue($value + 1);
    $this->attr->clear();
  }

}
