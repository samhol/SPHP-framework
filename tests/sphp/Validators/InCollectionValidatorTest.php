<?php

namespace Sphp\Validators;

class InCollectionValidatorTest extends \PHPUnit\Framework\TestCase {

  public function arrayData() {
    $data = [];
    $data[] = [[0, 1, null, false, true, '', ' ', "\n", [], new \stdClass()]];
    return $data;
  }

  /**
   *
   * @dataProvider arrayData
   * @param mixed $data
   */
  public function testIdentical($data) {
    $validator = new InArrayValidator($data);
    $validator->setStrict(true);
    foreach ($data as $value) {
      $this->assertTrue($validator->isValid($value));
    }
    $validator->setStrict(false);
    foreach ($data as $value) {
      $this->assertTrue($validator->isValid($value));
    }
  }

  /**
   *
   * @param string $path
   * @param mixed $exists
   */
  public function testStrict() {

    //$this->assertTrue(Path::get()->isPathFromRoot($path) === $exists);
  }

  /**
   *
   * @dataProvider arrayData
   * @param array $valid
   */
  public function testNotStrict($valid) {
    $validator = new InArrayValidator($valid);
    $this->assertTrue($validator->isValid(''));
  }

}
