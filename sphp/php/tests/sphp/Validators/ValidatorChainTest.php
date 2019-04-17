<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Validators;

use Sphp\Tests\Validators\ValidatorTest;
use Sphp\Validators\Validator;
use Sphp\Validators\ValidatorChain;
use Sphp\Validators\StringLength;
use Sphp\Validators\Regex;

class ValidatorChainTest extends ValidatorTest {

  /**
   * @return StringLength
   */
  public function testConstructor() {
    $validator = new ValidatorChain();
    $this->assertCount(0, $validator);
    $this->assertTrue($validator->isValid('foo'));
    return $validator;
  }

  /**
   * @depends testConstructor
   * @return StringLength
   */
  public function testRangeValidation(ValidatorChain $validator) {
    $strLen = new StringLength(2, 6);
    $patt = new Regex('/^[a-zA-Z]+$/', 'Please insert alphabets only');
    $validator->appendValidator($strLen, true);
    $validator->appendValidator($patt);
    $this->assertCount(2, $validator);
    $this->assertTrue($validator->isValid('foo'));
    return $validator;
  }

  public function createValidator(): Validator {
    $validator = new ValidatorChain();
    $strLen = new StringLength(2, 6);
    $patt = new Regex('/^[a-zA-Z]+$/', 'Please insert alphabets only');
    $validator->appendValidator($strLen, true);
    $validator->appendValidator($patt);
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
    $validator->errors()->setTemplate(Validator::INVALID, 'Foo is broken');
    $clone = clone $validator;
    $clone->errors()->setTemplate(Validator::INVALID, 'Foo is fixed');
    $this->assertEquals('Foo is fixed', $clone->errors()->getTemplate(Validator::INVALID));
    $this->assertEquals('Foo is broken', $validator->errors()->getTemplate(Validator::INVALID));
  }

}
