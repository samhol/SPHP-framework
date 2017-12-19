<?php

/**
 * IdenticalValidator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

/**
 * Validates data against expected value
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class IdenticalValidator extends AbstractValidator {

  /**
   * maximum length of the valid string
   *
   * @var mixed
   */
  private $token;

  /**
   * @var boolean 
   */
  private $strict = true;

  /**
   * Constructs a new validator
   *
   * @param mixed $token the haystack
   * @param string $error error message
   */
  public function __construct($token, string $error = 'Value and the token does not match') {
    parent::__construct($error);
    $this->setToken($token);
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
  public function getToken() {
    return $this->token;
  }

  /**
   * Sets the token to validate against
   *
   * @param  mixed $token the token used
   * @return $this for a fluent interface
   */
  public function setToken($token) {
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
   * @param  boolean $strict true for strict validation and false otherwise
   * @return $this for a fluent interface
   */
  public function setStrict(bool $strict) {
    $this->strict = $strict;
    return $this;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    $token = $this->getToken();
    $valid = false;
    if ($this->isStrict()) {
      $valid = $this->getValue() === $token;
    } else if (is_object($value) && is_object($token)) {
      $valid = $value == $token;
    } else if (!is_object($value) && !is_object($token)) {
      $valid = $value == $token;
    }
    if (!$valid) {
      $this->error(self::INVALID);
    }
    return $valid;
  }

}
