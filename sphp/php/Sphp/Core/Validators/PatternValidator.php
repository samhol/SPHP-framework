<?php

/**
 * PatternValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Validators;

use Sphp\Core\Gettext\Message;
use Sphp\Core\Types\Strings;

/**
 * Class validates a a string against a regular expression pattern
 *
 *  **Note:** If the validable value matches the pattern => the validated
 *  data is valid.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PatternValidator extends AbstractOptionalValidator {

  /**
   * regular expression pattern to validate against
   *
   * var string[]
   */
  private $pattern = "//";

  /**
   * error message corresponding to the pattern
   *
   * var Message
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
   * @return self for PHP Method Chaining
   */
  public function setPattern($pattern, $errorMessage = "Please insert a correct value") {
    $this->pattern = $pattern;
    if (!($errorMessage instanceof Message)) {
      $errorMessage = new Message($errorMessage);
    }
    $this->errorMessage = $errorMessage;
    return $this;
  }

  /**
   * Validates the value against given regular expression patterns.
   *
   *  **Note:** If the validable value matches the pattern => the validated
   *  data is valid.
   *
   * @param  scalar $value the data to validate
   */
  protected function executeValidation($value) {
    $string = Strings::toString($value);
    if (!Strings::match($string, $this->pattern)) {
      $this->addErrorMessage($this->errorMessage);
    }
  }

}
