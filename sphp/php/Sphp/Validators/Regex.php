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
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
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
   * @var mixed
   */
  private $skipped = [];

  /**
   * Constructor
   *
   *  **Note:** If the validable value matches the pattern => the validated
   *  data is valid.
   *
   * @param string|null $pattern regular expression pattern to validate against
   * @param string $errorMessage error message corresponding to the pattern
   */
  public function __construct(string $pattern, string $errorMessage = 'Invalid pattern given') {
    parent::__construct('Value of %s type given. String, integer or float expected'); 
    $this->pattern = $pattern;
    $this->errors()->setTemplate(self::NOT_MATCH, $errorMessage);
  }

  public function skip(...$value) {
    $this->skipped = $value;
    return $this;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    if (in_array($value, $this->skipped)) {
      return true;
    }
    if (!is_string($value) && !is_int($value) && !is_float($value)) {
      //echo 'Invalid type given. String, integer or float expected';
      $this->errors()->appendErrorFromTemplate(self::INVALID, [gettype($value)]);
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
