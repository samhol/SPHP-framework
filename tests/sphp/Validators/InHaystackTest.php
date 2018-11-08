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

class InHaystackTest extends TestCase {

  public function arrayData() {
    return [[[0, 1, null, false, true, '', ' ', "\n", [], new \stdClass()]]];
  }

  /**
   *
   * @dataProvider arrayData
   * @param mixed $data
   */
  public function testIdentical($data) {
    $validator = new InHaystack($data);
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
