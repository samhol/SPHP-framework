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
use Sphp\Html\Attributes\AbstractAttribute;

/**
 * Class AbstractAttributeTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractAttributeTest extends TestCase {

  public function createAttribute($value): AbstractAttribute {
    $mock = $this->getMockForAbstractClass(AbstractAttribute::class, ['attr']);

    $mock->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue($value));
    return $mock;
  }

  public function scalarAndNullValues(): iterable {
    yield [0];
    yield ['0'];
    yield [true];
    yield [false];
    yield [null];
  }

  /**
   * @dataProvider scalarAndNullValues
   * 
   * @param  mixed $value
   * @return void
   */
  public function testBasicFunctionality($value): void {
    $mock = $this->createAttribute($value);
    if (is_bool($value) || is_null($value)) {
      $this->assertTrue($mock->isEmpty());
      if ($value === true) {
        $this->assertSame('attr', (string) $mock);
        $this->assertTrue($mock->isVisible());
      } else {
        $this->assertSame('', (string) $mock);
        $this->assertFalse($mock->isVisible());
      }
    } else {
      $this->assertSame("attr=\"$value\"", (string) $mock);
      $this->assertTrue($mock->isVisible());
    }
  }

  public function invalidAttributeNames(): iterable {
    yield [''];
    yield ['0'];
    yield [' '];
    yield [')'];
  }

  /**
   * @dataProvider invalidAttributeNames
   * 
   * @param  string $name
   * @return void
   */
  public function testInvalidAttributeNames(string $name): void {
    $this->expectException(\Sphp\Html\Attributes\Exceptions\AttributeException::class);
    $mock = $this->getMockForAbstractClass(AbstractAttribute::class, [$name]);
  }

}
