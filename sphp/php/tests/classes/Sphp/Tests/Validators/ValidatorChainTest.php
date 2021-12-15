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
use Sphp\Validators\ValidatorChain;
use Sphp\Validators\StringLength;
use Sphp\Validators\Regex;
use Sphp\Exceptions\BadMethodCallException;

class ValidatorChainTest extends TestCase {

  /**
   * @return ValidatorChain
   */
  public function testConstructor(): ValidatorChain {
    $validator = new ValidatorChain();
    $this->assertCount(0, $validator);
    $this->assertCount(0, $validator->getErrors());
    $this->assertTrue($validator->getErrors()->containsTemplate(Validator::INVALID));
    $this->assertSame(null, $validator->getValue());
    $this->assertTrue($validator->isValid('foo'));
    return $validator;
  }

  /**
   * @depends testConstructor
   * 
   * @param  ValidatorChain $validator
   * @return ValidatorChain
   */
  public function testAddValidators(ValidatorChain $validator): ValidatorChain {
    $validator->collectionLength(1, 3);
    $validator->whitelist(['a', 'b']);
    $this->assertCount(2, $validator);
    return $validator;
  }

  /**
   * @depends testAddValidators
   * 
   * @param  ValidatorChain $validator
   * @return ValidatorChain
   */
  public function testSomeValidation(ValidatorChain $validator): ValidatorChain {
    $validator->setBreaksOnFailure(false);
    $this->assertFalse($validator->isValid('foo'));
    $this->assertCount(2, $validator->getErrors());
    $validator->setBreaksOnFailure(true);
    $this->assertFalse($validator->isValid('foo'));
    $this->assertCount(1, $validator->getErrors());
    $this->assertTrue($validator->isValid(['a' => 1]));
    return $validator;
  }

  /**
   * @depends testConstructor
   * @return void
   */
  public function testInvalidValidatorInsertion(ValidatorChain $validator): void {
    $this->expectException(BadMethodCallException::class);
    $validator->foo('bar');
  }

  public function createValidator(): Validator {
    $validator = new ValidatorChain();
    $strLen = new StringLength(2, 6);
    $patt = new Regex('/^[a-zA-Z]+$/', 'Please insert alphabets only');
    $validator->appendValidators($strLen);
    $validator->appendValidators($patt);
    return $validator;
  }

  public function getInvalidValue() {
    return '1aQ';
  }

  public function getValidValue() {
    return 'aAbB';
  }

  /**
   * 
   * @depends testConstructor
   * @param \Sphp\Tests\Validators\AbstractValidator $validator
   */
  public function testClone(Validator $validator) {
    $validator->getErrors()->setTemplate(Validator::INVALID, 'Foo is broken');
    $clone = clone $validator;
    $clone->getErrors()->setTemplate(Validator::INVALID, 'Foo is fixed');
    $this->assertEquals('Foo is fixed', $clone->getErrors()->getTemplate(Validator::INVALID));
    $this->assertEquals('Foo is broken', $validator->getErrors()->getTemplate(Validator::INVALID));
  }

}
