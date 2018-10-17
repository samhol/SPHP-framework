<?php

namespace Sphp\Validators;

class InCollectionValidatorTest extends \PHPUnit\Framework\TestCase {

  public function arrayData() {
    return [[[0, 1, null, false, true, '', ' ', "\n", [], new \stdClass()]]];
  }

  /**
   *
   * @dataProvider arrayData
   * @param mixed $data
   */
  public function testIdentical($data) {
    $validator = new InArrayValidator($data);
    $validator->setStrict(true);
    foreach ($data as $k => $value) {
      $this->assertTrue($validator->isValid($value), "FOO $k");
    }
    $validator->setStrict(false);
    foreach ($data as $k => $value) {
      $this->assertTrue($validator->isValid($value), "FOO1 $k");
    }
  }

}
