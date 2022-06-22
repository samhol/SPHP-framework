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

use PDO;
use IteratorAggregate;
use Traversable;
use ArrayIterator;
use Sphp\Database\Clauses\Having;
use Sphp\Database\Predicates\Predicate;
use Sphp\Database\Exceptions\InvalidStateException;

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
  protected array $columns = ['*'];

  /**
   * the table(s) from which data is to be retrieved
   *
   * @var string[]
   */
  protected array $from = [];

  /**
   * the HAVING clause
   */
  private Having $having;

  /**
   * the GROUP BY clause
   *
   * @var string[]
   */
  private array $groupBy = [];

  /**
   * result order
   *
   * @var string[]
   */
  private array $orderBy = [];

  /**
   * result limit 
   */
  protected ?int $limit = null;

  /**
   * result offset
   */
  protected ?int $offset = null;

  /**
   * Constructor
   * 
   * @param PDO $db database connection
   */
  public function __construct(PDO $db) {
    parent::__construct($db);
    $this->columns('*');
    $this->having = new Having();
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
  public function columns(string ...$columns) {
    if (empty($columns)) {
      $columns = ['*'];
    }
    $this->columns = $columns;
    return $this;
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

  public function isValid(): bool {
    return !empty($this->from);
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

  public function having(Having|Predicate|string ... $rules): Having {
    $this->having->andThese(...$rules);
    return $this->having;
  }

  /**
   * Resets The HAVING clause
   *
   * The HAVING clause is used to filter records
   *
   * @param  Having|null $having
   * @return $this for a fluent interface
   */
  public function resetHaving(?Having $having = null) {
    if ($having === null) {
      $having = new Having();
    }
    $this->having = $having;
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
   * @param  string ...$columns the column(s) (accepts multiple arguments)
   * @return $this for a fluent interface
   * @example $select->orderBy('a DESC', 'b ASC', 'c ASC, d ASC');
   */
  public function orderBy(string ...$columns) {
    $this->orderBy = $columns;
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
   * @param  int|null $limit the maximum number of rows to return
   * @param  int|null $offset the offset of the initial row
   * @return $this for a fluent interface
   */
  public function limit(?int $limit = null, ?int $offset = null) {
    $this->limit = $limit;
    $this->offset = $offset;
    return $this;
  }

  public function getQueryString(): string {
    if (!$this->isValid()) {
      throw new InvalidStateException('SELECT query requires atleast a table name');
    }
    $query = 'SELECT ';
    $query .= implode(', ', $this->columns);
    $query .= ' FROM ' . implode(', ', $this->from);
    if ($this->where->notEmpty()) {
      $query .= " $this->where";
    }
    if (!empty($this->groupBy)) {
      $query .= ' GROUP BY ' . implode(', ', $this->groupBy);
    }
    if ($this->having->notEmpty()) {
      $query .= " $this->having";
    }
    if (!empty($this->orderBy)) {
      $query .= ' ORDER BY ' . implode(', ', $this->orderBy);
    }
    if ($this->limit !== null) {
      $query .= " LIMIT $this->limit";
      if ($this->offset !== null) {
        $query .= " OFFSET $this->offset";
      }
    }
    return $query;
  }

  /**
   * Executes the SQL query in the given database and returns the result rows as an array
   *
   * @return array result rows as an array
   * @throws \PDOException if there is no database connection or query execution fails
   * @link   https://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function toArray(): array {
    return $this->execute()->fetchAll(\PDO::FETCH_ASSOC);
  }

  /**
   * Executes the SQL query in the given database and returns the row count of the results
   *
   * @return int the row count of the results
   * @throws \PDOException if there is no database connection or query execution fails
   * @link   https://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function count(): int {
    $clone = clone $this;
    $clone->limit(0, 0);
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

  public function fetchAll(int $fetch_style = PDO::FETCH_ASSOC): array {
    return $this->execute()->fetchAll($fetch_style);
  }

  public function fetchColumn(int $colNum = 0): array {
    return $this->execute()->fetchColumn($colNum);
  }

}
