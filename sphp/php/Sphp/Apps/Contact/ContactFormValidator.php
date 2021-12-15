<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Contact;

use Sphp\Validators\FormValidator;
use Sphp\Validators\Whitelist;
use Sphp\Validators\ValidatorChain;
use Sphp\Validators\NotEmpty;
use Sphp\Validators\ErrorMessages;

/**
 * Class ContactFormValidator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ContactFormValidator implements \Sphp\Validators\Validator {

  /**
   * @var FormValidator;
   */
  private $formDataValidator;

  /**
   * @var Whitelist;
   */
  private $whitelistValidator;

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
    $this->formDataValidator = new FormValidator();
    $this->formDataValidator->setValidator('name', $this->createNameValidator());
    $this->formDataValidator->setValidator('email', $this->createEmailValidator());
    $this->formDataValidator->setValidator('phone', $this->createPhonenumberValidator());
    $this->formDataValidator->setValidator('message', $this->createMessageValidator());
  }

  private function createNameValidator(): ValidatorChain {
    $chain = new ValidatorChain(true);
    $chain->notEmpty(NotEmpty::STRING_TYPE, 'Nimi on pakollinen');
    $chain->regex("/[a-zåäö]+/", 'Nimessä on oltava kirjaimia');
    return $chain;
  }

  private function createMessageValidator(): ValidatorChain {
    $chain = new ValidatorChain(true);
    $chain->notEmpty(NotEmpty::STRING_TYPE, 'Viesti on pakollinen');
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
    $chain->notEmpty(NotEmpty::STRING_TYPE, 'Puhelinnumero on pakollinen');
    $chain->regex("/^([\+]?[0-9 ]{5,20})$/", 'Virheellinen puhelinnumero')->skip('');
    return $chain;
  }

  public function getInputErrors(): \Sphp\Validators\ErrorMessages {
    return $this->formDataValidator->errors();
  }

  public function isValid($value): bool {
    //echo '<pre>';
    //print_r($_POST);
    $this->errors = new \Sphp\Validators\ErrorMessages();
    $valid = $this->whitelistValidator->isValid($value);
    if ($valid) {
      $valid = $this->formDataValidator->isValid($value);
      $this->errors = $this->formDataValidator->errors();
    } else {
      $this->errors = $this->whitelistValidator->errors();
    }
    return $valid;
  }

  public function errors(): ErrorMessages {
    return $this->errors;
  }

  public function errorsToArray(): array {
    return $this->errors()->toArray();
  }

  public function getErrors(): \Sphp\Validators\MessageManager {
    
  }

}
