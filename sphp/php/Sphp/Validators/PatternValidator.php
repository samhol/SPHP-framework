<?php

/**
 * PatternValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

use Sphp\I18n\Message;
use Sphp\Stdlib\Strings;

/**
 * Validates a a string against a regular expression pattern
 *
 *  **Note:** If the validable value matches the pattern => the validated
 *  data is valid.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PatternValidator extends AbstractValidator {

  const NOT_MATCH = '_regex_';

  /**
   * regular expression pattern to validate against
   *
   * @var string[]
   */
  private $pattern = "//";

  /**
   * error message corresponding to the pattern
   *
   * @var Message
   */
  private $errorMessage;

  /**
   * Constructs a new instance
   *
   *  **Note:** If the validable value matches the pattern => the validated
   *  data is valid.
   *
   * @param string|null $pattern regular expression pattern to validate against
   * @param string|Message $errorMessage error message corresponding to the pattern
   */
  public function __construct($pattern = null, $errorMessage = null) {
    parent::__construct();
    if ($pattern !== null) {
      $this->setPattern($pattern, $errorMessage);
    }
    if ($errorMessage !== null) {
      $this->setErrorMessage($errorMessage);
    }
  }

  /**
   * Sets a regular expression patterns to test.
   * **Notes:** If all of the patterns is a matches => the cheked string is valid
   *
   *  **Note:** If the validable value matches the pattern => the validated
   *  data is valid.
   *
   * @param string $pattern regular expression pattern to validate against
   * @param string|Message $errorMessage error message corresponding to the pattern
   * @return self for a fluent interface
   */
  public function setErrorMessage($errorMessage) {
    if (!($errorMessage instanceof Message)) {
      $errorMessage = new Message($errorMessage);
    }
    $this->errorMessage = $errorMessage;
    return $this;
  }

  /**
   * Sets a regular expression patterns to test.
   * **Notes:** If all of the patterns is a matches => the cheked string is valid
   *
   *  **Note:** If the validable value matches the pattern => the validated
   *  data is valid.
   *
   * @param string $pattern regular expression pattern to validate against
   * @return self for a fluent interface
   */
  public function setPattern($pattern) {
    $this->pattern = $pattern;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
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
