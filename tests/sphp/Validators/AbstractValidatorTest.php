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

class AbstractValidatorTest extends TestCase {

  public function createValidator(string $message): AbstractValidator {
    $validator = $this->getMockBuilder(AbstractValidator::class)
            ->setMethods(['isValid'])
            ->setConstructorArgs([$message])
            ->enableOriginalConstructor()
            ->getMock();
    return $validator;
  }

  public function testDefault(): AbstractValidator {
    $validator = $this->createValidator('Foo is broken');
    $this->assertEquals('Foo is broken', $validator->errors()->getTemplate(Validator::INVALID));
    return $validator;
  }

}
