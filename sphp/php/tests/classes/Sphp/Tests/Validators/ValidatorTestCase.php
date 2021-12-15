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
use Sphp\Validators\Validator;

abstract class ValidatorTestCase extends TestCase {

  abstract public function createValidator(): Validator;

  abstract public function getValidValue();

  abstract public function getInvalidValue();

  public function testReValidation() {
    $validator = $this->createValidator();
    $this->assertCount(0, $validator->getErrors());
    $this->assertFalse($validator->isValid($this->getInvalidValue()), 'Invalid value is validated as valid');
    $this->assertTrue($validator->getErrors()->count() > 0);
    $this->assertTrue($validator->isValid($this->getValidValue()));
    $this->assertCount(0, $validator->getErrors());
  }

}
