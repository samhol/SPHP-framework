<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use Sphp\I18n\Message;

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
class StringFormatValidator extends AbstractValidator {

  /**
   * `ID` for error message describing parameters not matching a formatted string
   */
  const INVALID_FORMAT = '_format_';

  /**
   * regular expression pattern to validate against
   *
   * @var string
   */
  private $format;

  /**
   * Constructor
   *
   * @param string|null $format the format string to validate against
   * @param string|Message $errorMessage error message corresponding to the pattern
   */
  public function __construct(string $format, $errorMessage = 'Invalid number of parameters given') {
    parent::__construct('Invalid type given. String expected');
    $this->setFormat($format);
    $this->setMessageTemplate(self::INVALID_FORMAT, $errorMessage);
  }

  /**
   * Sets a format to test
   *
   * @param  string $format regular expression pattern to validate against
   * @return $this for a fluent interface
   */
  public function setFormat(string $format) {
    $this->format = $format;
    return $this;
  }

  public function isValid($arguments): bool {
    $this->setValue($arguments);
    if (preg_match_all("~%(?:(\d+)[$])?[-+]?(?:[ 0]|['].)?(?:[-]?\d+)?(?:[.]\d+)?[%bcdeEufFgGosxX]~", $this->format, $expected) > 0) {
      $expected = intval(max($expected[1], count(array_unique($expected[1]))));
      if (count((array) $arguments) >= $expected) {
        return true;
      }
    }
    $this->error(self::INVALID_FORMAT);
    return false;
  }

  public static function validate(string $format, array $arguments): bool {
    $validator = new Static($format);
    return $validator->isValid($arguments);
  }

}
