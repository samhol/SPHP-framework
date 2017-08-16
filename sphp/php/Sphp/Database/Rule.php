<?php

/**
 * Rule.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;

/**
 * Implements a single rule for comparison operations in SQL queries
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
  private $columnName;

  /**
   * @var string 
   */
  private $op;

  /**
   * @var string 
   */
  private $sql;

  /**
   * @var SequentialParameters 
   */
  private $params;

  /**
   * 
   * @param string $sql
   * @param mixed $params
   * @param int $type
   */
  public function __construct(string $columnName, string $op, $params = null, int $type = PDO::PARAM_STR) {
    $this->params = new SequentialParameters();
    if ($params === null) {
      $params = [];
    } else if (!is_array($params)) {
      $params = [$params];
    }
    $this->columnName = $columnName;
    $this->op = $op;
    //$this->sql = $sql;
    $this->params->appendParams($params, $type);
  }

  public function getParams(): ParameterHandler {
    return $this->params;
  }

  protected function generateQuestionMarks(): string {
    $num = $this->params->count();
    if ($num > 1) {
      $qMarks = array_fill(0, $num, '?');
      return '(' . implode(', ', $qMarks) . ')';
    }
    return '?';
  }

  public function getSQL(): string {
    return "$this->columnName $this->op " . $this->generateQuestionMarks();
  }

  public function __toString(): string {
    return $this->getSQL();
  }

  /**
   * Generates a rule for a column to contain a `NULL` (empty) value
   *
   * @param  string $column
   * @return string null testing rule
   */
  public static function isNull(string $column): string {
    return "$column IS null";
  }

  /**
   * Generates a rule for a column to not contain a `NULL` (empty) value
   *
   * @param  string $column the column
   * @return string null testing rule
   */
  public static function isNotNull(string $column): string {
    return "$column IS NOT NULL";
  }

  protected static function generateGroupSql($group): string {
    if (is_array($group)) {
      $qMarks = array_fill(0, count($group), '?');
      return implode(', ', $qMarks);
    }
  }

  /**
   * 
   * @param  string $column
   * @param  Traversable|array $group
   * @return Rule new instance
   */
  public static function isIn(string $column, $group): Rule {
    $qMarks = static::generateGroupSql($group);
    return new static($column, 'IN', $group);
  }

  /**
   * Adds a SQL NOT IN Operator
   *
   * Determines whether a specified value does not belong to a given group.
   *
   * @param  string $column the column
   * @param  mixed[]|Query|Traversable $group value(s) of the group
   * @return Rule new instance
   */
  public static function isNotIn($column, $group): Rule {
    $g = static::generateGroupSql($group);
    return new static($column, 'NOT IN', $group);
  }

  /**
   * 
   * @param  string $column
   * @param  string $operator
   * @param  mixed $expr
   * @return Rule|string
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public static function compare(string $column, string $operator, $expr) {
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
    return new static($output, $op, $expr);
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
   * @return Rule new instance
   */
  public function binaryOperationCompare($column, $binOp, $value, $op, $result): Rule {
    return $this->andWhere("(BINARY(" . $column . ") " . $binOp . " BINARY(%s)) " . $op . " %s", array($value, $result));
  }

  /**
   * Generates a rule to test the inequality of two given expressions or columns
   *
   * **Important!**
   * **ALWAYS SANITIZE ALL USER INPUTS!**
   *
   * @param  string $column the column
   * @param  mixed $value the value of the expression
   * @return Rule new instance
   */
  public static function is(string $column, $value): Rule {
    return new static($column, '=', $value);
  }

  /**
   * Generates a rule to test the inequality of a given column and a value
   *
   * @param  string $column the column name
   * @param  mixed $value the value of the expression
   * @return Rule new instance
   */
  public static function isNot(string $column, $value): Rule {
    return new static($column, '<>', $value);
  }

  /**
   * Generates a rule to test the for a specified pattern in a column
   *
   * * Use the `%` sign to define wildcards (missing letters in the <var>$pattern</var>).
   * * The `%` sign can be used both before and after the pattern string.
   *
   * @param  string $column the column
   * @param  string $pattern pattern string
   * @return Rule new instance
   */
  public static function isLike(string $column, string $pattern): Rule {
    return new static($column, 'LIKE', $pattern);
  }

  /**
   * Generates a rule to test the for a specified pattern in a column
   *
   * **Important!**
   * **ALWAYS SANITIZE ALL USER INPUTS!**
   *
   * * Use the `%` sign to define wildcards (missing letters in the <var>$pattern</var>).
   * * The `%` sign can be used both before and after the pattern string.
   *
   * @param  string $column the column
   * @param  string $pattern pattern string
   * @return Rule new instance
   */
  public static function isNotLike(string $column, string $pattern): Rule {
    return new static($column, 'NOT LIKE', $pattern);
  }

  /**
   * 
   * @param  mixed $rule
   * @return Rule
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public static function create($rule): Rule {
    if (is_array($rule) && count($rule) > 2) {
      return static::compare(array_shift($rule), array_shift($rule), array_shift($rule));
    } else if (is_string($rule)) {
      return new static($rule);
    } else {
      throw new \Sphp\Exceptions\InvalidArgumentException('vitun kettu');
    }
  }

}
