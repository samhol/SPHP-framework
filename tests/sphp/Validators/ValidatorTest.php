<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Validators;

use PHPUnit\Framework\TestCase;

abstract class ValidatorTest extends TestCase {

  abstract public function createValidator(): Validator;

  abstract public function getValidValue();

  abstract public function getInvalidValue();

  public function testReValidation() {
    $validator = $this->createValidator();
    $this->assertCount(0, $validator->errors());
    $this->assertFalse($validator->isValid($this->getInvalidValue()));
    $this->assertTrue($validator->errors()->count() > 0);
    $this->assertTrue($validator->isValid($this->getValidValue()));
    $this->assertCount(0, $validator->errors());
  }

}
