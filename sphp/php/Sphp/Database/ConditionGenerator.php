<?php

/**
 * Conditions.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use Sphp\Stdlib\Arrays;
use Sphp\Stdlib\Strings;
use PDO;

/**
 * Implements the content of the WHERE clause in SQL
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ConditionGenerator {

  /**
   * SQL condition(s)
   *
   * @var string
   */
  private $where = "";

  /**
   * tested values queries etc..
   *
   * @var mixed[]
   */
  private $params = [];

  /**
   * @var array
   */
  private $paramMap = [];

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

  public function connectRules(array $rules, string $connector = 'AND') {
    $result = '';
    $part = [];
    foreach ($rules as $rule) {
      $part[] = $this->generateRule($result, $connector, $rule);
    }
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
  public function generateRule($column, $operator, $expr) {
    $op = strtoupper(trim($operator));
    $output = "`$column`";
    if ($expr === null) {
      if ($op == '=') {
        return $this->isNull($column);
      } else if ($op == '<>' || $op == '!=') {
        return "$output IS NOT NULL";
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
      return  "$output $op $format";
    }
    return "$output $op ?";
  }

}
