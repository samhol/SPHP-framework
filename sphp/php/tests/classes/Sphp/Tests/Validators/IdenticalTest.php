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

use Sphp\Validators\Identical;

class IdenticalTest extends ValidatorTestCase {

  public function nonStrictValidationDataProvider(): iterable { 
    yield [0, 0.000, true];
    yield [0, '0', true];
    yield ['1', '1', true];  
    yield [0, null, true];
    yield ['1', 1.0, true];
    yield [true, 1, true];
    yield [new \stdClass, new \stdClass, true];
    yield [[0 => '0', [1]], [1 => [1], 0 => 0], true];
    yield ['', ' ', false];
  }

  /**
   * @dataProvider nonStrictValidationDataProvider
   * 
   * @param  mixed $token
   * @param  mixed $value
   * @return void
   */
  public function testNonStrictValid($token, $value, bool $valid): void {
    $validator = new Identical($token);
    $validator->setStrict(false);

    $this->assertSame($valid, $validator->isValid($value));
  }

  public function strictValidationDataProvider(): iterable {
    $obj = new \stdClass();
    yield [1, '1', false];
    yield ['', 0, false];
    yield [null, null, true];
    yield [0, null, false];
    yield ['1', 1, false];
    yield [true, 1, false];
    yield [false, 0, false];
    yield [true, '1', false];
    yield [$obj, new \stdClass(), false];
    yield [$obj, $obj, true];
    yield [[1], [1], true];
    yield [[1], [1 => 1], false];
  }

  /**
   * @dataProvider strictValidationDataProvider
   * 
   * @param mixed $token
   * @param mixed $value
   * @param boolean $valid
   */
  public function testStrict($token, $value, bool $valid): void {
    $validator = new Identical($token);
    $validator->setStrict(true);
    $this->assertSame($valid, $validator->isValid($value));
    if (!$valid) {
      $this->assertCount(1, $validator->getMessages());
    } else {
      $this->assertCount(0, $validator->getMessages());
    }
  }

  public function createValidator(): Identical {
    return new Identical('a');
  }

  public function invalidValuesProvider(): iterable {
    yield ['b'];
  }

  public function validValuesProvider(): iterable {
    yield ['a'];
  }

}
