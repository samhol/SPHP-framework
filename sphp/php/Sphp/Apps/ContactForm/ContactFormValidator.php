<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\ContactForm;

use Sphp\Validators\MapValidator;
use Sphp\Validators\Whitelist;
use Sphp\Validators\ValidatorChain;
use Sphp\Validators\NotEmpty;
use Sphp\Stdlib\MessageManager;
use Sphp\Validators\Regex;

/**
 * Class ContactFormValidator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ContactFormValidator implements \Sphp\Validators\Validator {

  private MapValidator $formDataValidator;
  private Whitelist $whitelistValidator;

  /**
   * @var array
   */
  private $errors = [];

  public function __construct() {
    $this->whitelistValidator = new Whitelist([
        'name',
        'email',
        'phone',
        'message',
        'g-recaptcha-response',
        'contact-form-token'], 'Lomake sisältää virheitä');
    $this->formDataValidator = new MapValidator();
    $this->formDataValidator->setValidator('name', $this->createNameValidator());
    $this->formDataValidator->setValidator('email', $this->createEmailValidator());
    $this->formDataValidator->setValidator('phone', $this->createPhonenumberValidator());
    $this->formDataValidator->setValidator('message', $this->createMessageValidator());
  }

  private function createNameValidator(): ValidatorChain {
    $chain = new ValidatorChain(true);
    $chain->notEmpty('Name is required');
    $chain->regex("/[a-zåäö]+/", 'A name must contain letters');
    return $chain;
  }

  private function createMessageValidator(): NotEmpty {
    $chain = new NotEmpty('Message is required');
    return $chain;
  }

  private function createEmailValidator(): ValidatorChain {
    $chain = new ValidatorChain(true);
    $chain->notEmpty('Email address is required');
    $chain->email('Sähköpostiosoite on virheellinen');
    return $chain;
  }

  private function createPhonenumberValidator(): Regex {
    $chain = new Regex("/^([\+]?[0-9 ]{5,20})$/", 'Phone number is invalid');
    $chain->skip('');
    return $chain;
  }

  public function getInputErrors(): \Sphp\Validators\ErrorMessages {
    return $this->formDataValidator->errors();
  }

  public function isValid(mixed $value): bool {
    //echo '<pre>';
    //print_r($_POST);
    $this->errors = new MessageManager();
    $valid = $this->whitelistValidator->isValid($value);
    if ($valid) {
      $valid = $this->formDataValidator->isValid($value);
      $this->errors = $this->formDataValidator->getMessages();
    } else {
      $this->errors = $this->whitelistValidator->getMessages();
    }
    return $valid;
  }

  public function getMessages(): MessageManager {
    return $this->errors;
  }

}
