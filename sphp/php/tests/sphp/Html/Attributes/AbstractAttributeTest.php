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
class AbstractAttributeTest extends TestCase {

  public function createAttribute(): AbstractMutableAttribute {
    $mock = $this->getMockForAbstractClass(AbstractMutableAttribute::class, ['attr']);
    $mock->method('setValue')->willReturnCallback(
            function($arg) use ($mock) {
      $mock->value = $arg;
    }
    );
    $mock->method('getValue')
            ->willReturnCallback(function() use ($mock) {
              return $mock->value;
            });
    return $mock;
  }

  public function scalarValues(): array {
    $data = [];
    $data[] = [0];
    $data[] = ['0'];
    $data[] = [true];
    $data[] = [false];
    return $data;
  }

  /**
   * @dataProvider scalarValues
   * 
   * @param mixed $value
   * @return void
   */
  public function testGetValue($value): void {
    $mock = $this->createAttribute();
    $mock->setValue($value);
    if (!is_bool($value)) {
      $this->assertSame("attr=\"$value\"", (string) $mock);
    } else if ($value === true) {
      $this->assertSame('attr', (string) $mock);
    } else {
      $this->assertSame('', (string) $mock);
    }
  }

}
