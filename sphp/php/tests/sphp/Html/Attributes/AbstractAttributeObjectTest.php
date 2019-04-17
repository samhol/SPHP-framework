<?php

namespace Sphp\Tests\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\Attribute;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;

abstract class AbstractAttributeObjectTest extends TestCase {

  /**
   * @return Attribute
   */
  abstract public function createAttr(string $name = 'attr'): Attribute;

  public function testConstructor() {
    $attribute = $this->createAttr();
    $this->assertFalse($attribute->isProtected());
    $this->assertFalse($attribute->isDemanded());
    //var_dump($attribute->getValue());
    $this->hasNoValues($attribute);
    $this->assertTrue($attribute->getValue() === false || $attribute->getValue() === null);
    $this->assertFalse($attribute->isVisible());
    $this->expectException(BadMethodCallException::class);
    $attribute->__construct('foo');
  }

  /**
   * @return string[]
   */
  public function invalidAttributeNames(): array {
    return [
        [' '],
        [' a'],
        ['ä']
    ];
  }

  /**
   * @dataProvider invalidAttributeNames
   * @param string $name
   */
  public function testInvalidConstructorCall(string $name) {
    $this->expectException(InvalidArgumentException::class);
    $this->createAttr($name);
  }

  /**
   * @param Attribute $attribute
   */
  public function hasNoValues(Attribute $attribute) {
    $this->assertTrue($attribute->isEmpty());
    $this->assertFalse($attribute->isProtected());
    $valueType = gettype($attribute->getValue());
    $errorMessage = sprintf('Empty attribute object %s has type(%s) as its value', get_class($attribute), $valueType);
    $this->assertTrue($attribute->getValue() === false || $attribute->getValue() === null, $errorMessage);
    if ($attribute instanceof \Countable) {
      $this->assertCount(0, $attribute);
    }
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
    $this->assertSame($outputValue, $attribute->getValue());
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
    $this->expectException(InvalidArgumentException::class);
    $attribute->setValue($inputValue);
  }

}
