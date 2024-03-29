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
  const NOT_MATCH = 'NOT_MATCH';

  /**
   * regular expression pattern to validate against 
   */
  private string $pattern = "//";
  private array $skipped = [];

  /**
   * Constructor
   *
   *  **Note:** If the validable value matches the pattern => the validated
   *  data is valid.
   *
   * @param string $pattern regular expression pattern to validate against
   * @param string $errorMessage error message corresponding to the pattern
   */
  public function __construct(string $pattern, string $errorMessage = 'Invalid pattern given') {
    parent::__construct('Value of %s type given. String, integer or float expected');
    $this->pattern = $pattern;
    $this->messages->setTemplate(self::NOT_MATCH, $errorMessage);
    $this->messages->setTemplate(self::INVALID, 'Value of :type type given. String, integer or float expected');
  }

  public function skip(mixed ...$value) {
    $this->skipped = $value;
    return $this;
  }

  public function isValid(mixed $value): bool {
    $this->setValue($value);
    if (in_array($value, $this->skipped, true)) {
      return true;
    }
    if (!is_string($value) && !is_int($value) && !is_float($value)) {
      //echo 'Invalid type given. String, integer or float expected';
      $this->setError(self::INVALID);
      return false;
    }
    if (!Strings::match((string) $value, $this->pattern)) {
      //echo $value . $this->pattern;
      $this->setError(self::NOT_MATCH);
      return false;
    }
    return true;
  }

}
