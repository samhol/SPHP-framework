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
use Sphp\Html\Attributes\ScalarAttribute;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeValueException;

class ScalarAttributeTest extends TestCase {

  /**
   * @return ScalarAttribute
   */
  public function createAttr(string $name = 'data-attr'): ScalarAttribute {
    return new ScalarAttribute($name);
  }

  public function attributeValues(): iterable {
    yield [0];
    yield ['0'];
    yield [true];
    yield [false];
    yield [null];
  }

  /**
   * @dataProvider attributeValues
   * 
   * @param  scalar $values 
   * @return void
   */
  public function testSetValue($values): void {
    $name = 'attr';
    $attr1 = new ScalarAttribute($name, $values);
    $attr2 = new ScalarAttribute($name);
    $this->assertSame($attr2, $attr2->setValue($values));

    $this->assertEquals($attr2, $attr1);
    $this->assertSame($attr1->isBoolean(), is_bool($values));
    if ($values === true) {
      $this->assertTrue($attr1->isVisible());
      $this->assertSame($name, (string) $attr1);
    } else if ($values === false) {
      $this->assertFalse($attr1->isVisible());
      $this->assertSame('', (string) $attr1);
    } else if ($values === null) {
      $this->assertNull($attr1->getValue());
      $this->assertFalse($attr1->isVisible());
      $this->assertSame('', (string) $attr1);
    } else {
      $this->assertTrue($attr1->isVisible());
      $this->assertSame("{$attr1->getName()}=\"$values\"", (string) $attr1);
    }
    $this->expectException(InvalidAttributeValueException::class);
    $attr1->setValue(new \stdClass());
  }

  /**
   * @return void
   */
  public function testClear(): void {
    $attr = $this->createAttr('attr');
    $attr->setValue('foo');
    $attr->clear();
    $this->assertSame('', (string) $attr);
    $attr->forceVisibility();
    $attr->clear();
    $this->assertSame($attr->getName(), (string) $attr);
  }

}
