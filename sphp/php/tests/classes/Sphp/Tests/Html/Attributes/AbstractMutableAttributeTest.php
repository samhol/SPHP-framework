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
use Sphp\Html\Attributes\AbstractMutableAttribute;

/**
 * Class AbstractAttributeTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractMutableAttributeTest extends TestCase {

  public function createAttribute(string $name): AbstractMutableAttribute {
    $mock = $this->getMockForAbstractClass(AbstractMutableAttribute::class, [$name]);
    $mock->method('setValue')->willReturnCallback(
            function ($arg) use ($mock) {
              $mock->value = $arg;
            }
    );
    $mock->method('getValue')
            ->willReturnCallback(function () use ($mock) {
              return $mock->value;
            });
    return $mock;
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
   * @param mixed $value
   * @return void
   */
  public function testGetValueAndVisibility($value): void {
    $mock = $this->createAttribute('attr');
    $mock->setValue($value);

    if ($value === false || $value === null) {
      $this->assertSame('', (string) $mock);
      $this->assertSame($mock, $mock->forceVisibility());
      $this->assertSame($mock->getName(), (string) $mock);
    } else if ($value !== true) {
      $this->assertSame($mock->getName() . "=\"$value\"", (string) $mock);
      $this->assertTrue($mock->isVisible());
    } else {
      $this->assertSame($mock->getName(), (string) $mock);
      $this->assertTrue($mock->isVisible());
    }
  }

}
