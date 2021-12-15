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
use Sphp\Validators\Validator;

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
    $this->assertEquals('Foo is broken', $validator->getErrors()->getTemplate(Validator::INVALID));
    return $validator;
  }

  /**
   * @depends testDefault
   *
   * @param  AbstractValidator $validator
   * @return void
   */
  public function testClone(AbstractValidator $validator): void {
    $clone = clone $validator;
    $clone->getErrors()->setTemplate(Validator::INVALID, 'Foo is fixed');
    $this->assertEquals('Foo is fixed', $clone->getErrors()->getTemplate(Validator::INVALID));
    $this->assertEquals('Foo is broken', $validator->getErrors()->getTemplate(Validator::INVALID));
  }

}
