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
class Rule {

  /**
   * @var string 
   */
  private $sql;

  /**
   * @var array 
   */
  private $params = [];

  /**
   * 
   * @param string $sql
   * @param mixed $params
   */
  public function __construct(string $sql, $params = null) {
    if ($params === null) {
      $params = [];
    } else if (!is_array($params)) {
      $params = [$params];
    }
    $this->sql = $sql;
    $this->params = $params;
  }

  public function getParams(): array {
    return $this->params;
  }

  public function getSQL(): string {
    return $this->sql;
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
   * Appends a condition string to the container
   *
   * @param string|Conditions $statement the SQL statement defining the condition(s)
   * @param mixed|mixed[] $params values that are vulnerable to an SQL injection
   * @param  string $operation (`AND`, `OR`, `XOR`)
   * @return string the generated SQL condition
   */
  private function append($statement, array $params = null, $operation = "AND") {
    $this->logical($operation);
    if ($statement instanceof Conditions) {
      $this->where .= "(" . $statement->statementToString() . ")";
      $params = $statement->getParams();
    }
    if (is_string($statement)) {
      $this->where .= $statement;
    }
    if ($params !== null) {
      foreach ($params as $value) {
        $this->params[] = $value;
      }
    }
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
    $sql = [];
    foreach ($rules as $field => $value) {
      $sql[]= "$field = ?";
    }
    $sqlString = implode(" $separator ", $value);
    return $this->append($sqlString, );
  }

  /**
   * Adds an expression to the query to test the inequality of two given expressions or columns
   *
   * **Important!**
   * **ALWAYS SANITIZE ALL USER INPUTS!**
   *
   * @param  mixed $column the column
   * @param  mixed $value the value of the expression
   * @return self for a fluent interface
   */
  public static function isNot(string $column, $value): Rule {
    return new static("$column <> ?", $value);
  }

  /**
   * Adds an expression to the query to search for a specified pattern in a column
   *
   * **Important!**
   * **ALWAYS SANITIZE ALL USER INPUTS!**
   *
   * * Use the `%` sign to define wildcards (missing letters in the <var>$pattern</var>).
   * * The `%` sign can be used both before and after the pattern string.
   *
   * @param  string $column the column
   * @param  string $pattern pattern string
   * @return self for a fluent interface
   */
  public static function isLike($column, $pattern) {
    return new static($column, "LIKE", $pattern);
  }

  /**
   * Adds an expression to the query to search for a specified pattern in a column
   *
   * **Important!**
   * **ALWAYS SANITIZE ALL USER INPUTS!**
   *
   * * Use the `%` sign to define wildcards (missing letters in the <var>$pattern</var>).
   * * The `%` sign can be used both before and after the pattern string.
   *
   * @param  string $column the column
   * @param  string $pattern pattern string
   * @return self for a fluent interface
   */
  public static function isNotLike($column, $pattern) {
    return new static($column, "NOT LIKE", $pattern);
  }

  /**
   * Adds a SQL NOT IN Operator
   *
   * Determines whether a specified value does not belong to a given group.
   *
   * @param  string $column the column
   * @param  mixed[]|Query|Traversable $group value(s) of the group
   * @return self for a fluent interface
   */
  public static function isNotIn($column, $group) {
    return new static("$column NOT IN", $group);
  }

}
