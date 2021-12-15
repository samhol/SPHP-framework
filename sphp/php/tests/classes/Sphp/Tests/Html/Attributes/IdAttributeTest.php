<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\IdAttribute;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeValueException;

/**
 * Class IdAttributeTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class IdAttributeTest extends TestCase {

  public function basicInvalidValues(): iterable {
    yield [new \stdClass];
    yield [''];
    yield [' \n'];
    yield [true];
    yield [false];
    yield [1];
    yield ['0a'];
    yield [' a'];
  }

  /**
   * @dataProvider basicInvalidValues
   *  
   * @param  mixed $value
   * @return void
   */
  public function testConstructorWithInvalidParams($value): void {
    $this->expectException(InvalidAttributeValueException::class);
    new IdAttribute('id', $value);
  }

  /**
   * @dataProvider basicInvalidValues
   *  
   * @param  mixed $value
   * @return void
   */
  public function testSettingInvalidValues($value): void {
    $attr = new IdAttribute();
    $this->expectException(InvalidAttributeValueException::class);
    $attr->setValue($value);
  }

  public function testEmptyConstructor(): void {
    $attr = new IdAttribute();
    $this->assertFalse($attr->isVisible());
    $this->assertTrue($attr->isEmpty());
    $this->assertSame('', (string) $attr);
  }

  public function validConstructorParams(): iterable {
    yield ['id', 'foo'];
    yield ['foo', 'bar'];
    yield ['id', null];
    yield ['foo', null];
  }

  /**
   * @dataProvider validConstructorParams
   * 
   * @param  string $name
   * @param  string|null $value
   * @return void
   */
  public function testConstructorWithValidParams(string $name, ?string $value): void {
    $attr = new IdAttribute($name, $value);
    $this->assertFalse($attr->isAlwaysVisible());
    if ($value !== null) {
      $this->assertTrue($attr->isVisible());
      $this->assertFalse($attr->isEmpty());
      $this->assertSame("$name=\"$value\"", (string) $attr);
    } else {
      $this->assertFalse($attr->isVisible());
      $this->assertTrue($attr->isEmpty());
      $this->assertSame('', (string) $attr);
    }
  }

  public function validValues(): iterable {
    yield ['a'];
    yield ['a-1'];
    yield ['A-.'];
    yield ['f12oo'];
    yield [null];
  }

  /**
   * @dataProvider validValues
   *  
   * @param  string|null $value
   * @return void
   */
  public function testSetValidValue(?string $value): void {
    $attr = new IdAttribute();
    $this->assertSame($attr, $attr->setValue($value));
    $this->assertSame($value, $attr->getValue());
    if ($value !== null) {
      $this->assertTrue($attr->isVisible());
      $this->assertFalse($attr->isEmpty());
      $this->assertSame("{$attr->getName()}=\"$value\"", (string) $attr);
      $this->assertSame($attr, $attr->setValue(null));
      $this->assertSame('', (string) $attr);
    } else {
      $this->assertFalse($attr->isVisible());
      $this->assertTrue($attr->isEmpty());
      $this->assertSame('', (string) $attr);
      $this->assertSame($attr, $attr->setValue('foo'));
      $this->assertSame("{$attr->getName()}=\"foo\"", (string) $attr);
    }
  }

  /**
   * @return void
   */
  public function testIdentify(): void {
    $attr = new IdAttribute();
    $this->assertIsString($value = $attr->identify());
    $this->assertSame($value, $attr->getValue());
    $this->assertTrue($attr->isVisible());
    $this->assertFalse($attr->isEmpty());
    $this->assertSame("{$attr->getName()}=\"{$attr->getValue()}\"", (string) $attr);
    $this->assertSame('foo', $attr->identify('foo'));
    $this->assertSame("{$attr->getName()}=\"foo\"", (string) $attr);
  }

  public function outputTestData(): iterable {
    yield ['id', 'foo', 'id="foo"'];
    yield ['foo', null, ''];
  }

  /**
   * @dataProvider outputTestData
   *  
   * @param  string $attrName
   * @param  mixed  $value
   * @param  string $expected
   * @return void
   */
  public function testOutput(string $attrName, $value, string $expected): void {
    $attr = new IdAttribute($attrName, $value);
    $this->assertSame($expected, (string) $attr);
  }

}
