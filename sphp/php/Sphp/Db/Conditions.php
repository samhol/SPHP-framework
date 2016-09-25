<?php

/**
 * Conditions.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db;

use Sphp\Core\Types\Arrays;
use Sphp\Core\Types\Strings;

/**
 * Class implements the content of the WHERE clause in SQL
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-04-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Conditions {

  /**
   * SQL condition(s)
   *
   * @var string
   */
  private $statement = "";

  /**
   * tested values queries etc..
   *
   * @var mixed[]
   */
  private $params = [];

  /**
   * Constructs a new instance
   *
   * @param string|Conditions $statement the SQL statement defining the condition(s)
   * @param mixed|mixed[] $params values that are vulnerable to an SQL injection
   */
  public function __construct($statement = null, array $params = null) {
    if ($statement !== null) {
      $this->append($statement, $params);
    }
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
      $this->statement .= "(" . $statement->statementToString() . ")";
      $params = $statement->getParams();
    }
    if (is_string($statement)) {
      $this->statement .= $statement;
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
  public function statementToString() {
    return $this->statement;
  }

  /**
   * Returns an array of values with as many elements as there are bound
   * parameters in the clause
   *
   * @return mixed|mixed[] values that are vulnerable to an SQL injection
   */
  public function getParams() {
    return $this->params;
  }

  /**
   * Returns the generated SQL as a string
   *
   * @return string the generated SQL as a string
   */
  public function __toString() {
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
    $this->statement = clone $this->statement;
    $this->params = Arrays::copy($this->params);
  }

  /**
   * Appends a conjunctive operator to the clause
   *
   * @param  string $operator (`AND`, `OR`, `XOR`)
   * @return self for PHP Method Chaining
   */
  public function logical($operator) {
    if (!Strings::isEmpty($this->statement) && !Strings::endsWith($this->statement, [" OR ", " AND ", " XOR "])) {
      $op = strtoupper(trim($operator));
      $this->statement .= " $op ";
    }
    return $this;
  }

  /**
   * Appends an SQL condition by using logical AND as a conjunction
   *
   * @param string|Conditions $statement SQL condition(s)
   * @param mixed|mixed[] $params values that are vulnerable to an SQL injection
   * @return self for PHP Method Chaining
   */
  public function andWhere($statement, array $params = null) {
    return $this->append($statement, $params, "AND");
  }

  /**
   * Appends an SQL condition by using logical OR as a conjunction
   *
   * @param string|Conditions $statement SQL condition(s)
   * @param mixed|mixed[] $params values that are vulnerable to an SQL injection
   * @return self for PHP Method Chaining
   */
  public function orWhere($statement, array $params = null) {
    return $this->append($statement, $params, "OR");
  }

  /**
   * Checks if there are any SQL conditions set
   *
   * @return boolean conditions are set
   */
  public function hasConditions() {
    return !Strings::isEmpty($this->statement);
  }

  /**
   * Resets the specific part of the query or the entire query if no parameter is given
   *
   * @return self for PHP Method Chaining
   */
  public function reset() {
    $this->statement = [];
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
   * @return self for PHP Method Chaining
   */
  public function binaryOperationCompare($column, $binOp, $value, $op, $result) {
    return $this->andWhere("(BINARY(" . $column . ") " . $binOp . " BINARY(%s)) " . $op . " %s", array($value, $result));
  }

  /**
   * Adds an SQL condition by using logical OR as a conjunction
   *
   * @param  array $rules rules as field name => value pairs
   * @param  string $separator the logical operator between the comparisons
   * @return self for PHP Method Chaining
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
   * @return self for PHP Method Chaining
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
   * @return self for PHP Method Chaining
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
   * @return self for PHP Method Chaining
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
   * @return self for PHP Method Chaining
   */
  public function isNull($column) {
    return $this->append("$column IS null", null);
  }

  /**
   * Adds a condition to search for a given expression that holds a null value
   *
   * @param  string $column the column
   * @return self for PHP Method Chaining
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
   * @return self for PHP Method Chaining
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
   * @return self for PHP Method Chaining
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
   * @return self for PHP Method Chaining
   * @throws SQLException
   */
  public function compare($column, $operator, $expr = null) {
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
