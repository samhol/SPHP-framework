<?php

/**
 * Rule.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;
use PDO;
/**
 * Description of Rule
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-08-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Rule implements RuleInterface {

  /**
   * @var string 
   */
  private $sql;

  /**
   * @var ParameterContainerInterface 
   */
  private $params;

  /**
   * 
   * @param string $sql
   * @param mixed $params
   */
  public function __construct(string $sql, $params = null, int $type = PDO::PARAM_STR) {
    $this->params = new SequentialPDOParameters();
    if ($params === null) {
      $params = [];
    } else if (!is_array($params)) {
      $params = [$params];
    }
    $this->sql = $sql;
    $this->params->appendParams($params);
  }

  public function getParams(): ParameterContainerInterface {
    return $this->params;
  }

  public function getSQL(): string {
    return $this->sql;
  }

  public function __toString(): string {
    return $this->getSQL();
  }

  /**
   * Generates a rule for a column to contain a `NULL` (empty) value
   *
   * @param string $column
   * @return Rule new instance
   */
  public static function isNull(string $column): Rule {
    return new static("$column IS null");
  }

  /**
   * Generates a rule for a column to not contain a `NULL` (empty) value
   *
   * @param  string $column the column
   * @return Rule new instance
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

  public static function compare(string $column, string $operator, $expr): Rule {
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

  /**
   * Generates a rule a bitwise operation to the column value pair and compares the result to a given parameter
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
   * Generates a rule to test the inequality of two given expressions or columns
   *
   * **Important!**
   * **ALWAYS SANITIZE ALL USER INPUTS!**
   *
   * @param  mixed $column the column
   * @param  mixed $value the value of the expression
   * @return self for a fluent interface
   */
  public static function is(string $column, $value): Rule {
    if ($value === null) {
      return static::isNull($column);
    } else {
      return new static("$column = ?", $value);
    }
  }

  /**
   * Generates a rule to test the inequality of a given column and a value
   *
   * @param  string $column the column name
   * @param  mixed $value the value of the expression
   * @return self for a fluent interface
   */
  public static function isNot(string $column, $value): Rule {
    if ($value === null) {
      return static::isNotNull($column);
    } else {
      return new static("$column <> ?", $value);
    }
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
  public static function isLike(string $column, string $pattern) {
    return new static("$column LIKE ?", $pattern);
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
  public static function isNotLike(string $column, string $pattern) {
    return new static("$column NOT LIKE ?", $pattern);
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
    $g = static::generateGroupSql($group);
    return new static("$column NOT IN ($g)", $group);
  }

}
