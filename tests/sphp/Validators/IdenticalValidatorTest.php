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

class IdenticalValidatorTest extends TestCase {

  public function nonStrictData(): array {
    $data[] = [1, 1, true];
    $data[] = [1, '1', true];
    $data[] = ['1', '1', true];
    $data[] = ['', 0, true];
    $data[] = [0, '', true];
    $data[] = [0, null, true];
    $data[] = ['1', 1, true];
    $data[] = [true, 1, true];
    $data[] = [true, '1', true];
    return $data;
  }

  /**
   *
   * @dataProvider nonStrictData
   * @param mixed $token
   * @param mixed $value
   * @param boolean $valid
   */
  public function testNonStrict($token, $value, $valid) {
    $validator = new IdenticalValidator($token);
    $validator->setStrict(false);
    $this->assertSame($valid, $validator->isValid($value));
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
    $validator = new IdenticalValidator($token);
    $validator->setStrict(true);
    $this->assertSame($valid, $validator->isValid($value));
  }

}
