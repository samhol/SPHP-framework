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
class StringFormatValidator extends AbstractValidator {

  const NOT_MATCH = '_regex_';

  /**
   * regular expression pattern to validate against
   *
   * @var string
   */
  private $format;

  /**
   * Constructs a new instance
   *
   * @param string|null $format the format string to validate against
   * @param string|Message $errorMessage error message corresponding to the pattern
   */
  public function __construct(string $format, $errorMessage = 'Invalid number of parameters given') {
    parent::__construct('Invalid type given. String expected');
    $this->setFormat($format);
    $this->setMessageTemplate(self::NOT_MATCH, $errorMessage);
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

  public function isValid1($value): bool {
    $this->setValue($value);
    if (!is_string($value) && !is_int($value) && !is_float($value)) {
      //echo 'Invalid type given. String, integer or float expected';
      $this->error(self::INVALID);
      return false;
    }
    if (!Strings::match($value, $this->pattern)) {
      echo $value . $this->pattern;
      $this->error(self::NOT_MATCH);
      return false;
    }
    return true;
  }

  public function isValid($arguments): bool {
    $this->setValue($arguments);
    if (preg_match_all("~%(?:(\d+)[$])?[-+]?(?:[ 0]|['].)?(?:[-]?\d+)?(?:[.]\d+)?[%bcdeEufFgGosxX]~", $this->format, $expected) > 0) {
      $expected = intval(max($expected[1], count(array_unique($expected[1]))));
      if (count((array) $arguments) >= $expected) {
        return true;
      }
    }
    $this->error(self::NOT_MATCH);
    return false;
  }

  public static function validate(string $format, array $arguments): bool {
    $validator = new Static($format);
    return $validator->isValid($arguments);
  }

}
