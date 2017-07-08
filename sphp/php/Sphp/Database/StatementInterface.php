<?php

/**
 * StatementInterface.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDOStatement;

/**
 * Interface for database data manipulation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface StatementInterface {

  /**
   * Returns the SQL statement as a string
   *
   * @return string the SQL statement as a string
   */
  public function statementToString(): string;

  /**
   * Returns the SQL statement object
   *
   * @return PDOStatement the SQL statement object
   */
  public function getStatement(): PDOStatement;

  /**
   * Returns the bound parameters as an array
   *
   * @return mixed[] the bound parameters
   */
  public function getParams(): array;

  /**
   * Returns the SQL statement as a string
   *
   * Replaces any parameter placeholders in a query with the value of that
   * parameter. Useful for debugging. Assumes anonymous parameters from
   * $params are are in the same order as specified in $query
   *
   * @return string the interpolated query for debugging purposes
   */
  public function __toString(): string;

  /**
   * Executes the SQL statement, returning a result set as a PDOStatement object
   *
   * @return \PDOStatement the result set
   * @throws SQLException if there is no database connection or query execution fails
   */
  public function execute(): PDOStatement;
}
