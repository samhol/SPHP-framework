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

class SmallerThanValidatorTest extends TestCase {

  public function validSmallerThanData(): array {
    $data[] = [1, true, 1];
    $data[] = [-1, true, -1];
    $data[] = [-1, true, -1];
    $data[] = [-1, false, -1.00001];
    return $data;
  }
  /**
   * @dataProvider validSmallerThanData
   * 
   * @param  float $max
   * @param  bool $inclusive
   * @param  float $value
   * @return SmallerThanValidator
   */
  public function testValidSmallerThan(float $max, bool $inclusive, float $value): SmallerThanValidator {
    $validator = new SmallerThanValidator($max, $inclusive);
    $this->assertTrue($validator->isValid($value));
    return $validator;
  }
  public function invalidSmallerThanData(): array {
    $data[] = [1, true, 1.1];
    $data[] = [1, false, 1];
    $data[] = [-1, false, -1];
    $data[] = [-1, true, -.99];
    $data[] = [0, true, 0.1];
    $data[] = [0, false, 0];
    return $data;
  }
  /**
   * @dataProvider invalidSmallerThanData
   * 
   * @param  float $max
   * @param  bool $inclusive
   * @param  float $value
   * @return SmallerThanValidator
   */
  public function testInvalidSmallerThan(float $max, bool $inclusive, float $value): SmallerThanValidator {
    $validator = new SmallerThanValidator($max, $inclusive);
    $this->assertFalse($validator->isValid($value));
    return $validator;
  }

}
