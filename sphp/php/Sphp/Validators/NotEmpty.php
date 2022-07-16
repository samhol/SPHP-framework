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
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class NotEmpty extends AbstractValidator {

  /**
   * Constructor
   * 
   * @param string $message
   */
  public function __construct(string $message = 'Value is empty') {
    parent::__construct($message);
  }

  public function isValid(mixed $value): bool {
    $this->setValue($value);
    $valid = true;
    if ($value === null) {
      $valid = false;
    } else if (is_array($value)) {
      $valid = $value !== [];
    } else if ($value instanceof \Traversable) {
      $valid = count(iterator_to_array($value)) > 0;
    } else if ($value instanceof \Countable) {
      $valid = count($value) > 0;
    } else if (is_string($value) || $value instanceof \Stringable) {
      $valid = !Strings::match((string) $value, '/^\s*$/');
    }
    if (!$valid) {
      $this->setError(self::INVALID);
    }
    return $valid;
  }

}
