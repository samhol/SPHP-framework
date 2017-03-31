<?php

/**
 * NotEmptyValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

use Sphp\Stdlib\Strings;
use Sphp\I18n\MessageTemplate;

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
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class NotEmptyValidator extends AbstractValidator {

  const IS_EMPTY = '_empty_';

  /**
   * Constructs a new validator
   *
   */
  public function __construct($type = 'scalar', $message = "Value is required and can't be empty") {
    parent::__construct();

    $this->setMessageTemplate(self::INVALID, new MessageTemplate($message));
  }

  public function isValid($value) {
    $this->setValue($value);
    $valid = true;
    if ($value === null) {
      $valid = false;
    } else if (is_array($value) && count($value) === 0) {
      $valid = false;
    } else if (Strings::isEmpty($value)) {
      $valid = false;
    }
    if (!$valid) {
      $this->createErrorMessage('Please insert a value');
    }
    return $valid;
  }

}
