<?php

namespace Sphp\Html\Attributes;

use Sphp\Tests\Html\Attributes\AbstractAttributeObjectTest;
use Sphp\Html\Attributes\Attribute;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Exceptions\InvalidArgumentException;

class AttributeTest extends AbstractAttributeObjectTest {

  /**
   * @return Attribute
   */
  public function createAttr(string $name = 'data-attr'): Attribute {
    return new GeneralAttribute($name);
  }

  public function basicInvalidValues(): array {
    return [
        [new \stdClass],
    ];
  }

  public function basicValidValues(): array {
    return [
        ['yes', 'yes'],
        [true, true],
        [1, 1],
        [0, 0],
        [' ', ' '],
    ];
  }

  /**
   * @return array[]
   */
  public function settingData(): array {
    return [[['', ' ', true, 'value1', ' value2 ', 0, -0, -1, 1, 0.01]]];
  }

  /**
   * @dataProvider settingData
   * @param scalar $values
   * @param scalar $expected
   * @param boolean $visibility
   */
  public function testSetting(array $values) {
    $attr = new GeneralAttribute('attr');
    foreach ($values as $value) {
      $attr->setValue($value);
      $this->assertEquals($attr->getValue(), $value);
      $this->assertTrue($attr->isVisible());
      $this->assertSame($attr->isBoolean(), is_bool($value));
    }
    $attr->setValue(false);
    $this->assertEquals($attr->getValue(), false);
    $this->assertFalse($attr->isVisible());
    $this->assertTrue($attr->isBoolean());
    $attr->setValue(null);
    $this->assertSame($attr->getValue(), null);
    $this->assertFalse($attr->isVisible());
    $this->assertFalse($attr->isBoolean());
    $this->expectException(InvalidArgumentException::class);
    $attr->setValue(new \stdClass());
    //$this->assertFalse($this->attr->isProtected());
    //$this->assertFalse($this->attr->isProtected($value));
    //$this->assertFalse($this->attr->isDemanded());
    //$this->assertEquals($this->attr->isVisible(), $value !== false);
  }

  public function testDemanding() {
    $attribute = new GeneralAttribute('data-attribute');
    $attribute->forceVisibility();
    $this->assertTrue($attribute->isDemanded());
    $attribute->setValue(false);
    $attribute->clear();
    $this->assertTrue($attribute->isDemanded());
    $this->assertEquals("$attribute", $attribute->getName() . "");
  }

  /**
   * @return string[]
   */
  public function lockMethodData(): array {
    return [
        [1],
        ['a'],
        [' ä ']
    ];
  }

  /**
   * @dataProvider lockMethodData
   * @param  scalar $value
   */
  public function testLockMethod($value) {
    $attr = $this->createAttr();
    $this->assertFalse($attr->isProtected());
    $attr->protectValue($value);
    $this->assertTrue($attr->isProtected());
    $this->assertEquals($attr->getValue(), $value);
    $this->expectException(ImmutableAttributeException::class);
    $attr->clear();
    $this->expectException(ImmutableAttributeException::class);
    $attr->setValue('foo');
  }

}
