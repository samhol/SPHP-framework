<?php

/**
 * StatementInterface.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;
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
   * Sets the connection object between PHP and a database server
   * 
   * @param  PDO $pdo connection object between PHP and a database server
   * @return self for a fluent interface
   */
  public function setPDO(PDO $pdo);

  /**
   * Returns the current connection object between PHP and a database server
   * 
   * @return PDO connection object between PHP and a database server
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function getPDO(): PDO;

  /**
   * Returns the SQL statement as a string
   *
   * @return string the SQL statement as a string
   */
  public function statementToString(): string;

  /**
   * Returns the database statement object
   *
   * @return PDOStatement the database statement object
   * @throws \Sphp\Exceptions\RuntimeException
   * @link   http://php.net/manual/en/class.pdostatement.php The PDOStatement class
   */
  public function getStatement(): PDOStatement;

  /**
   * Returns the parameter handler
   *
   * @return ParameterHandler the parameter handler
   */
  public function getParams(): ParameterHandler;

  /**
   * Executes the database statement
   *
   * @return PDOStatement the result set
   * @throws \Sphp\Exceptions\RuntimeException if query execution fails
   * @link   http://php.net/manual/en/class.pdostatement.php The PDOStatement class
   */
  public function execute(): PDOStatement;
}
