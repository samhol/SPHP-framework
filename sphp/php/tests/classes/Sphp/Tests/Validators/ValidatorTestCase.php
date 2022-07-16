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
use Sphp\Validators\AbstractValidator;

abstract class ValidatorTestCase extends TestCase {

  abstract public function createValidator(): AbstractValidator;

  abstract public function validValuesProvider(): iterable;

  abstract public function invalidValuesProvider(): iterable;

  public function testValidatorBasics(): void {
    $validator = $this->createValidator();
    $this->assertCount(0, $validator->getMessages());
  }

  /**
   * @dataProvider validValuesProvider
   * 
   * @param  mixed $value
   * @return void
   */
  public function testIsValid(mixed $value): void {
    $validator = $this->createValidator();
    $this->assertTrue($validator->isValid($value), 'Valid value is validated as invalid');
    $this->assertTrue($validator($value), 'Valid value is validated as invalid');
    $this->assertCount(0, $validator->getMessages());
  }

  /**
   * @dataProvider invalidValuesProvider
   * 
   * @param mixed $value
   * @return void
   */
  public function testIsNotValid(mixed $value): void {
    $validator = $this->createValidator();
    $this->assertFalse($validator->isValid($value), 'Invalid value is validated as valid');
    $messageArray = $validator->getMessages()->toArray();
    $this->assertTrue($count = $validator->getMessages()->count() > 0);
    $this->assertFalse($validator($value), 'Invalid value is validated as valid');
    $this->assertSame( $messageArray, $validator->getMessages()->toArray());
  }

}
