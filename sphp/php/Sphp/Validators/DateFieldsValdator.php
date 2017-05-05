<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Validators;

/**
 * Description of DateFieldsValdator
 *
 * @author Sami
 */
class DateFieldsValdator extends AbstractValidator {
  //put your code here
  
  private $fieldNames = [];
  
  public function isValid($value) {
    $this->setValue($value);
    if (!is_string($value) && !is_int($value) && !is_float($value)) {
      //echo 'Invalid type given. String, integer or float expected';
      $this->createErrorMessage('Invalid type given. String, integer or float expected');
      return false;
    }
    if (!Strings::match($value, $this->pattern)) {
      echo $value . $this->pattern;
      $this->addErrorMessage($this->errorMessage);
      return false;
    }
    return true;
  }

}
