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
 * Validates data against expected value
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Identical extends AbstractValidator {

  public const NOT_IDENTICAL = 'NOT_IDENTICAL';

  /**
   * the token to validate against
   */
  private mixed $token;
  private bool $strict = true;

  /**
   * Constructor
   *
   * @param mixed $token the haystack
   * @param string $error error message
   */
  public function __construct(mixed $token, string $error = 'Value and the token does not match') {
    parent::__construct($error);
    $this->setToken($token);
    $this->messages->setTemplate(self::NOT_IDENTICAL, $error);
  }

  public function __destruct() {
    unset($this->token);
    parent::__destruct();
  }

  /**
   * Returns the token to validate against
   * 
   * @return mixed $token the token used
   */
  public function getToken(): mixed {
    return $this->token;
  }

  /**
   * Sets the token to validate against
   *
   * @param  mixed $token the token used
   * @return $this for a fluent interface
   */
  public function setToken(mixed $token) {
    $this->token = $token;
    return $this;
  }

  /**
   * Checks whether the validation is strict 
   * 
   * @return bool true for strict validation and false otherwise
   */
  public function isStrict(): bool {
    return $this->strict;
  }

  /**
   * Sets whether the validation is strict 
   * 
   * @param  bool $strict true for strict validation and false otherwise
   * @return $this for a fluent interface
   */
  public function setStrict(bool $strict) {
    $this->strict = $strict;
    return $this;
  }

  public function isValid(mixed $value): bool {
    $this->setValue($value);
    $token = $this->getToken();
    $valid = false;
    if ($this->isStrict()) {
      $valid = $value === $token;
    } else {
      $valid = $value == $token;
    }
    if (!$valid) {
      $this->setError(self::INVALID);
    }
    return $valid;
  }

}
