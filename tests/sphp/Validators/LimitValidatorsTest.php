<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Validators;

use PHPUnit\Framework\TestCase;
use Sphp\Validators\SmallerThan;
use Sphp\Validators\GreaterThan;
use Sphp\Validators\Range;

class LimitValidatorsTest extends TestCase {

  public function validSmallerThanData(): array {
    $data[] = [1];
    $data[] = [-1];
    $data[] = [0];
    $data[] = [.000000001];
    return $data;
  }

  /**
   * @dataProvider validSmallerThanData
   * 
   * @param  float $limit
   */
  public function testValidSmallerThan(float $limit) {
    $smallerThan = new SmallerThan($limit, true);
    $greaterThan = new GreaterThan($limit, true);
    $this->assertTrue($smallerThan->isValid($limit));
    $this->assertTrue($greaterThan->isValid($limit));
    $this->assertTrue($smallerThan->isValid(($limit - .1)));
    $this->assertTrue($greaterThan->isValid(($limit + .1)));
    $this->assertFalse($smallerThan->isValid(($limit + .1)));
    $this->assertFalse($greaterThan->isValid(($limit - .1)));
    $smallerThan->setInclusive(false);
    $greaterThan->setInclusive(false);
    $this->assertFalse($smallerThan->isValid($limit));
    $this->assertFalse($greaterThan->isValid($limit));
    $this->assertTrue($smallerThan->isValid(($limit - .1)));
    $this->assertTrue($greaterThan->isValid(($limit + .1)));
    $this->assertFalse($smallerThan->isValid(($limit + .1)));
    $this->assertFalse($greaterThan->isValid(($limit - .1)));
  }

  public function ranges(): array {
    $data[] = [-1, 1];
    $data[] = [-.01, 0];
    return $data;
  }

  /**
   * @dataProvider ranges
   * 
   * @param float $min
   * @param float $max
   */
  public function testInRange(float $min, float $max) {
    $rangeValidator = new Range($min, $max, true);
    $this->assertTrue($rangeValidator->isValid(($max - ($max - $min) / 2)));
    $this->assertTrue($rangeValidator->isValid($min));
    $this->assertTrue($rangeValidator->isValid($max));
    $this->assertFalse($rangeValidator->isValid($min - .1));
    $this->assertFalse($rangeValidator->isValid($max + .1));
    $this->assertSame($rangeValidator, $rangeValidator->setInclusive(false));
    $this->assertTrue($rangeValidator->isValid(($max - ($max - $min) / 2)));
    $this->assertFalse($rangeValidator->isValid($min));
    $this->assertFalse($rangeValidator->isValid($max));
  }

}
