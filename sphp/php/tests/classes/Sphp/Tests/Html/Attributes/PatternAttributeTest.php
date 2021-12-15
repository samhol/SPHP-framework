<?php

declare(strict_types=1);

namespace Sphp\Tests\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeValueException; 
use Sphp\Html\Attributes\PatternAttribute;

class PatternAttributeTest extends TestCase {

  public function testConstructor(): void {
    $attribute = new PatternAttribute('data-pattern', '//');
    $this->assertFalse($attribute->isAlwaysVisible());
    $this->assertFalse($attribute->isVisible());
    $this->assertTrue($attribute->isEmpty());
    $this->assertNull($attribute->getValue());
    $this->assertFalse($attribute->isVisible());
    $this->assertSame('', (string) $attribute);
  }

  public function validValues(): iterable {
    yield ['/^[\s]+$/', ' '];
    yield ['/^[2]+$/', '2'];
    yield ['/^[2]+$/', 2];
    yield ['/^[2.1]+$/', 2.1];
  }

  /**
   * @dataProvider validValues
   *  
   * @param  string $pattern
   * @param  mixed $value
   * @return void
   */
  public function testSetValidValue(string $pattern, $value): void {
    $attribute1 = new PatternAttribute('data-pattern', $pattern, $value);
    $attribute = new PatternAttribute('data-pattern', $pattern);
    $this->assertSame($attribute, $attribute->setValue($value));
    $this->assertEquals($attribute, $attribute1);
    $this->assertSame($value, $attribute->getValue());
    $this->assertFalse($attribute->isAlwaysVisible());
    $this->assertTrue($attribute->isVisible());
    $this->assertFalse($attribute->isEmpty());
  }

  /**
   *  
   * @param  string $pattern
   * @param  mixed $value
   * @return void
   */
  public function testClear(): void {
    $attribute = new PatternAttribute('data-pattern', '/foo/', 'foo');
    $this->assertSame($attribute, $attribute->setValue('foo'));

    $this->assertSame('foo', $attribute->getValue());
    $this->assertSame($attribute, $attribute->clear());
    $this->assertSame('', (string) $attribute);
    $this->assertFalse($attribute->isAlwaysVisible());
    $this->assertFalse($attribute->isVisible());
    $this->assertTrue($attribute->isEmpty());
    $this->assertNull($attribute->getValue());
    $this->assertFalse($attribute->isVisible());
  }

  public function alwaysInvalidValues(): iterable {
    yield [new \stdClass];
    //yield ['a'];
    yield [true];
    yield [false];
  }

  /**
   * @dataProvider alwaysInvalidValues
   * 
   * @param  mixed $value
   * @return void
   */
  public function testAlwaysInvalidValues($value): void {
    $attribute = new PatternAttribute('data-pattern', '//');
    $this->expectException(AttributeException::class);
    $attribute->setValue($value);
  }

  public function patternFailureValues(): iterable {
    yield ['/^[\s]+$/', 'x'];
    yield ['/^[2]+$/', '21'];
    yield ['/^[2]+$/', 21];
  }

  /**
   * @dataProvider patternFailureValues
   * 
   * @param  string $pattern
   * @param  mixed $value
   * @return void
   */
  public function testSetValueFailingPattern(string $pattern, $value): void {
    $attribute = new PatternAttribute('data-pattern', $pattern);
    $this->expectException(InvalidAttributeValueException::class);
    $attribute->setValue($value);
  }

  /**
   * @dataProvider patternFailureValues
   * 
   * @param  string $pattern
   * @param  mixed $value
   * @return void
   */
  public function testConstructorValueFailingPattern(string $pattern, $value): void {
    $this->expectException(InvalidAttributeValueException::class);
    new PatternAttribute('data-pattern', $pattern, $value);
  }

}
