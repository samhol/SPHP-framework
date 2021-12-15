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
use Sphp\Html\Attributes\JsonAttribute;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeValueException;

/**
 * Class JsonAttributeTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class JsonAttributeTest extends TestCase {

  public function basicValidValues(): iterable {
    yield ['{"foo":"bar"}', '{"foo":"bar"}'];
    yield [['foo' => 'bar'], '{"foo":"bar"}'];
    $obj = new \stdClass();
    $obj->foo = 'bar';
    yield [$obj, '{"foo":"bar"}'];
    yield [null, null];
  }

  /**
   * @dataProvider basicValidValues
   * 
   * @param  mixed $value
   * @param  string $output
   * @return void
   */
  public function testValidValues($value, ?string $output): void {
    $attr = new JsonAttribute('data-json', $value);
    if ($value === null) {
      $this->assertSame('', (string) $attr);
    } else {
      $this->assertSame($attr->getName() . "='{$attr->getValue()}'", (string) $attr);
    }
    $this->assertSame($output, $attr->getValue());
    $this->assertFalse($attr->isAlwaysVisible());
    $this->assertTrue($attr->isValidValue($value));
    $this->assertTrue($attr->isValidValue($output));
  }

  public function testConstructor() {
    $value = new \stdClass();
    $value->foo = 'bar';
    $value->int = 1;
    $value->false = false;
    $value->true = true;
    $value->tag = '<tag>';
    $value->path = 'a/b';
    $attr = new JsonAttribute('data-json', $value);
    $this->assertFalse($attr->isAlwaysVisible());
    $this->assertTrue($attr->isVisible());
    $this->assertFalse($attr->isEmpty());
    $this->assertSame($str = \Sphp\Stdlib\Parsers\ParseFactory::json()->toString($value, JSON_BIGINT_AS_STRING | JSON_NUMERIC_CHECK | JSON_HEX_TAG), $attr->getValue());
  }

  /**
   * @dataProvider basicValidValues
   * 
   * @param  mixed $value
   * @param  string $output
   * @return void
   */
  public function testOutput($value, ?string $output): void {
    $attr = new JsonAttribute('data-json', $value);
    $this->assertSame($output, $attr->getValue());
    if ($value !== null) {
      $this->assertSame($attr->getName() . "='$output'", (string) $attr);
    }
  }

  /**
   * @return void
   */
  public function testClear(): void {
    $attr = new JsonAttribute('data-json', ['a' => 0]);
    $attr->clear();
    $this->assertNull($attr->getValue());
  }

  public function alwaysInvalidValues(): iterable {
    yield [false];
    yield [true];
    yield ['a'];
    yield [''];
  }

  /**
   * @dataProvider alwaysInvalidValues
   * 
   * @param  mixed $value
   * @return void
   */
  public function testAlwaysInvalidValues($value): void {
    $attribute = new JsonAttribute('data-json');
    $this->expectException(InvalidAttributeValueException::class);
    $attribute->setValue($value);
  }

}
