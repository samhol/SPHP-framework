<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
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
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Regex extends AbstractValidator {

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
   * Constructor
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
    $this->errors()->setTemplate(self::NOT_MATCH, $errorMessage);
  }

  /**
   * Sets a regular expression patterns to test.
   * **Notes:** If all of the patterns is a matches => the checked string is valid
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
      $this->errors()->appendErrorFromTemplate(self::INVALID);
      return false;
    }
    if (!Strings::match($value, $this->pattern)) {
      //echo $value . $this->pattern;
      $this->errors()->appendErrorFromTemplate(self::NOT_MATCH);
      return false;
    }
    return true;
  }

}
