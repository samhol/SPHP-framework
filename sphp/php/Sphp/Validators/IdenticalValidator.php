<?php

/**
 * InArrayValidator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

/**
 * Validates string length
 *
 *  Validates the length of the given string
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
   */
  public function __construct($token, $errormessage = "Value and the token does not match") {
    parent::__construct($errormessage);
    $this->setToken($token);
  }

  public function __destruct() {
    unset($this->token);
    parent::__destruct();
  }

  public function getToken() {
    return $this->token;
  }

  /**
   * Sets the range of the valid string length
   *
   * @param mixed[] $token the haystack
   * @return $this for a fluent interface
   */
  public function setToken($token) {
    $this->token = $token;
    return $this;
  }

  public function isStrict(): bool {
    return $this->strict;
  }

  /**
   * 
   * @param  boolean $strict
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
