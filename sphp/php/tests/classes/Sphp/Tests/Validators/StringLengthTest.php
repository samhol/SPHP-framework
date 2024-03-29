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

use PHPUnit\Framework\TestCase;
use Sphp\Validators\StringLength;
use Sphp\Exceptions\InvalidArgumentException;

class StringLengthTest extends TestCase {

  public function testRangeValidation(): void {
    $validator = new StringLength(0, 2);
    $this->assertTrue($validator->isRangeValidator());
    $this->assertFalse($validator->isLowerBoundValidator());
    $this->assertFalse($validator->isValid('foobar'));
    $this->assertTrue($validator->isValid(''));
    $this->assertTrue($validator->isValid(' a'));
    $validator->setRangeValidation(1, 1);
    $this->assertTrue($validator->isValid('a'));
    $this->assertFalse($validator->isValid('ab'));
    $this->assertFalse($validator->isValid(2));
  }

  /**
   * @return StringLength
   */
  public function testLowerBoundValidation(): void {
    //$this->assertSame($validator, $validator->setLowerBoundValidation(2));

    $validator = new StringLength(2, null);
    $this->assertTrue($validator->isLowerBoundValidator());
    $this->assertFalse($validator->isRangeValidator());
    $this->assertFalse($validator->isValid(''));
    $this->assertTrue($validator->isValid('  '));
    $this->assertTrue($validator->isValid('     '));
  }

  public function testUpperBoundValidation() {
    $validator = new StringLength(null, 5);
    $this->assertSame($validator, $validator->setUpperBoundValidation(5));
    $this->assertTrue($validator->isUpperBoundValidator());
    $this->assertFalse($validator->isLowerBoundValidator());
    $this->assertFalse($validator->isRangeValidator());
    $this->assertTrue($validator->isValid(''));
    $this->assertFalse($validator->isValid('foobar'));
    $this->expectException(InvalidArgumentException::class);
    $validator->setUpperBoundValidation(-1);
  }

  public function testInvalidConstructor() {
    $this->expectException(InvalidArgumentException::class);
    new StringLength(-1, 5);
  }

  public function testEmptyConstructor() {
    $this->expectException(InvalidArgumentException::class);
    new StringLength();
  }

  public function testInvalidRangeSet() {
    $this->expectException(InvalidArgumentException::class);
    (new StringLength(1, 2))->setRangeValidation(1, 0);
  }

}
