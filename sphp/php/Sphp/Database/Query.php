<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database;

use Traversable;
use Countable;
use PDO;
use Sphp\Database\Clauses\Having;
use Sphp\Database\Predicates\Predicate;

/**
 * Defines a `SELECT` statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Query extends ConditionalStatement, Traversable, Countable {

  /**
   * Sets the list of columns to be included in the final result
   *
   * @param  string $columns the column(s) to show (can have multiple string parameters)
   * @return $this for a fluent interface
   */
  public function columns(string ...$columns);

  /**
   * Sets the table(s) from which data is to be retrieved
   *
   * The FROM clause can include optional JOIN sub clauses to specify the rules for joining tables.
   *
   * @param  string $tables the table(s) to show (can have multiple string parameters)
   * @return $this for a fluent interface
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
   * @param  string $columns the columns
   * @return $this for a fluent interface
   */
  public function groupBy(string ...$columns);

  /**
   * Sets a condition to the HAVING part of the query
   *
   *  A HAVING clause in SQL specifies that an SQL SELECT statement should only return rows
   *  where aggregate values meet the specified conditions. It was added to the SQL language
   *  because the WHERE keyword could not be used with aggregate functions.
   *   
   * @param  Rule|string ... $rules
   * @return Having having clause
   */
  public function having(Predicate|string ... $rules): Having;

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
   * @return $this for a fluent interface
   */
  public function limit(int $limit, int $offset = 0);

  /**
   * Executes the SQL query in the given database and returns the row count of the results
   *
   * @return int the row count of the results
   * @throws \PDOException if there is no database connection or query execution fails
   * @link   https://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function count(): int;

  /**
   * Executes the SQL query in the given database and returns the result rows as an array
   *
   * @return mixed[] result rows as an array
   * @throws \PDOException if there is no database connection or query execution fails
   * @link   https://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function fetchAll(int $fetch_style = PDO::FETCH_ASSOC): array;

  /**
   * Executes the SQL query in the given database and returns the result rows as an array
   *
   * @return mixed[] result rows as an array
   * @throws \PDOException if there is no database connection or query execution fails
   * @link   https://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function fetchColumn(int $colNum = 0): array;
}
