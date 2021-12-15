<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Validators;

use PHPUnit\Framework\TestCase;
use Sphp\Validators\Identical;

class IdenticalTest extends TestCase {

  public function nonStrictValid(): iterable {
    yield [1, 1, true];
    yield [0, 0.000, true];
    yield [PHP_INT_MAX, (string) PHP_INT_MAX, true];
    yield ['1', '1', true];
    yield ['0', 0, true];
    yield [0, '0', true];
    yield [0, null, true];
    yield ['1', 1, true];
    yield [true, 1, true];
    yield [new \stdClass, new \stdClass, true];
    yield [[0 => '0', [1]], [1 => [1], 0 => 0], true];
    yield ['a', ' a', false];
  }

  /**
   * @dataProvider nonStrictValid
   * 
   * @param mixed $token
   * @param mixed $value
   * @return void
   */
  public function testNonStrictValid($token, $value, bool $valid): void {
    $validator = new Identical($token);
    $validator->setStrict(false);

    $this->assertSame($valid, $validator->isValid($value));
  }

  public function strictData(): iterable {
    $obj = new \stdClass();
    yield [1, 1, true];
    yield [1, '1', false];
    yield ['1', '1', true];
    yield ['', 0, false];
    yield [0, '', false];
    yield [0, null, false];
    yield ['1', 1, false];
    yield [true, 1, false];
    yield [true, true, true];
    yield [false, false, true];
    yield [true, '1', false];
    yield [$obj, new \stdClass(), false];
    yield [$obj, $obj, true];
    yield [[], [], true];
    yield [[1], [1], true];
    yield [[1], [1 => 1], false];
  }

  /**
   *
   * @dataProvider strictData
   * @param mixed $token
   * @param mixed $value
   * @param boolean $valid
   */
  public function testStrict($token, $value, bool $valid): void {
    $validator = new Identical($token);
    $validator->setStrict(true);
    $this->assertSame($valid, $validator->isValid($value));
    if (!$valid) {
      $this->assertCount(1, $validator->getErrors());
    } else {
      $this->assertCount(0, $validator->getErrors());
    }
  }

}
