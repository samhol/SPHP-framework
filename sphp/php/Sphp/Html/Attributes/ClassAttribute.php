<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use IteratorAggregate;
use Sphp\Stdlib\Strings;
use Sphp\Stdlib\Datastructures\Collection;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Traversable;

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
  private array $values = [];
  private CssClassParser $parser;
  private bool $required = false;

  /**
   * Constructor
   * 
   * @param string $name the name of the attribute
   * @param CssClassParser|null $parser
   */
  public function __construct(string $name = 'class', $value = null,?CssClassParser $parser = null ) {
    parent::__construct($name);
    if ($parser === null) {
      $parser = CssClassParser::singelton();
    }
    $this->parser = $parser;
    if($value !== null) {
      $this->setValue($value);
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->values, $this->parser);
  }

  public function forceVisibility() {
    $this->required = true;
    return $this;
  }

  public function isAlwaysVisible(): bool {
    return $this->required || $this->isProtected();
  }

  public function __toString(): string {
    $output = '';
    if ($this->isVisible()) {
      $output = $this->getName();
      if (!$this->isEmpty()) {
        $output .= '="' . implode(' ', array_keys($this->values)) . '"';
      } else {
        $output .= '=""';
      }
    }
    return $output;
  }

  public function isVisible(): bool {
    return $this->isAlwaysVisible() || !empty($this->values);
  }

  public function isEmpty(): bool {
    return empty($this->values);
  }

  /**
   * Sets new atomic values to the attribute removing old non locked ones
   *
   * **Important:** Parameter `$values` restrictions and rules
   * 
   * 1. A string parameter can contain multiple class names separated by spaces
   * 2. An array can be be multidimensional
   * 3. Duplicate values are ignored
   *
   * @param  string|string[] ...$values the values to set
   * @return $this for a fluent interface
   */
  public function setValue($values) {
    $this->clear();
    $this->add((string) $values);
    return $this;
  }

  /**
   * Adds new atomic values to the attribute
   *
   * **Important:** Parameter ´$values´ restrictions and rules
   * 
   * 1. A string parameter can contain multiple class names separated by spaces
   * 2. Duplicate values are ignored
   *
   * @param  string ...$values the values to add
   * @return $this for a fluent interface
   */
  public function add(string ...$values) {
    $parsed = $this->parser->parse($values);
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
   * 1. A string parameter can contain multiple class names separated by spaces
   * 3. Duplicate values are ignored
   *
   * @param  null|string|string[] ...$values optional atomic values to check
   * @return bool true if the given values are locked and false otherwise
   */
  public function isProtected(string ...$values): bool {
    if (count($values) === 0) {
      return in_array(true, $this->values);
    } else {
      $locked = false;
      //$values = $this->parser->parse($values);
      foreach ($this->parser->parse($values) as $class) {
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
   * 1. A string parameter can contain multiple class names separated by spaces
   * 2. An array can be be multidimensional array of atomic string values
   * 3. Duplicate values are ignored
   *
   * @param  null|string|string[] ...$content the atomic values to lock
   * @return $this for a fluent interface
   */
  public function protectValue(string ...$values) {
    foreach ($this->parser->parse($values, true) as $class) {
      $this->values[$class] = true;
    }
    return $this;
  }

  /**
   * Removes given atomic values
   *
   * <strong>NOTE:</strong> A string parameter can contain multiple comma separated class names 
   * 
   * @param  string ...$values the atomic values to remove
   * @return $this for a fluent interface
   * @throws ImmutableAttributeException if any of the given values is immutable
   */
  public function remove(string ...$values) {
    foreach ($this->parser->parse($values) as $class) {
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
      $this->values = array_filter($this->values, function ($locked) {
        return $locked;
      });
    }
    return $this;
  }

  /**
   * Determines whether the given atomic values exists
   *  
   * <strong>NOTE:</strong> A string parameter can contain multiple comma separated class names 
   *
   * @param  string ...$value the atomic values to search for
   * @return bool true if the given atomic values exists
   */
  public function contains(string ...$value): bool {
    $exists = false;
    foreach ($this->parser->parse($value) as $class) {
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
      $value = null;
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

  /**
   * 
   * @param  callable $filter
   * @return $this for a fluent interface
   */
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
   * @return $this for a fluent interface
   */
  public function contaisPattern(string $pattern): bool {
    $contains = false;
    foreach ($this->toArray() as $class) {
      if (Strings::match($class, $pattern)) {
        $contains = true;
        break;
      }
    }
    return $contains;
  }

  /**
   * 
   * @param  string $pattern
   * @return $this for a fluent interface
   */
  public function removePattern(string $pattern) {
    $filter = function ($value) use ($pattern) {
      return !Strings::match($value, $pattern);
    };
    $this->filter($filter);
    return $this;
  }

  /**
   * Returns an external iterator
   *
   * @return Traversable<int, string> external iterator
   */
  public function getIterator(): Traversable {
    return new Collection(array_keys($this->values));
  }

}
