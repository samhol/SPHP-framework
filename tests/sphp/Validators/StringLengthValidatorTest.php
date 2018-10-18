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

class StringLengthValidatorTest extends TestCase {

  /**
   * @return StringLengthValidator
   */
  public function testRangeValidation(): StringLengthValidator {
    $validator = new StringLengthValidator(0, 5);
    $this->assertTrue($validator->isRangeValidator());
    $this->assertFalse($validator->isLowerBoundValidator());
    $this->assertFalse($validator->isValid('foobar'));
    $this->assertTrue($validator->isValid(''));
    $this->assertTrue($validator->isValid('     '));
    $validator->setRangeValidation(1, 1);
    $this->assertTrue($validator->isValid('a'));
    $this->assertFalse($validator->isValid('ab'));
    return $validator;
  }

  /**
   * @depends testRangeValidation
   * @param  StringLengthValidator $validator
   * @return StringLengthValidator
   */
  public function testLowerBoundValidation(StringLengthValidator $validator): StringLengthValidator {
    $this->assertSame($validator, $validator->setLowerBoundValidation(2));
    $this->assertTrue($validator->isLowerBoundValidator());
    $this->assertFalse($validator->isRangeValidator());
    $this->assertFalse($validator->isValid(''));
    $this->assertTrue($validator->isValid('  '));
    $this->assertTrue($validator->isValid('     '));
    return $validator;
  }

  /**
   * @depends testLowerBoundValidation
   * @param  StringLengthValidator $validator
   * @return StringLengthValidator
   */
  public function testUpperBoundValidation(StringLengthValidator $validator): StringLengthValidator {
    $this->assertSame($validator, $validator->setUpperBoundValidation(5));
    $this->assertTrue($validator->isUpperBoundValidator());
    $this->assertFalse($validator->isLowerBoundValidator());
    $this->assertFalse($validator->isRangeValidator());
    $this->assertTrue($validator->isValid(''));
    $this->assertFalse($validator->isValid('foobar'));
    return $validator;
  }
  
  
  /**
   * @expectedException \Sphp\Exceptions\InvalidArgumentException
   */
  public function testInvalidFileName() {
    $validator = new StringLengthValidator(-1, 5);
  }

}
