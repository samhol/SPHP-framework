<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use IteratorAggregate;
use Sphp\Stdlib\Strings;
use Sphp\Stdlib\Arrays;
use Sphp\Stdlib\Datastructures\Collection;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * An implementation of CSS class attribute
 * 
 * The class attribute specifies one or more class names for an HTML element
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ClassAttribute extends AbstractAttribute implements IteratorAggregate, CollectionAttribute {

  /**
   * stored individual classes
   *
   * @var string[]
   */
  private $values = [];

  /**
   * Constructor
   * 
   * @param string $name the name of the attribute
   */
  public function __construct(string $name = 'class') {
    parent::__construct($name);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->values);
  }

  public function __toString(): string {
    $output = '';
    if ($this->isVisible()) {
      $output .= $this->getName();
      if (!$this->isEmpty()) {
        $output .= '="' . implode(' ', array_keys($this->values)) . '"';
      }
    }
    return $output;
  }

  /**
   * Returns an array of unique CSS class values parsed from the input
   *
   * **Important:** Parameter <var>$raw</var> restrictions and rules
   * 
   * 1. A string parameter can contain a single atomic value
   * 2. An array can be be multidimensional
   * 3. Duplicate values are ignored
   *
   * @param  mixed $raw the value(s) to parse
   * @param  bool $validate
   * @return string[] separated unique atomic values in an array
   * @throws InvalidAttributeException if validation is set and the input is not valid
   */
  protected function parse($raw, bool $validate = false): array {
    $parsed = [];
    if (is_array($raw)) {
      $flat = Arrays::flatten($raw);
      foreach ($flat as $item) {
        if (!is_string($item)) {
          throw new InvalidArgumentException('Invalid attribute value given');
        }
        $parsed = array_merge($parsed, $this->parseStringToArray($item));
      }
      //$vals = array_filter($parsed, 'is_string');
    } else if (is_string($raw)) {
      $parsed = $this->parseStringToArray($raw);
    }
    if ($validate) {
      foreach ($parsed as $value) {
        if (!$this->isValidAtomicValue($value)) {
          throw new InvalidArgumentException("Invalid attribute value '$value'");
        }
      }
    }
    return array_unique($parsed);
  }

  protected function parseStringToArray(string $subject): array {
    $result = preg_split('/[\s]+/', $subject, -1, \PREG_SPLIT_NO_EMPTY);
    if (!$result) {
      $result = [];
    }
    return $result;
  }

  protected function isValidAtomicValue($value): bool {
    if (!is_string($value)) {
      return false;
    }
    return preg_match("/^[_a-zA-Z]+[_a-zA-Z0-9-]*/", $value) === 1;
  }

  public function isVisible(): bool {
    return $this->isDemanded() || !empty($this->values);
  }

  public function isEmpty(): bool {
    return empty($this->values);
  }

  /**
   * Sets new atomic values to the attribute removing old non locked ones
   *
   * **Important:** Parameter `$values` restrictions and rules
   * 
   * 1. A string parameter can contain a single atomic value
   * 2. An array can be be multidimensional
   * 3. Duplicate values are ignored
   *
   * @param  string|string[] $values the values to set
   * @return $this for a fluent interface
   */
  public function setValue($values) {
    $this->clear();
    $this->add(func_get_args());
    return $this;
  }

  /**
   * Adds new atomic values to the attribute
   *
   * **Important:** Parameter ´$values´ restrictions and rules
   * 
   * 1. A string parameter can contain a single atomic value (a class)
   * 2. An array can be be multidimensional array of atomic string values
   * 3. Duplicate values are ignored
   *
   * @param  string|string[],... $values the values to add
   * @return $this for a fluent interface
   */
  public function add(...$values) {
    $parsed = $this->parse($values, true);
    foreach ($parsed as $class) {
      if (!isset($this->values[$class])) {
        $this->values[$class] = false;
      }
    }
    return $this;
  }

  /**
   * Checks whether the given atomic values are locked
   *
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A string parameter can contain a single atomic value
   * 2. An array can be be multidimensional
   * 3. Duplicate values are ignored
   *
   * @param  null|scalar|scalar[] $values optional atomic values to check
   * @return boolean true if the given values are locked and false otherwise
   */
  public function isProtected($values = null): bool {
    if ($values === null) {
      return in_array(true, $this->values);
    } else {
      $locked = false;
      $values = $this->parse(func_get_args());
      foreach ($values as $class) {
        $locked = isset($this->values[$class]) && $this->values[$class] === true;
        if (!$locked) {
          break;
        }
      }
      return $locked;
    }
  }

  /**
   * Locks the specified atomic values
   *
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A string parameter can contain a single atomic value (a class)
   * 2. An array can be be multidimensional array of atomic string values
   * 3. Duplicate values are ignored
   *
   * @param  scalar|scalar[] $content the atomic values to lock
   * @return $this for a fluent interface
   */
  public function protectValue($content) {
    foreach ($this->parse(func_get_args()) as $class) {
      $this->values[$class] = true;
    }
    return $this;
  }

  /**
   * Removes given atomic values
   *
   * **Important:** Parameter <var>$values</var> values (restrictions and rules)
   * 
   * 1. A string parameter can contain multiple comma separated atomic values
   * 2. An array parameter can contain only one atomic value per array value
   * 
   * @param  scalar|scalar[] $values the atomic values to remove
   * @return $this for a fluent interface
   * @throws ImmutableAttributeException if any of the given values is immutable
   */
  public function remove($values) {
    foreach ($this->parse(func_get_args()) as $class) {
      if (isset($this->values[$class])) {
        if ($this->values[$class] === false) {
          unset($this->values[$class]);
        } else {
          throw new ImmutableAttributeException("Value '$class' in '{$this->getName()}' attribute is immutable");
        }
      }
    }
    return $this;
  }

  public function clear() {
    if (!empty($this->values)) {
      $this->values = array_filter($this->values, function($locked) {
        return $locked;
      });
    }
    return $this;
  }

  /**
   * Determines whether the given atomic values exists
   *
   * **Important:** Parameter <var>$values</var> values (restrictions and rules)
   * 
   * 1. A string parameter can contain multiple comma separated atomic values
   * 2. An array parameter can contain only one atomic value per array value
   *
   * @param  scalar|scalar[],... $values the atomic values to search for
   * @return boolean true if the given atomic values exists
   */
  public function contains(...$values): bool {
    $needles = $this->parse($values);
    $exists = false;
    foreach ($needles as $class) {
      $exists = isset($this->values[$class]);
      if (!$exists) {
        break;
      }
    }
    return $exists;
  }

  /**
   * Determines whether the given atomic values exists
   *
   * **Important:** Parameter <var>$values</var> values (restrictions and rules)
   * 
   * 1. A string parameter can contain multiple comma separated atomic values
   * 2. An array parameter can contain only one atomic value per array value
   *
   * @param  string|string[],... $values the atomic values to search for
   * @return boolean true if the given atomic values exists
   */
  public function containsOneOf(...$values): bool {
    $needles = $this->parse($values);
    $exists = false;
    foreach ($needles as $class) {
      $exists = isset($this->values[$class]);
      if ($exists) {
        break;
      }
    }
    return $exists;
  }

  public function getValue() {
    if (!empty($this->values)) {
      $value = implode(' ', array_keys($this->values));
    } else {
      $value = $this->isDemanded();
    }
    return $value;
  }

  /**
   * Counts the number of the atomic values stored in the attribute
   *
   * @return int the number of the atomic values stored in the attribute
   */
  public function count(): int {
    return count($this->values);
  }

  public function toArray(): array {
    return array_keys($this->values);
  }

  public function filter(callable $filter) {
    $result = [];
    foreach ($this->values as $class => $locked) {
      if ($locked || $filter($class)) {
        $result[$class] = $locked;
      }
    }
    $this->values = $result;
    return $this;
  }

  /**
   * 
   * @param  string $pattern
   * @return string[]
   */
  public function parsePattern(string $pattern): array {
    return preg_grep($pattern, $this->toArray());
  }

  /**
   * 
   * @param string $pattern
   * @return $this
   */
  public function removePattern(string $pattern) {
    $filter = function($value) use ($pattern) {
      return !Strings::match($value, $pattern);
    };
    $this->filter($filter);
    return $this;
  }

  /**
   * 
   * @param string $pattern
   * @return $this
   */
  public function filterPattern(string $pattern) {
    $filter = function($value) use ($pattern) {
      return Strings::match($value, $pattern);
    };
    $this->filter($filter);
    return $this;
  }

  public function getIterator(): \Traversable {
    return new Collection(array_keys($this->values));
  }

}
