<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Attributes;

use Sphp\Html\Attributes\ScalarAttribute;
use Sphp\Tests\Html\Attributes\AbstractScalarAttributeTest;
use Sphp\Html\Attributes\MutableAttribute;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeValueException;

class ScalarAttributeTest extends AbstractScalarAttributeTest {

  /**
   * @return MutableAttribute
   */
  public function createAttr(string $name = 'data-attr'): MutableAttribute {
    return new ScalarAttribute($name);
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
   * @return void
   */
  public function testSetting(array $values): void {
    $attr = new ScalarAttribute('attr');
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
    $this->expectException(InvalidAttributeValueException::class);
    $attr->setValue(new \stdClass());
    //$this->assertFalse($this->attr->isProtected());
    //$this->assertFalse($this->attr->isProtected($value));
    //$this->assertFalse($this->attr->isDemanded());
    //$this->assertEquals($this->attr->isVisible(), $value !== false);
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
   * 
   * @param  scalar $value
   * @return void
   */
  public function testLockMethod($value): void {
    $attr = $this->createAttr();
    $this->assertFalse($attr->isProtected());
    $attr->protectValue($value);
    $this->assertTrue($attr->isProtected());
    $this->assertEquals($attr->getValue(), $value);
    //$this->expectException(ImmutableAttributeException::class);
    $attr->clear();
    $this->expectException(ImmutableAttributeException::class);
    $attr->setValue('foo');
  }

  public function scalarValues(): array {
    $data = [];
    $data[] = [0];
    $data[] = ['0'];
    $data[] = [true];
    $data[] = [false];
    $data[] = [null];
    return $data;
  }

  /**
   * @dataProvider scalarValues
   * 
   * @param mixed $value
   * @return void
   */
  public function testSetImmutableValue($value): void {
    $attr = $this->createAttr('attr');
    $attr->protectValue($value);
    if (!is_bool($value) && $value !== null) {
      $this->assertTrue($attr->isVisible());
      $this->assertSame("attr=\"$value\"", (string) $attr);
    } else if ($value === false || $value === null) {
      $this->assertSame('', (string) $attr);
      $this->assertFalse($attr->isVisible());
    } else {
      $this->assertTrue($attr->isVisible());
      $this->assertSame('attr', (string) $attr);
    }
    $this->expectException(ImmutableAttributeException::class);
    $attr->setValue('foo');
    $this->expectException(ImmutableAttributeException::class);
    $attr->protectValue('foo');
  }

  /**
   * @return void
   */
  public function testReProtectValue(): void {
    $attr = $this->createAttr('attr');
    $attr->protectValue('foo');
    $this->expectException(ImmutableAttributeException::class);
    $attr->protectValue('bar');
  }

  /**
   * @return void
   */
  public function testClear(): void {
    $attr = $this->createAttr('attr');
    $attr->setValue('foo');
    $attr->clear();
    $this->assertSame('', (string) $attr);
    $attr->protectValue('foo');
    $attr->clear();
    $this->assertSame('attr="foo"', (string) $attr);
  }

}
