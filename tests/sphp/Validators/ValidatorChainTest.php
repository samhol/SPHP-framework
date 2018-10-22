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

class ValidatorChainTest extends TestCase {

  /**
   * @return StringLengthValidator
   */
  public function testConstructor() {
    $validator = new ValidatorChain();
    $this->assertCount(0, $validator);
    $this->assertTrue($validator->isValid('foo'));
    return $validator;
  }
  /**
   * @depends testConstructor
   * @return StringLengthValidator
   */
  public function testRangeValidation(ValidatorChain $validator) {
    $strLen = new StringLengthValidator(2, 6);
    $patt = new PatternValidator("/^[a-zA-Z]+$/", "Please insert alphabets only");
    $validator->appendValidator($strLen, true);
    $validator->appendValidator($patt);
    $this->assertCount(2, $validator);
    $this->assertTrue($validator->isValid('foo'));
    return $validator;
  }

}
