<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\MVC\MembershipRequest;

use Sphp\Validators\FormValidator;
use Sphp\Validators\Whitelist;
use Sphp\Validators\ValidatorChain;
use Sphp\Validators\Regex;
use Sphp\Validators\NotEmpty;

/**
 * Implementation of FormDataValidator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FormDataValidator {

  /**
   * @var FormValidator;
   */
  private $validator;

  /**
   * @var Whitelist;
   */
  private $whitelistValidator;

  /**
   *
   * @var array
   */
  private $errors = [];

  public function __construct() {
    $this->whitelistValidator = new Whitelist([
        'name',
        'email',
        'phone',
        'title',
        'message',
        'g-recaptcha-response',
        'rvs_contact_token']);
    $this->initFormDataValidator();
  }

  private function initFormDataValidator() {
    $this->validator = new FormValidator();

    $this->validator->setValidator('title', $this->createFnameValidator());
    $this->validator->setValidator('body', $this->createLnameValidator());
    $this->validator->setValidator('city', $this->createTitleValidator());

    $this->validator->setValidator('email', $this->createEmailValidator());
    $this->validator->setValidator('phone', $this->createPhonenumberValidator());
  }

  private function createDobValidator(): ValidatorChain {
    $chain = new ValidatorChain(true);
    $re = $chain->regex("/^(0?[1-9]|[12][0-9]|3[01])[- \/.](0?[1-9]|1[012])[- \/.](19|20)\d{2}$/", 'Virheellinen syntymäaika annettu');
    $re->skip('');
    return $chain;
  }

  private function createFnameValidator(): ValidatorChain {
    $chain = new ValidatorChain(true);
    $chain->notEmpty(NotEmpty::STRING_TYPE, 'Etunimi on pakollinen');
    $chain->regex("/^[a-zåäöüA-ZÅÄÖÜ]+(([',. -][a-zåäöüA-ZÅÄÖÜ ])?[a-zåäöüA-ZÅÄÖÜ]*)*$/", 'Virheellinen etunimi');
    return $chain;
  }

  private function createLnameValidator(): ValidatorChain {
    $chain = new ValidatorChain(true);
    $chain->notEmpty(NotEmpty::STRING_TYPE, 'Sukunimi on pakollinen');
    $chain->regex("/^[a-zåäöüA-ZÅÄÖÜ]+(([',. -][a-zåäöüA-ZÅÄÖÜ ])?[a-zåäöüA-ZÅÄÖÜ]*)*$/", 'Virheellinen sukunimi');
    return $chain;
  }

  private function createZipcodeValidator(): ValidatorChain {
    $chain = new ValidatorChain(true);
    $chain->notEmpty(NotEmpty::STRING_TYPE, 'Postinumero on pakollinen');
    $chain->regex("/^[\d]{5}$/", 'Postinumero on viisi numeroa pitkä');
    return $chain;
  }

  private function createTitleValidator(): ValidatorChain {
    $chain = new ValidatorChain(true);
    $chain->notEmpty(NotEmpty::STRING_TYPE, 'Message title is required');
    return $chain;
  }

  private function createEmailValidator(): ValidatorChain {
    $chain = new ValidatorChain(true);
    $chain->notEmpty(NotEmpty::STRING_TYPE, 'Sähköpostiosoite on pakollinen');
    $chain->email('Sähköpostiosoite on virheellinen');
    return $chain;
  }

  private function createPhonenumberValidator(): ValidatorChain {
    $chain = new ValidatorChain(true);
    $chain->regex("/^([\+]?[0-9 ]{5,20})$/", 'Virheellinen puhelinnumero')->skip('');
    return $chain;
  }

  public function getErrors(): array {
    return $this->errors;
  }

  public function hasValidFieldsOnly(array $value): bool {
    $valid = $this->whitelistValidator->isValid($value);
    $this->errors = $this->whitelistValidator->errorsToArray();
    return $valid;
  }

  public function isValidFormSubmission(array $formData) {
    //echo '<pre>';
    //print_r($_POST);
    $this->errors = [];
    $valid = $this->whitelistValidator->isValid($formData);
    if ($valid) {
      $valid = $this->validator->isValid($formData);
      $this->errors = $this->validator->errorsToArray();
      return $valid;
    } else {
      $this->errors = $this->whitelistValidator->errorsToArray();
      return false;
    }
  }

  public function isValidSubmit() {
    //echo '<pre>';
    //print_r($_POST);
    $this->errors = [];
    $valid = $this->whitelistValidator->isValid($_POST);
    if ($valid) {
      $valid = $this->validator->isValid($_POST);
      $this->errors = $this->validator->errorsToArray();
      return $valid;
    } else {
      $this->errors = $this->whitelistValidator->errorsToArray();
      return false;
    }
  }

}
