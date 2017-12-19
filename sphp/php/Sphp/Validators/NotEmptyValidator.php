<?php

/**
 * NotEmptyValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

/**
 * Validates that the field has a non empty value
 *
 * Values considered as empty in this validator:
 * 
 * * `$var;` (a variable declared, but without a value)
 * * `null`
 * *  empty `arrays`
 * 
 * all of the `string` values containing only following characters:	
 * 	
 * * "" an empty string
 * * " " (ASCII 32 (0x20)), an ordinary space.
 * * "\\t" (ASCII 9 (0x09)), a tab.
 * * "\\n" (ASCII 10 (0x0A)), a new line (line feed).
 * * "\\r" (ASCII 13 (0x0D)), a carriage return.
 * * "\\0" (ASCII 0 (0x00)), the NUL-byte.
 * * "\\x0B" (ASCII 11 (0x0B)), a vertical tab.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class NotEmptyValidator extends AbstractValidator {

  const IS_EMPTY = '_empty_';

  /**
   * Constructs a new validator
   *
   * @param string $message
   */
  public function __construct(string $message = "Value is empty") {
    parent::__construct($message);
  }

  public function isValid($value): bool {
    $this->setValue($value);
    $valid = true;
    if ($value === null) {
      $valid = false;
    } else if (is_array($value) && empty($value)) {
      $valid = false;
    } else if ($value === '') {
      $valid = false;
    }
    if (!$valid) {
      $this->error(self::INVALID);
    }
    return $valid;
  }

}
