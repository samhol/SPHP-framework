<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\ImageMap;

/**
 * Description of CoordinateAttribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
use Sphp\Html\Attributes\AbstractAttribute;
use Sphp\Html\Attributes\CollectionAttribute;
use Countable;
use Sphp\Stdlib\Strings;
use Sphp\Stdlib\Arrays;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Stdlib\Datastructures\Sequence;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

/**
 * An implementation of a multi value HTML attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CoordinateAttribute extends AbstractAttribute implements Countable {

  /**
   * stored individual values
   *
   * @var Sequence
   */
  private $sequence = [];

  /**
   * @var boolean
   */
  private $locked = false;

  /**
   * @var int|null 
   */
  private $minLength = 0;

  /**
   * @var int|null 
   */
  private $maxLength = \PHP_INT_MAX;

  /**
   * Constructor
   *
   * @param string $name the name of the attribute
   * @param array $options  the separator between individual values in sequence
   */
  public function __construct(string $name, array $options = []) {
    parent::__construct($name);
    $this->sequence = [];
    foreach ($options as $key => $value) {
      switch (strtolower($key)) {
        case 'minlength':
          $this->setMinLength((int) $value);
          break;
        case 'maxlength':
          $this->setMaxLength((int) $value);
          break;
        case 'default':
          $this->setDefault($value);
          break;
      }
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->sequence, $this->locked);
    parent::__destruct();
  }

  /**
   * Returns an array of unique values parsed from the input
   *
   * **Important:** Parameter <var>$raw</var> restrictions and rules
   * 
   * 1. A string parameter can contain a single atomic value
   * 2. An array can be be multidimensional
   * 3. Duplicate values are ignored
   *
   * @param  mixed $raw the value(s) to parse
   * @param  bool $validate
   * @return string[] separated atomic values in an array
   * @throws InvalidAttributeException if validation is set and the input is not valid
   */
  public function parse($raw, bool $validate = false): array {
    $parsed = [];
    if (is_string($raw)) {
      $parsed = explode(',', $raw);
    } else if (is_array($raw)) {
      $parsed = Arrays::flatten($raw);
    }
    if ($validate) {
      foreach ($parsed as $value) {
        if (!is_numeric($value)) {
          throw new InvalidAttributeException("Invalid attribute value '$value'");
        }
      }
    }
    return $parsed;
  }

  private function isValidLength(): bool {
    $length = count($this->sequence);
    return $length >= $this->minLength && $length <= $this->maxLength;
  }

  /**
   * 
   * @param int $maxLength
   * @return $this for a fluent interface
   */
  private function setMaxLength(int $maxLength = null) {
    $this->maxLength = $maxLength;
    return $this;
  }

  /**
   * 
   * @param  string|float $default
   * @return $this for a fluent interface
   */
  private function setDefault($default) {
    $this->default = $default;
    return $this;
  }

  /**
   * 
   * @param  int $position
   * @return boolean
   */
  private function isValidPosition(int $position): bool {
    $test = $position + 1;
    return $this->minLength <= $test && ($this->maxLength === null || $this->maxLength >= $test);
  }

  /**
   * Sets new atomic values to the attribute removing old non locked ones
   *
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A `string` parameter can contain multiple comma separated atomic values
   * 2. An `array` parameter can contain only one atomic value per array value
   * 3. Any numeric value is treated as a string value
   * 4. Stores only a single instance of every value (no duplicates)
   *
   * @param  scalar|scalar[] $values the values to set
   * @return $this for a fluent interface
   */
  public function set($values) {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException();
    }
    $this->clear();
    $parsed = $this->parse($values, true);
    if (!empty($parsed)) {
      $this->sequence = array_merge($this->sequence, $parsed);
    }
    return $this;
  }

  /**
   * Adds new atomic values to the attribute
   *
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A string parameter can contain multiple comma separated atomic values
   * 2. An array parameter can contain only one atomic value per array value
   * 3. Stores only a single instance of every value (no duplicates)
   *
   * @param  scalar|scalar[],... $values the values to add
   * @return $this for a fluent interface
   */
  public function append(...$values) {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException();
    }
    $parsed = $this->parse($values, true);
    if (!empty($parsed)) {
      $this->sequence = array_merge($this->sequence, $parsed);
    }
    return $this;
  }

  /**
   * Checks whether the attribute value is locked
   *
   * @return boolean true if the given values are locked and false otherwise
   */
  public function isProtected(): bool {
    return $this->locked;
  }

  /**
   * Locks the specified atomic values
   *
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A string parameter can contain multiple comma separated atomic values
   * 2. An array parameter can contain only one atomic value per array value
   * 3. Stores only a single instance of every value (no duplicates)
   *
   * @param  scalar|scalar[] $values the atomic values to lock
   * @return $this for a fluent interface
   */
  public function protect($values) {
    $this->locked = true;
    return $this;
  }

  public function clear() {
    if (!$this->isProtected()) {
      $this->sequence = [];
    }
    return $this;
  }

  public function getValue() {
    if (!empty($this->sequence)) {
      $output = implode(',', $this->sequence);
    } else {
      $output = $this->isDemanded();
    }
    return $output;
  }

  /**
   * Counts the number of the atomic values stored in the attribute
   *
   * @return int the number of the atomic values stored in the attribute
   */
  public function count(): int {
    return count($this->sequence);
  }

  public function toArray(): array {
    return [$this->getName() => $this->sequence];
  }

  public function getHtml(): string {
    $output = '';
    $value = $this->getValue();
    if ($value !== false) {
      $output .= $this->getName();
      if ($value !== true && !Strings::isEmpty($value)) {
        $strVal = $value;
        $output .= '="' . htmlspecialchars($strVal, ENT_COMPAT | ENT_HTML5) . '"';
      }
    }
    return $output;
  }

  /**
   * Sets an property name value pair
   *
   * **Note:** Replaces old mutable property value with the new one
   *
   * @param  string $position the name of the property
   * @param  scalar $value the value of the property
   * @return void
   * @throws InvalidAttributeException if the property name or value is invalid
   * @throws ImmutableAttributeException if the property is immutable
   */
  public function insert($position, $value) {
    if (!$this->isValidPosition($position)) {
      throw new InvalidAttributeException();
    } else if ($this->isProtected()) {
      throw new ImmutableAttributeException();
    }
    $this->sequence->insert($position, $value);
  }

}
