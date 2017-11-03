<?php

/**
 * MultiValueAttribute.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use IteratorAggregate;
use Sphp\Stdlib\Strings;
use Sphp\Stdlib\Arrays;
use Sphp\Html\Attributes\Utils\ClassAttributeUtils;
use Sphp\Stdlib\Datastructures\Collection;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Html\Attributes\Utils\Factory;

/**
 * An implementation of CSS class attribute
 * 
 * The class attribute  specifies one or more class names for an element
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ClassAttribute extends AbstractAttribute implements IteratorAggregate, MultiValueAttributeInterface {

  /**
   * stored individual classes
   *
   * @var scalar[]
   */
  private $values = [];

  /**
   * @var ClassAttributeUtils
   */
  private $filter;

  /**
   * Constructs a new instance
   * 
   * @param string $name the name of the attribute
   * @param ClassAttributeUtils|null $filter
   */
  public function __construct(string $name = 'class', ClassAttributeUtils $filter = null) {
    if ($filter === null) {
      $filter = Factory::instance()->getUtil(ClassAttributeUtils::class);
    }
    parent::__construct($name);
    $this->filter = $filter;
  }

  /**
   * Destroys the instance
   * 
   * The destructor method will be called as soon as there are no other references 
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->values, $this->filter);
    parent::__destruct();
  }

  public function getHtml(): string {
    $output = '';
    if ($this->isVisible()) {
      $output .= $this->getName();
      if (!$this->isEmpty()) {
        $output .= '="' . implode(' ', array_keys($this->values)) . '"';
      }
    }
    return $output;
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
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A string parameter can contain a single atomic value
   * 2. An array can be be multidimensional
   * 3. Duplicate values are ignored
   *
   * @param  string|string[] $values the values to set
   * @return $this for a fluent interface
   */
  public function set($values) {
    $this->clear();
    if (func_num_args() === 1 && is_string($values)) {
      $values = $this->filter->parseString($values);
    } else {
      $values = func_get_args();
    }
    $this->add($values);
    return $this;
  }

  /**
   * Adds new atomic values to the attribute
   *
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A string parameter can contain a single atomic value (a class)
   * 2. An array can be be multidimensional array of atomic string values
   * 3. Duplicate values are ignored
   *
   * @param  string|string[] $values the values to add
   * @return $this for a fluent interface
   */
  public function add(...$values) {
    $parsed = $this->filter->filter($values, true);
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
      if (func_num_args() === 1 && is_string($values)) {
        $values = $this->filter->parseString($values);
      } else {
        $values = $this->filter->filter(func_get_args());
      }
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
  public function protect($content) {
    if (func_num_args() === 1 && is_string($content)) {
      $content = $this->filter->parseString($content);
    } else {
      $content = $this->filter->filter(func_get_args());
    }
    //$arr = $this->filter->filter(func_get_args());
    foreach ($content as $class) {
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
    $arr = Arrays::flatten(func_get_args());
    foreach ($arr as $class) {
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
   * @param  scalar|scalar[] $values the atomic values to search for
   * @return boolean true if the given atomic values exists
   */
  public function contains($values): bool {
    $needles = $this->filter->filter($values);
    $exists = false;
    foreach ($needles as $class) {
      $exists = isset($this->values[$class]);
      if (!$exists) {
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

  public function filterPattern(string $pattern) {
    $filter = function($value) use ($pattern) {
      return Strings::match($value, $pattern);
    };
    $this->filter($filter);
    return $this;
  }

  public function getIterator(): \Traversable {
    return new Collection($this->toArray());
  }

}
