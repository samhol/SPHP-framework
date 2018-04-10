<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database;

use PDO;
use IteratorAggregate;
use Traversable;
use ArrayIterator;
use Sphp\Database\Rules\Clause;

/**
 * An abstract implementation of a `SELECT` statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractQuery extends AbstractConditionalStatement implements IteratorAggregate, Query {

  /**
   * a list of column(s) to be included in the query
   *
   * @var string[]
   */
  private $columns = ['*'];

  /**
   * the table(s) from which data is to be retrieved
   *
   * @var string[]
   */
  private $from = [];

  /**
   * the HAVING clause
   *
   * @var Clause
   */
  private $having;

  /**
   * the GROUP BY clause
   *
   * @var string[]
   */
  private $groupBy = [];

  /**
   * result order
   *
   * @var string[]
   */
  private $orderBy = [];

  /**
   * result limit
   *
   * @var int  
   */
  private $limit = 0;

  /**
   * result offset
   *
   * @var int  
   */
  private $offset = 0;

  public function __construct(PDO $db) {
    parent::__construct($db);
    $this->get('*');
    $this->having = new Clause();
  }

  public function __clone() {
    parent::__clone();
    $this->having = clone $this->having;
  }

  /**
   * Sets the list of columns to be included in the final result
   *
   * @param  string $columns the column(s) to show (can have multiple
   *         string parameters)
   * @return $this for a fluent interface
   */
  public function get(string ...$columns) {
    $this->columns = $columns;
    return $this;
  }

  public function getColumns(): array {
    return $this->columns;
  }

  /**
   * Sets the table(s) from which data is to be retrieved
   *
   * The FROM clause can include optional JOIN sub clauses to specify the rules for joining tables.
   *
   * @param  string $tables the table(s) to show (can have multiple
   *         string parameters)
   * @return $this for a fluent interface
   */
  public function from(string ...$tables) {
    $this->from = $tables;
    return $this;
  }

  protected function fromToString(): string {
    if (!empty($this->from)) {
      return ' FROM ' . implode(', ', $this->from);
    } else {
      return '';
    }
  }

  public function getFrom() {
    return $this->from;
  }

  public function getGroupBy() {
    return $this->groupBy;
  }

  public function getOrderBy() {
    return $this->orderBy;
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
   * @param  string $columns the columns
   * @return $this for a fluent interface
   */
  public function groupBy(string ...$columns) {
    $this->groupBy = $columns;
    return $this;
  }

  protected function groupByToString(): string {
    if (!empty($this->groupBy)) {
      return ' GROUP BY ' . implode(', ', $this->groupBy);
    } else {
      return '';
    }
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
   * @return $this for a fluent interface
   */
  public function having(... $rules) {
    $obj = new Clause($rules);
    $this->having->fulfills($obj, 'AND');
    return $this;
  }

  /**
   * Sets The WHERE clause.
   *
   * The WHERE clause is used to filter records
   *
   * @param  Clause $c
   * @return $this for a fluent interface
   */
  public function setHaving(Clause $c) {
    $this->having = $c;
    return $this;
  }

  /**
   * 
   * @return Clause
   */
  public function getHaving(): Clause {
    return $this->having;
  }

  /**
   * Adds rules to the HAVING conditions component
   *
   * @param  string|RuleInterface|array $rules SQL condition(s)
   * @return $this for a fluent interface
   * not evaluate to `true`.
   */

  /**
   * Appends SQL conditions by using logical AND as a conjunction
   *
   * @param  string|RuleInterface|array $rules SQL condition(s)
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function andHaving(... $rules) {
    $obj = new Clause($rules);
    $this->where->fulfills($obj, 'AND');
    return $this;
  }

  /**
   * Appends SQL conditions by using AND NOT as a conjunction
   *
   * @param  string|RuleInterface|array $rules SQL condition(s)
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function andNotHaving(... $rules) {
    $obj = new Clause($rules);
    $this->where->fulfills($obj, 'AND NOT');
    return $this;
  }

  /**
   * Appends SQL conditions by using logical OR as a conjunction
   *
   * @param  string|RuleInterface|array $rules SQL condition(s)
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function orHaving(... $rules) {
    $obj = new Clause($rules);
    $this->where->fulfills($obj, 'OR');
    return $this;
  }

  /**
   * Appends SQL conditions by using logical OR NOT as a conjunction
   *
   * @param  string|RuleInterface|array $rules SQL condition(s)
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function orNotHaving(... $rules) {
    $obj = new Clause($rules);
    $this->where->fulfills($obj, 'OR NOT');
    return $this;
  }

  protected function havingToString(): string {
    $output = '';
    if ($this->getHaving()->notEmpty()) {
      $output .= " HAVING $this->having";
    }
    return $output;
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
   * @param  string ...$columns the column(s) (accepts multiple arguments)
   * @return $this for a fluent interface
   * @example $select->orderBy('a DESC', 'b ASC', 'c ASC, d ASC');
   */
  public function orderBy(string ...$columns) {
    $this->orderBy = $columns;
    return $this;
  }

  protected function orderByToString(): string {
    if (!empty($this->orderBy)) {
      return ' ORDER BY ' . implode(', ', $this->orderBy);
    } else {
      return '';
    }
  }

  public function getLimit() {
    return $this->limit;
  }

  public function getOffset(): int {
    return $this->offset;
  }

  public function setLimit(int $limit) {
    $this->limit = $limit;
    return $this;
  }

  public function setOffset(int $offset) {
    $this->offset = $offset;
    return $this;
  }

  public function hasLimit(): bool {
    return $this->limit > 0;
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
   * @param  int $limit the maximum number of rows to return
   * @param  mixed $offset the offset of the initial row
   * @return $this for a fluent interface
   */
  public function limit(int $limit, int $offset = 0) {
    $this->limit = '';
    if ($limit > 0) {
      $this->limit .= " LIMIT $limit ";
      if ($offset > 0) {
        $this->limit .= " OFFSET $offset ";
      }
    }
    return $this;
  }

  /**
   * Executes the SQL query in the given database and returns the result rows as an array
   *
   * @return array result rows as an array
   * @throws \PDOException if there is no database connection or query execution fails
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function toArray(): array {
    return $this->execute()->fetchAll(\PDO::FETCH_ASSOC);
  }

  /**
   * Executes the SQL query in the given database and returns the row count of the results
   *
   * @return int the row count of the results
   * @throws \PDOException if there is no database connection or query execution fails
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function count(): int {
    $clone = clone $this;
    $clone->setLimit(0)->setOffset(0);
    $count = $clone->get("COUNT(*)")->execute()->fetchColumn(0);
    //echo $this->statementToString();
    //var_dump($count);
    // $this->columns = $columns;

    return (int) $count;
  }

  /**
   * Create a new iterator to iterate through query results
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    try {
      $data = $this->toArray();
    } catch (\Throwable $ex) {
      $data = [];
    }
    return new ArrayIterator($data);
  }

  public function fetchRows(int $rowCount = null, int $offset = 0): array {
    if ($rowCount) {
      $this->limit($rowCount, $offset);
    }
  }

  public function fetchAll(int $fetch_style = PDO::FETCH_ASSOC): array {
    return $this->execute()->fetchAll($fetch_style);
  }

  public function fetchColumn(int $colNum = 0): array {
    return $this->execute()->fetchColumn($colNum);
  }

  public function fetchFirstRow(): array {
    return $this->execute()->fetch(PDO::FETCH_ASSOC);
  }

}
