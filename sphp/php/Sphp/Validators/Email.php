<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

/**
 * Validates a value as an email address
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Email extends AbstractValidator {

  /**
   * Constructor
   * 
   * @param string $errorMessage
   */
  public function __construct(string $errorMessage = 'Email address is invalid') {
    parent::__construct($errorMessage);
  }

  public function isValid($value): bool {
    $this->setValue($value);
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
      $this->errors()->appendErrorFromTemplate(static::INVALID);
      return false;
    }
    return true;
  }

}
