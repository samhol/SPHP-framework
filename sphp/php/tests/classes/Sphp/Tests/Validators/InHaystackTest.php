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

use Sphp\Validators\InHaystack;

class InHaystackTest extends ValidatorTestCase {

  public function arrayData() {
    return [[[0, 1, null, false, true, '', ' ', "\n", [], new \stdClass()]]];
  }

  /**
   *
   * @dataProvider arrayData
   * @param mixed $data
   */
  public function testIdentical($data): void {
    $validator = new InHaystack($data);
    $validator->setStrict(true);
    foreach ($data as $k => $value) {
      $this->assertTrue($validator->isValid($value));
    }
    $validator->setStrict(false);
    foreach ($data as $k => $value) {
      $this->assertTrue($validator->isValid($value));
    }
  }

  public function createValidator(): InHaystack {
    return new InHaystack(['a', 'b']);
  }

  public function invalidValuesProvider(): iterable {
    yield ['c'];
  }

  public function validValuesProvider(): iterable {
    yield ['a'];
  }

}
