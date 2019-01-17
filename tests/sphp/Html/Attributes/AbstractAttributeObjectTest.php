<?php

namespace Sphp\Tests\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\Attribute;

abstract class AbstractAttributeObjectTest extends TestCase {

  /**
   * @return Attribute
   */
  abstract public function createAttr(): Attribute;

  public function testConstructor() {
    $attribute = $this->createAttr();
    $this->assertFalse($attribute->isProtected());
    $this->assertFalse($attribute->isDemanded());
    $this->assertTrue($attribute->getValue() === false || $attribute->getValue() === null);
    $this->assertFalse($attribute->isVisible());
  }

  /**
   * @return array
   */
  abstract public function basicValidValues(): array;

  /**
   * @dataProvider basicValidValues
   * @param mixed  $inputValue
   * @param mixed  $outputValue
   */
  public function testBasicValidSettingSetting($inputValue, $outputValue) {
    $attribute = $this->createAttr();
    $attribute->setValue($inputValue);
    $this->assertFalse($attribute->isProtected());
    $this->assertFalse($attribute->isDemanded());
    $this->assertSame($attribute->getValue(), $outputValue);
  }

  /**
   * @return array
   */
  abstract public function basicInvalidValues(): array;

  /**
   * @dataProvider basicInvalidValues
   * @param mixed  $inputValue
   */
  public function testBasicInvalidSettingSetting($inputValue) {
    $attribute = $this->createAttr();
    $this->expectException(\Sphp\Exceptions\InvalidArgumentException::class);
    $attribute->setValue($inputValue);
  }

}
