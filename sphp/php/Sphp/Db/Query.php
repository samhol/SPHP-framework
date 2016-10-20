<?php

/**
 * Query.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db;

use Sphp\Core\Types\BitMask as BitMask;

/**
 * An implementation of a SQL SELECT statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-04-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Query extends ConditionalStatement implements \IteratorAggregate {

  const COLUMNS = 0b10;
  const FROM = 0b100;
  const HAVING = 0b1000;
  const GROUP_BY = 0b10000;
  const ORDER_BY = 0b100000;
  const LIMIT = 0b1000000;
  const RESET_ALL = 0b1111111;

  /**
   * a list of column(s) to be included in the query
   *
   * @var string
   */
  private $columns = "*";

  /**
   * the table(s) from which data is to be retrieved
   *
   * @var string
   */
  private $from = "";

  /**
   * the HAVING clause
   *
   * @var string
   */
  private $having = "";

  /**
   * the GROUP BY clause
   *
   * @var string
   */
  private $groupBy = "";

  /**
   * result order
   *
   * @var string
   */
  private $orderBy = "";

  /**
   * result limit
   *
   * @var string
   */
  private $limit = "";

  public function __construct(Conditions $where = null) {
    parent::__construct($where);
  }


  /**
   * Sets the list of columns to be included in the final result
   *
   * @param  string|string[] $columns the column(s) to show (can have multiple
   *         string parameters)
   * @return self for PHP Method Chaining
   */
  public function get($columns = "*") {
    if (func_num_args() > 1) {
      $columns = func_get_args();
    }
    if (!is_array($columns)) {
      $this->columns = $columns;
    }
    if (is_array($columns)) {
      print_r($columns);
      $this->columns = implode(", ", $columns);
    }
    return $this;
  }

  /**
   * Sets the table(s) from which data is to be retrieved
   *
   * The FROM clause can include optional JOIN subclauses to specify the rules for joining tables.
   *
   * @param  string|string[] $tables the table(s) to show (can have multiple
   *         string parameters)
   * @return self for PHP Method Chaining
   */
  public function from($tables) {
    if (func_num_args() > 0) {
      $tables = func_get_args();
    }
    if (is_array($tables)) {
      $this->from = implode(", ", $tables);
    } else {
      $this->from = $tables;
    }
    return $this;
  }

  /**
   * Sets the GROUP BY clause to the query
   *
   * The group by clause collects the remaining rows into one group for each unique value in the group by expression.
   *
   *  The GROUP BY clause is used to project rows having common values into a smaller set of rows.
   *  GROUP BY is often used in conjunction with SQL aggregation functions or to eliminate duplicate
   *  rows from a result set.
   *
   * @param  string|string[] $columns the columns
   * @return self for PHP Method Chaining
   */
  public function groupBy($columns) {
    if (func_num_args() > 0) {
      $columns = func_get_args();
    }
    if (is_array($columns)) {
      $this->groupBy = implode(", ", $columns);
    } else {
      $this->groupBy = $columns;
    }
    return $this;
  }

  /**
   * Sets a condition to the HAVING part of the query
   *
   *  A HAVING clause in SQL specifies that an SQL SELECT statement should only return rows
   *  where aggregate values meet the specified conditions. It was added to the SQL language
   *  because the WHERE keyword could not be used with aggregate functions.
   *
   * **Important!**
   *
   * * **ALWAYS SANITIZE ALL USER INPUTS!**
   * * **If you are using multiple arguments; None of the arguments should be an array**
   *
   * @param  string|string[] $cond condition(s) (accepts multiple arguments)
   * @return self for PHP Method Chaining
   */
  public function having($cond) {
    if (func_num_args() > 0) {
      $cond = func_get_args();
    }
    if (is_array($cond)) {
      $cond = implode(" AND ", $cond);
    }
    if (strlen($this->having) > 0) {
      $this->having .= " AND " . $cond;
    } else {
      $this->having = $cond;
    }
    return $this;
  }

  /**
   * Sets columns which are used to sort the resulting data
   *
   *  An ORDER BY clause in SQL specifies that a SQL SELECT statement returns a result
   *  set with the rows being sorted by the values of one or more columns.
   *  The sort criteria do not have to be included in the result set.
   *  The sort criteria can be expressions, including – but not limited to – column names,
   *  user-defined functions, arithmetic operations, or CASE expressions.
   *  The expressions are evaluated and the results are used for the sorting,
   *  i.e. the values stored in the column or the results of the function call.
   *
   * **Note!**
   *
   * - 'ASC' indicates ascending order (default)
   * - 'DESC' indicates descending order
   *
   * @param  string|string[] $columns the column(s) (accepts multiple arguments)
   * @return self for PHP Method Chaining
   * @example $select->orderBy('a DESC', 'b ASC', 'c ASC, d ASC');
   */
  public function orderBy($columns) {
    if (func_num_args() > 0) {
      $columns = func_get_args();
    }
    if (!is_array($columns)) {
      $columns = array($columns);
    }
    $this->orderBy = implode(", ", $columns);
    return $this;
  }

  /**
   * Limits the result rows
   *
   * The actual approach to do this often varies per vendor and therefore
   * this method is currently supported  only for the following engines
   *
   * * Netezza
   * * MySQL
   * * Sybase SQL Anywhere
   * * PostgreSQL (also supports the standard, since version 8.4)
   * * SQLite
   * * HSQLDB
   * * H2
   * * Vertica
   * * Polyhedra
   *
   * @param int $rowCount the maximum number of rows to return
   * @param mixed $offset the offset of the initial row
   * @return self for PHP Method Chaining
   */
  public function limit($rowCount, $offset = 0) {
    $this->limit = "LIMIT " . $rowCount . " OFFSET " . $offset;
    return $this;
  }

  /**
   * Resets the specific part of the query or the entire query if no parameter is given
   *
   *  Values and their explanations for parameter <var>$part</var>:
   *
   *  - 'COLUMNS'
   *  - 'FROM'
   *  - 'WHERE'
   *  - 'HAVING'
   *  - 'ORDER_BY'
   *  - 'GROUP_BY'
   *  - 'LIMIT'
   *
   * @param  int|BitSet $parts the specified parts as a bitmask
   * @return self for PHP Method Chaining
   */
  public function reset($parts = self::RESET_ALL) {
    $types = new BitMask($parts);
    if ($types->contains(self::RESET_WHERE)) {
      parent::reset();
    }
    if ($types->contains(self::RESET_COLUMNS)) {
      $this->columns = "*";
    }
    if ($types->contains(self::RESET_FROM)) {
      $this->from = "";
    }
    if ($types->contains(self::RESET_GROUP_BY)) {
      $this->groupBy = "";
    }
    if ($types->contains(self::RESET_GORDER_BY)) {
      $this->orderBy = "";
    }
    if ($types->contains(self::RESET_HAVING)) {
      $this->having = "";
    }
    if ($types->contains(self::RESET_LIMIT)) {
      $this->limit = "";
    }
    return $this;
  }

  public function statementToString() {
    $query = "SELECT " . $this->columns . " FROM " . $this->from;
    if ($this->where()->hasConditions()) {
      $query .= " WHERE " . $this->where();
    }
    if (strlen($this->groupBy) > 0) {
      $query .= " GROUP BY " . $this->groupBy;
    }
    if (strlen($this->having) > 0) {
      $query .= " HAVING " . $this->having;
    }
    if (strlen($this->orderBy) > 0) {
      $query .= " ORDER BY " . $this->orderBy;
    }
    if (strlen($this->limit) > 0) {
      $query .= " " . $this->limit;
    }
    return $query;
  }

  public function getParams() {
    return $this->where()->getParams();
  }

  /**
   * Executes the SQL query in the given database and returns the result rows as an array
   *
   * @return mixed[] result rows as an array
   * @throws \PDOException if there is no database connection or query execution fails
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function fetchArray() {
    return $this->execute()->fetchAll(\PDO::FETCH_ASSOC);
  }

  /**
   * Executes the SQL query in the given database and returns the row count of the results
   *
   * @return int the row count of the results
   * @throws \PDOException if there is no database connection or query execution fails
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function count() {
    $columns = $this->columns;
    $count = $this->get("COUNT(*)")->execute()->fetchColumn();
    $this->columns = $columns;
    return (int) $count;
  }

  /**
   * 
   * @return \ArrayIterator
   */
  public function getIterator() {
    try {
      $data = $this->fetchArray();
    } catch (Exception $ex) {
      $data = [];
    }
    return new \ArrayIterator($data);
  }

}
