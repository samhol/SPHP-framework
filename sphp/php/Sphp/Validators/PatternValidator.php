<?php

/**
 * PatternValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

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

  /**
   * `ID` for error message describing values not matching a given regular expression
   */
  const NOT_MATCH = '_regex_';

  /**
   * regular expression pattern to validate against
   *
   * @var string
   */
  private $pattern = "//";

  /**
   * Constructs a new instance
   *
   *  **Note:** If the validable value matches the pattern => the validated
   *  data is valid.
   *
   * @param string|null $pattern regular expression pattern to validate against
   * @param string $errorMessage error message corresponding to the pattern
   */
  public function __construct(string $pattern = null, string $errorMessage = 'Invalid pattern given') {
    parent::__construct('Invalid type given. String, integer or float expected');
    if ($pattern !== null) {
      $this->setPattern($pattern);
    }
    $this->setMessageTemplate(self::NOT_MATCH, $errorMessage);
  }

  /**
   * Sets a regular expression patterns to test.
   * **Notes:** If all of the patterns is a matches => the cheked string is valid
   *
   *  **Note:** If the validable value matches the pattern => the validated
   *  data is valid.
   *
   * @param  string $pattern regular expression pattern to validate against
   * @return $this for a fluent interface
   */
  public function setPattern(string $pattern) {
    $this->pattern = $pattern;
    return $this;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    if (!is_string($value) && !is_int($value) && !is_float($value)) {
      //echo 'Invalid type given. String, integer or float expected';
      $this->error(self::INVALID);
      return false;
    }
    if (!Strings::match($value, $this->pattern)) {
      //echo $value . $this->pattern;
      $this->error(self::NOT_MATCH);
      return false;
    }
    return true;
  }

}
