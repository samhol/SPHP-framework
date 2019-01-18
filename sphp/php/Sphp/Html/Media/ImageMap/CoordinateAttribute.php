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
use Sphp\Stdlib\Datastructures\Arrayable;
use Countable;
use Sphp\Stdlib\Strings;
use Sphp\Stdlib\Arrays;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Stdlib\Datastructures\Sequence;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;

/**
 * An implementation of a multi value HTML attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CoordinateAttribute extends AbstractAttribute implements Countable, Arrayable {

  /**
   * stored individual coordinates
   *
   * @var int[]
   */
  private $coordinates = [];

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
   * @param array $lengthRule  the separator between individual values in sequence
   */
  public function __construct(string $name, $lengthRule = null) {
    parent::__construct($name);
    $this->coordinates = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->coordinates, $this->locked);
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
   * @return string[] separated atomic values in an array
   * @throws InvalidArgumentException if the raw input is not valid
   */
  public function parse($raw): array {
    $thrower = ErrorToExceptionThrower::getInstance(InvalidArgumentException::class);
    $thrower->start();
    $parsed = [];
    $f = function($scalar) {
      $trimmed = trim($scalar);
      if (!is_numeric($trimmed)) {
        throw new InvalidArgumentException("Invalid individual coordinate value: $trimmed");
      }
      return (int) $trimmed;
      ;
    };
    if ($raw === null || is_bool($raw) || (is_scalar($raw) && Strings::isBlank("$raw"))) {
      $parsed = [];
    } else if (is_numeric($raw)) {
      $parsed = [(int) $raw];
    } else if (is_string($raw)) {
      $parsed = array_map($f, explode(',', $raw));
    } else if (is_array($raw)) {
      foreach ($raw as $value) {
        if (!is_int($value)) {
          throw new InvalidArgumentException("Invalid individual coordinate type:" . gettype($scalar) . " (integer required)");
        }
      }
      $parsed = array_map($f, Arrays::flatten($raw));
    } else {
      throw new InvalidArgumentException("Invalid attribute type:" . gettype($raw));
    }
    $thrower->stop();
    return $parsed;
  }

  private function isValidLength(): bool {
    $length = count($this->coordinates);
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
   * **Correct:** Parameter <var>$values</var> values
   * 
   * 1. A `string` containing comma separated coordinates
   * 2. An `array` of coordinates as integers
   * 3. Any numeric value is treated as a string value
   * 4. Stores only a single instance of every value (no duplicates)
   *
   * @param  int[]|...scalar $values the values to set
   * @return $this for a fluent interface
   */
  public function setValue($values) {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException();
    }
    $this->clear();
    if (func_num_args() > 1) {
      $parsed = $this->parse(func_get_args());
    } else {
      $parsed = $this->parse($values);
    }
    $this->coordinates = $parsed;
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
  public function protectValue($values) {
    $this->locked = true;
    return $this;
  }

  public function clear() {
    if (!$this->isProtected()) {
      $this->coordinates = [];
    }
    return $this;
  }

  public function getValue() {
    if (!empty($this->coordinates)) {
      $output = implode(',', $this->coordinates);
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
    return count($this->coordinates);
  }

  public function toArray(): array {
    return [$this->getName() => $this->coordinates];
  }

  /**
   * Returns the coordinates as an array
   * 
   * @return int[] the coordinates as an array
   */
  public function getCoordinates(): array {
    return $this->coordinates;
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
    $this->coordinates->insert($position, $value);
  }

}
