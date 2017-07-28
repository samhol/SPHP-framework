<?php

/**
 * ConditionalStatement.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;

/**
 * Implements the conditions for statements in SQL
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @deprecated
 */
abstract class ConditionalStatement extends AbstractStatement {

  /**
   * the conditions in the WHERE part of the SELECT, UPDATE and INSERT queries
   *
   * @var Conditions
   */
  private $where;

  /**
   * Constructs a new instance
   *
   * @param PDO $db
   * @param Conditions $where
   */
  public function __construct(PDO $db, Conditions $where = null) {
    if ($where === null) {
      $this->where = new Conditions();
    } else {
      $this->where = $where;
    }
    parent::__construct(new PDORunner($db));
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->where);
    parent::__destruct();
  }

  /**
   * Sets The WHERE clause.
   *
   * The WHERE clause is used to filter records
   *
   * @param  Conditions $c
   * @return self for a fluent interface
   */
  public function setConditions(Conditions $c) {
    $this->where = $c;
    return $this;
  }

  /**
   * 
   * @param array $attributes
   */
  protected function appendAttributes(array $attributes) {
    $this->getPDORunner()->appendParams($attributes);
    return $this;
  }

  /**
   * Returns the WHERE conditions component
   *
   * **Important!**
   *
   * * **ALWAYS SANITIZE ALL USER INPUTS!**
   * * **If you are using multiple arguments; None of the arguments should be an array**
   *
   *  The WHERE clause includes a comparison predicate, which restricts the rows returned by the query.
   *  The WHERE clause eliminates all rows from the result set for which the comparison predicate does
   *  not evaluate to `true`.
   *
   * @return self for a fluent interface
   */
  public function where(string $field, string $operand, $value) {
    $this->compare($field, $operand, $value);
    return $this;
  }

  public function conditions() {
    return $this->where;
  }

  /**
   * Appends SQL conditions by using logical AND as a conjunction
   *
   * @param string|Conditions $statement SQL condition(s)
   * @return self for a fluent interface
   */
  public function andWhere(string $field, string $operand, $value) {
    foreach ($statements as $statement) {
      $this->where->andWhere($statement);
    }
    return $this;
  }

  /**
   * Appends SQL conditions by using logical OR as a conjunction
   *
   * @param string|Conditions $statement SQL condition(s)
   * @return self for a fluent interface
   */
  public function orWhere(... $statements) {
    foreach ($statements as $statement) {
      $this->where->orWhere($statement);
    }
    return $this;
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
   * Returns the SQL statement as a string
   *
   * @return string the SQL statement as a string
   */
  public function statementToString(): string {
    return $this->where->statementToString();
  }

  /**
   * Returns the generated SQL as a string
   *
   * @return string the generated SQL as a string
   */
  public function __toString(): string {
    return $this->statementToString();
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->where = clone $this->where;
    $this->params = Arrays::copy($this->params);
  }

  /**
   * Appends a conjunctive operator to the clause
   *
   * @param  string $operator (`AND`, `OR`, `XOR`)
   * @return self for a fluent interface
   */
  public function logical($operator) {
    if (!Strings::isEmpty($this->where) && !Strings::endsWith($this->where, [" OR ", " AND ", " XOR "])) {
      $op = strtoupper(trim($operator));
      $this->where .= " $op ";
    }
    return $this;
  }

  /**
   * Checks if there are any SQL conditions set
   *
   * @return boolean conditions are set
   */
  public function hasConditions() {
    return !Strings::isEmpty($this->where);
  }

  /**
   * Resets the specific part of the query or the entire query if no parameter is given
   *
   * @return self for a fluent interface
   */
  public function reset() {
    $this->where = [];
    $this->params = [];
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
  public function equals(array $rules, $separator = "AND") {
    $cond = new Conditions();
    foreach ($rules as $field => $value) {
      $cond->logical($separator)->compare($field, "=", $value);
    }
    return $this->append($cond, $rules, "AND");
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
  public function isNot($column, $value) {
    return $this->compare($column, "<>", $value);
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
  public function isLike($column, $pattern) {
    return $this->compare($column, "LIKE", $pattern);
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
  public function isNotLike($column, $pattern) {
    return $this->compare($column, "NOT LIKE", $pattern);
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
  public function isNull($column) {
    return $this->append("$column IS null", null);
  }

  /**
   * Adds a condition to search for a given expression that holds a null value
   *
   * @param  string $column the column
   * @return self for a fluent interface
   */
  public function isNotNull($column) {
    return $this->append("$column IS NOT null", null);
  }

  /**
   * Adds a SQL IN Operator
   *
   * Determines whether a specified value belongs to a given group.
   *
   * @param  string $column the column
   * @param  mixed[]|Query|Traversable $group value(s) of the group
   * @return self for a fluent interface
   */
  public function isIn($column, $group) {
    return $this->compare($column, "IN", $group);
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
  public function isNotIn($column, $group) {
    return $this->compare($column, "NOT IN", $group);
  }

  /**
   * Returns a new condition to compare a column to given value(s)
   *
   * **NOTE!<br> ALWAYS SANITIZE ALL VALUES THAT ARE FROM USER INPUTS!**
   *
   *  Values for parameter <var>$operator</var>:
   *
   * * `=`: equal
   * * `!=`, `<>`: not equal
   * * `<`: less than
   * * `<=`: less than or equal
   * * `>`: greater than
   * * `>=`: greater than or equal
   * * `LIKE`: `$column` is like the string pattern in the `$expr`
   * * `NOT LIKE`: `$column` is not like the pattern string given as `$expr`
   * * `IN`: `$column` is in the the group given in `$expr`
   * * `NOT IN`: `$column` is not in the the group given in `$expr`
   *
   *  For `$operator` values `LIKE` and `NOT LIKE` use the `%` sign to define
   *  wildcards (missing letters in the pattern). The `%` sign can be used
   *  both before and after the pattern.
   *
   * @param  string $column the column
   * @param  string $operator used comparison operator
   * @param  mixed $expr the value
   * @return self for a fluent interface
   * @throws SQLException
   */
  public function compare(string $column, string $operator, $expr, string $conjunction = 'AND') {
    $op = strtoupper(trim($operator));
    if ($expr === null) {
      if ($op == "=") {
        return $this->isNull($column);
      } else if ($op == "<>" || $op == "!=") {
        return $this->isNotNull($column);
      } else {
        throw new SQLException("Illegal null comparison operator : '$operator'");
      }
    } else if (!is_array($expr)) {
      $expr = [$expr];
    }
    if ($op == "IN" || $op == "NOT IN") {
      $num = count($expr);
      if ($num > 0) {
        $format = "(" . str_repeat("?, ", $num - 1) . " ?)";
      } else {
        $format = "()";
      }
      return $this->append($column . " " . $op . " " . $format, $expr);
    }
    return $this->append($column . " " . $op . " ?", $expr);
  }

}
