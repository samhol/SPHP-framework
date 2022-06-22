<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Reflection\Utils;

use Sphp\Stdlib\BitMask;

/**
 * The PHPWord class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PHPWord {

  /**
   * PHP keyword flag
   */
  public const KEYWORD = 0b00000000000001;
  public const OOP = 0b00000000000010;
  public const RESERVED_WORD = 0b00000000000100;
  public const SOFT_RESERVED_WORD = 0b00000000001000;
  public const MAGIC_METHOD = 0b00000000100010;
  public const MAGIC_CONST = 0b00000000000101;
  public const TYPE = 0b10000000000000;
  public const PRIMITIVE_TYPE = 0b11000000000100;
  public const OOP_TYPE = 0b11000000000010;
  public const PSEUDO_TYPE = 0b10100000000000;
  public const PREDEFINED_VAR = 0b00010000000000;
  public const OPERATOR = 0b00000010000000;
  public const LOGIGAL_OPERATOR = 0b00000110000000;
  public const CONTROL_STRUCTURE = 0b00000001000001;

  private string $name;
  private BitMask $type;

  public function __construct(string $name, int $type) {
    $this->name = $name;
    $this->type = new BitMask($type);
  }

  public function __destruct() {
    unset($this->type);
  }

  public function __toString(): string {
    return $this->name;
  }

  public function getName(): string {
    return $this->name;
  }

  public function getBitMask(): BitMask {
    return $this->type;
  }

  public function getType(): int {
    return $this->type->toInt();
  }

  public function is(int $type): bool {
    return $this->type->contains($type);
  }

  public function isOop(): bool {
    return $this->type->contains(self::OOP);
  }

  public function isVariable(): bool {
    return $this->is(self::PREDEFINED_VAR);
  }

  public function isKeyword(): bool {
    return $this->is(self::KEYWORD);
  }

  public function isControlStructure(): bool {
    return $this->is(self::CONTROL_STRUCTURE);
  }

  public function isOopKeyword(): bool {
    return $this->is(PHPWord::OOP | PHPWord::KEYWORD);
  }

  public function isPrimitiveTypeName(): bool {
    return $this->is(self::PRIMITIVE_TYPE);
  }

  public function isPseudoTypeName(): bool {
    return $this->is(self::PSEUDO_TYPE);
  }

  public function isTypeName(): bool {
    return $this->is(self::TYPE);
  }

  /**
   * Checks if the word value is magic method name
   * 
   * @return bool true if magic method name, false otherwise
   */
  public function isMagicMethodName(): bool {
    return $this->is(self::MAGIC_METHOD);
  }

  /**
   * Checks if the word is magic constant name
   * 
   * @return bool true if magic constant name, false otherwise
   */
  public function isMagicConstantName(): bool {
    return $this->is(self::MAGIC_CONST);
  }

  /**
   * Checks if given value is a logical operator name
   * 
   * @return bool true if given value is a logical operator name, false otherwise
   * @see https://www.php.net/manual/en/language.operators.logical.php PHP Logical Operators
   */
  public function isLogicalOperator(): bool {
    return $this->is(self::LOGIGAL_OPERATOR);
  }

}
