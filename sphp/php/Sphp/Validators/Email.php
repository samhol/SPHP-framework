<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
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
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Email extends AbstractValidator {

  public const INVALID = 'Email address is invalid';

  /**
   * Constructor
   * 
   * @param string $errorMessage
   */
  public function __construct(string $errorMessage = 'Email address is invalid') {
    parent::__construct($errorMessage);
  }

  public function isValid(mixed $value): bool {
    $this->setValue($value);
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
      $this->setError(static::INVALID);
      return false;
    }
    return true;
  }

}
