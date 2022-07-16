<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Ecommerce\Validators;

use Sphp\Validators\Validator;
use Sphp\Validators\MapValidator;
use Sphp\Validators\Whitelist;
use Sphp\Validators\ValidatorChain;
use Sphp\Validators\NotEmpty;
use Sphp\Validators\MessageManager;
use Sphp\Security\CRSFToken;

/**
 * The ProductDataValidator class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ProductDataValidator implements Validator {

  /**
   * @var FormValidator;
   */
  private $formDataValidator;
  private Whitelist $whitelistValidator;

  /**
   * @var array
   */
  private $errors = [];

  public function __construct() {
    $this->whitelistValidator = new Whitelist([
        'count',
        'title',
        'id',
        'cat',
        'price',
        'product-token',
        'description',
        'attrs'],
            'Lomake sisältää virheitä');
    $this->formDataValidator = new MapValidator();
    $this->formDataValidator->setValidator('title', $this->createNameValidator());
  }

  private function createNameValidator(): ValidatorChain {
    $chain = new ValidatorChain(true);
    $chain->notEmpty(NotEmpty::STRING_TYPE, 'Product title is required');
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

  public function getInputErrors(): MessageManager {
    return $this->formDataValidator->getMapMessages();
  }

  public function isValid(mixed $value): bool {
    //echo '<pre>';
    //print_r($_POST);
    $valid = true;
    $this->errors = new MessageManager();
    $tokenInput = new CRSFToken();
    if (!$this->whitelistValidator->isValid($value)) {
      $this->errors = $this->whitelistValidator->getMessages();
      $valid = false;
    } else if (!$tokenInput->verifyInputToken('product-token', INPUT_POST)) {
      $this->errors->append('Session has expired or failed');
      echo 'token fail';
      $valid = false;
    } else if (!$this->formDataValidator->isValid($value)) {
      $this->errors = $this->formDataValidator->getMapMessages();
      $valid = false;
    }
    return $valid;
  }

  public function getMessages(): MessageManager {
    return $this->errors;
  }

}
