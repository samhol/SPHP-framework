<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Rules;

use PDO;
use Sphp\Database\Parameters\ParameterHandler;
use Sphp\Database\Parameters\SequentialParameterHandler;
use Sphp\Database\Utils;
/**
 * Implements a single rule for comparison operations in SQL queries
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
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
   * @var array 
   */
  private $params;

  /**
   * @var int 
   */
  private $paramType;

  /**
   * Constructor
   * 
   * @param string $columnName
   * @param string $op
   * @param mixed $params
   * @param int $paramType data type for the parameter
   */
  public function __construct(string $columnName, string $op, $params = [], int $paramType = PDO::PARAM_STR) {
    if (!is_array($params)) {
      $params = [$params];
    }
    $this->columnName = $columnName;
    $this->op = strtoupper($op);
    $this->params = $params;
    $this->paramType = $paramType;
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->params);
  }

  /**
   * 
   * @return ParameterHandler
   */
  public function getParams(): ParameterHandler {
    $params = new SequentialParameterHandler();
    $params->appendParams($this->params, $this->paramType);
    return $params;
  }

  public function getSQL(): string {
    if ($this->op === 'BETWEEN' || $this->op === 'NOT BETWEEN') {
      return "$this->columnName ? $this->op ?";
    } else if ($this->op === 'IN' || $this->op === 'NOT IN') {
      return "$this->columnName $this->op " . Utils::createGroupOfQuestionMarks(count($this->params));
    }
    return "$this->columnName $this->op ?";
  }

  public function __toString(): string {
    return $this->getSQL();
  }

  /**
   * Generates a rule for a column to contain a `NULL` (empty) value
   *
   * @param  string $columnName the column name
   * @return string SQL NULL testing rule
   */
  public static function isNull(string $columnName): string {
    return "$columnName IS NULL";
  }

  /**
   * Generates a rule for a column to not contain a `NULL` (empty) value
   *
   * @param  string $columnName the column name
   * @return string SQL NULL testing rule
   */
  public static function isNotNull(string $columnName): string {
    return "$columnName IS NOT NULL";
  }

  /**
   * 
   * @param  string $column
   * @param  Traversable|array $group
   * @param  int $paramType
   * @return Rule new instance
   */
  public static function isIn(string $column, $group, int $paramType = PDO::PARAM_STR): Rule {
    return new static($column, 'IN', $group, $paramType);
  }

  /**
   * Adds a SQL NOT IN Operator
   *
   * Determines whether a specified value does not belong to a given group.
   *
   * @param  string $column the column
   * @param  mixed[]|Query|Traversable $group value(s) of the group
   * @param  int $paramType
   * @return Rule new instance
   */
  public static function isNotIn($column, $group, int $paramType = PDO::PARAM_STR): Rule {
    return new static($column, 'NOT IN', $group, $paramType);
  }

  /**
   * Generates a comparison rule to be added to a SQL clause object
   * 
   * @param  string $column
   * @param  string $operator
   * @param  mixed $expr
   * @return Rule|string a comparison rule to be added to a SQL clause object
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public static function compare(string $column, string $operator, $expr) {
    $op = strtoupper(trim($operator));
    $output = "`$column`";
    if ($expr === null) {
      if ($op === '=') {
        return static::isNull($column);
      } else if ($op === '<>' || $op === '!=') {
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
  public static function binaryOperationCompare($column, $binOp, $value, $op, $result): Rule {
    return new Rule("(BINARY(" . $column . ") " . $binOp . " BINARY(%s)) " . $op . " %s", array($value, $result));
  }

  /**
   * Generates a rule to test the inequality of two given expressions or columns
   *
   * **Important!**
   * **ALWAYS SANITIZE ALL USER INPUTS!**
   *
   * @param  string $column the column
   * @param  mixed $value the value of the expression
   * @param  int $paramType
   * @return Rule new instance
   */
  public static function is(string $column, $value, int $paramType = PDO::PARAM_STR): Rule {
    return new Rule($column, '=', $value, $paramType);
  }

  /**
   * Generates a rule to test the inequality of a given column and a value
   *
   * @param  string $column the column name
   * @param  mixed $value the value of the expression
   * @param  int $paramType
   * @return Rule new instance
   */
  public static function isNot(string $column, $value, int $paramType = PDO::PARAM_STR): Rule {
    return new Rule($column, '<>', $value, $paramType);
  }

  /**
   * Generates a rule to test the for a specified pattern in a column
   *
   * * Use the `%` sign to define wildcards (missing letters in the <var>$pattern</var>).
   * * The `%` sign can be used both before and after the pattern string.
   *
   * @param  string $column the column
   * @param  mixed $pattern pattern string
   * @return Rule new instance
   */
  public static function isLike(string $column, $pattern): Rule {
    return new Rule($column, 'LIKE', $pattern);
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
   * @param  mixed $pattern pattern string
   * @return Rule new instance
   */
  public static function isNotLike(string $column, $pattern): Rule {
    return new Rule($column, 'NOT LIKE', $pattern, PDO::PARAM_STR);
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
      throw new \Sphp\Exceptions\InvalidArgumentException('Invalid parameter given');
    }
  }

}
