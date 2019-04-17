<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use PHPUnit\Framework\TestCase;

class IdenticalTest extends TestCase {

  public function nonStrictValid(): array {
    $data[] = [1, 1];
    $data[] = [0, 0.000];
    $data[] = [PHP_INT_MAX, '' . PHP_INT_MAX];
    $data[] = ['1', '1'];
    $data[] = ['0', 0];
    $data[] = [0, '0'];
    $data[] = [0, null];
    $data[] = ['1', 1];
    $data[] = [true, 1];
    $data[] = [new \stdClass, new \stdClass];
    $data[] = [[0 => '0', [1]], [1 => [1], 0 => 0]];
    return $data;
  }

  /**
   *
   * @dataProvider nonStrictValid
   * @param mixed $token
   * @param mixed $value
   * @param boolean $valid
   */
  public function testNonStrictValid($token, $value) {
    $validator = new Identical($token);
    $validator->setStrict(false);

    $this->assertTrue($validator->isValid($value));
  }

  public function strictValid(): array {
    $obj = new \stdClass();
    $data[] = [1, 1];
    $data[] = [0, 0];
    $data[] = [PHP_INT_MAX, PHP_INT_MAX];
    $data[] = [false, false];
    $data[] = [true, true];
    $data[] = ['1', '1'];
    $data[] = [null, null];
    $data[] = [$obj, $obj];
    $data[] = [[0 => '0', [1]], [0 => '0', [1]]];
    return $data;
  }

  /**
   *
   * @dataProvider strictValid
   * @param mixed $token
   * @param mixed $value
   */
  public function testStrictValid($token, $value) {
    $validator = new Identical($token);
    $validator->setStrict(true);

    $this->assertTrue($validator->isValid($value));
  }

  public function strictData() {
    $obj = new \stdClass();
    $data[] = [1, 1, true];
    $data[] = [1, '1', false];
    $data[] = ['1', '1', true];
    $data[] = ['', 0, false];
    $data[] = [0, '', false];
    $data[] = [0, null, false];
    $data[] = ['1', 1, false];
    $data[] = [true, 1, false];
    $data[] = [true, true, true];
    $data[] = [false, false, true];
    $data[] = [true, '1', false];
    $data[] = [$obj, new \stdClass(), false];
    $data[] = [$obj, $obj, true];
    return $data;
  }

  /**
   *
   * @dataProvider strictData
   * @param mixed $token
   * @param mixed $value
   * @param boolean $valid
   */
  public function testStrict($token, $value, $valid) {
    $validator = new Identical($token);
    $validator->setStrict(true);
    $this->assertSame($valid, $validator->isValid($value));
  }

}
