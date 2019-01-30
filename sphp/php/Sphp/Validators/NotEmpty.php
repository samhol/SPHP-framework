<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
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
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class NotEmpty extends AbstractValidator {

  const ANY_TYPE = 0b0;
  const STRING_TYPE = 0b1;
  const SCALAR_TYPE = 0b10;
  const ARRAY_TYPE = 0b100;
  const COUNTABLE_TYPE = 0b1000;
  const TRAVERSABLE_TYPE = 0b10000;

  private $type = self::ANY_TYPE;

  /**
   * Constructor
   *
   * @param int $type
   * @param string $message
   */
  public function __construct(int $type = self::ANY_TYPE, string $message = 'Value is empty') {
    parent::__construct($message);
    $this->setType($type);
  }

  public function setType(int $type) {
    $this->type = $type;
    return $this;
  }

  protected function isValidType($value): bool {
    $valid = true;
    if ($this->type === self::ANY_TYPE) {
      return true;
    }
    if ($this->type === self::STRING_TYPE) {
      $valid = is_string($value);
    }if ($this->type === self::ARRAY_TYPE) {
      $valid = is_array($value);
    }if ($this->type === self::TRAVERSABLE_TYPE) {
      $valid = $value instanceof \Traversable;
    }if ($this->type === self::COUNTABLE_TYPE) {
      $valid = is_array($value) || $value instanceof \Countable;
    }
    if (!$valid) {
      $this->errors()->appendErrorFromTemplate(self::INVALID);
    }
    return $valid;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    $valid = true;
    if (!$this->isValidType($value)) {
      return false;
    }
    if ($value === null) {
      $valid = false;
    } else if (is_string($value)) {
      $valid = $value !== '';
    } else if (is_array($value)) {
      $valid = !empty($value);
    } else if ($this->type === self::TRAVERSABLE_TYPE || $value instanceof \Traversable) {
      $valid = count(iterator_to_array($value)) > 0;
    } else if ($this->type === self::COUNTABLE_TYPE || $value instanceof \Countable) {
      $valid = count($value) > 0;
    }
    if (!$valid) {
      $this->errors()->appendErrorFromTemplate(self::INVALID);
    }
    return $valid;
  }

}
