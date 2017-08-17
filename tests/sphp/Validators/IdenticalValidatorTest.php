<?php

namespace Sphp\Validators;

class IdenticalValidatorTest extends \PHPUnit\Framework\TestCase {

  public function nonStrictData() {
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
