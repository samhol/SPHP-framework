<?php

/**
 * Rule.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

/**
 * Description of Rule
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-08-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Rules implements RuleInterface, \Iterator {

  /**
   * @var array 
   */
  private $rules;

  /**
   * 
   * @param string $sql
   * @param mixed $params
   */
  public function __construct() {
    
  }

  public function append(RuleInterface $rule, string $conn = 'AND') {
    if (!empty($this->rules)) {
      $this->rules[] = $conn;
    }
    $this->rules[] = $rule;
  }

  public function getParams(): ParameterContainerInterface {
    $params = new SequentialPDOParameters();
    foreach ($this as $part) {
      if ($part instanceof RuleInterface) {
        $params->appendParams($part->getParams()->toArray());
      }
    }
    return $params;
  }

  public function getSQL(): string {
    $output = '';
    foreach ($this->rules as $rule) {
      if ($rule instanceof Rules) {
        $output .= "($rule) ";
      } else {
        $output .= "$rule ";
      }
    }
    return trim($output);
  }

  public function __toString(): string {
    return $this->getSQL();
  }

  /**
   * Adds a condition to search for a given expression that holds a null value
   *
   * **Important!**
   * **ALWAYS SANITIZE ALL USER INPUTS!**
   *
   * @param  string $column the column
   * @return self for a fluent interface
   */
  public static function isNull(string $column): Rule {
    return new static("$column IS null");
  }

  /**
   * Adds a condition to search for a given expression that holds a null value
   *
   * @param  string $column the column
   * @return self for a fluent interface
   */
  public static function isNotNull(string $column): Rule {
    return new static("$column IS NOT NULL");
  }

  protected static function generateGroupSql($group) {
    if (is_array($group)) {
      $qMarks = array_fill(0, count($group), '?');
      return implode(', ', $qMarks);
    }
  }

  public static function isIn(string $column, $group) {
    $qMarks = static::generateGroupSql($group);
    return new static("$column IS IN ($qMarks)", $group);
  }

  public static function generateRule(string $column, string $operator, $expr): Rule {
    $op = strtoupper(trim($operator));
    $output = "`$column`";
    if ($expr === null) {
      if ($op == '=') {
        return static::isNull($column);
      } else if ($op == '<>' || $op == '!=') {
        return static::isNotNull($column);
      } else {
        throw new \Sphp\Exceptions\InvalidArgumentException("Illegal null comparison operator : '$operator'");
      }
    } else if (!is_array($expr)) {
      $expr = [$expr];
    }
    if ($op == 'IN' || $op == 'NOT IN') {
      $num = count($expr);
      if ($num > 0) {
        $format = "(" . str_repeat("?, ", $num - 1) . " ?)";
      } else {
        $format = "()";
      }
      return "$output $op $format";
    }
    return "$output $op ?";
  }

  public function equal(array $map, $op = 'AND') {
    $query = [];
    foreach ($map as $name => $value) {
      $query[] = "$name = :$name";
      $this->setParam($name, $value);
    }
    $q = implode(" $op ", $query);
    $this->where .= " ($q) ";
    return $this;
  }

  public function notEquals(array $map) {
    $query = [];
    foreach ($map as $name => $value) {
      $query[] = "$name <> :$name";
      $this->setParam($name, $value);
    }
    $q = implode(" AND ", $query);
    $this->where .= " ($q) ";
    return $this;
  }

  /**
   * Executes a bitwise operation to the column value pair and compares the result to a given parameter
   *
   * **NOTE! This method quotes automatically <var>$value</var>, <var>$result</var> inputs!**
   *
   * Values for parameter <var>$binOp</var>:
   *
   * * **`&`**: bitwise AND
   * * **`|`**, bitwise OR
   * * **`^`**: bitwise XOR
   * * **`~`**: invert bits
   * * **`<<`**: left shift
   * * **`>>`**: right shift
   *
   * @param  string|Query $column the column
   * @param  string $binOp Bitwise operand
   * @param  string|int|bool $value the value to bitwise compare to
   * @param  string $op logical operation
   * @param  string|int|bool $result the result value of the bitwise operation
   * @return self for a fluent interface
   */
  public function binaryOperationCompare($column, $binOp, $value, $op, $result) {
    return $this->andWhere("(BINARY(" . $column . ") " . $binOp . " BINARY(%s)) " . $op . " %s", array($value, $result));
  }

  /**
   * Adds an SQL condition by using logical OR as a conjunction
   *
   * @param  array $rules rules as field name => value pairs
   * @param  string $separator the logical operator between the comparisons
   * @return self for a fluent interface
   */
  public static function equals(array $rules, $separator = "AND") {
    foreach ($rules as $field => $value) {
      $this->append(Rule::is($field ,$value), $separator);
    }
    return $this;
  }


  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->rules);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->rules);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->rules);
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    reset($this->rules);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->rules);
  }

}
