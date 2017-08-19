<?php

/**
 * Query.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;
use Traversable;

/**
 * An implementation of a SQL SELECT statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface QueryInterface extends ConditionalStatementInterface, Traversable, \Countable {

  /**
   * Sets the list of columns to be included in the final result
   *
   * @param  string $columns the column(s) to show (can have multiple
   *         string parameters)
   * @return self for a fluent interface
   */
  public function get(string ...$columns);

  /**
   * Sets the table(s) from which data is to be retrieved
   *
   * The FROM clause can include optional JOIN sub clauses to specify the rules for joining tables.
   *
   * @param  string $tables the table(s) to show (can have multiple
   *         string parameters)
   * @return self for a fluent interface
   */
  public function from(string ...$tables);

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
   * @return self for a fluent interface
   */
  public function groupBy(string ...$columns);

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
   * @return self for a fluent interface
   */
  public function having(string ...$cond);

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
   * @return self for a fluent interface
   * @example $select->orderBy('a DESC', 'b ASC', 'c ASC, d ASC');
   */
  public function orderBy(string ...$columns);

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
   * @return self for a fluent interface
   */
  public function limit(int $limit, int $offset = 0);

  public function fetchRows(int $rowCount = null, int $offset = 0): array;

  /**
   * Executes the SQL query in the given database and returns the result rows as an array
   *
   * @return mixed[] result rows as an array
   * @throws \PDOException if there is no database connection or query execution fails
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function fetchAll(int $fetch_style = PDO::FETCH_ASSOC): array;
}
