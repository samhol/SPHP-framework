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
use PDOStatement;
use Sphp\Database\Parameters\ParameterHandler;
use Sphp\Database\Exceptions\DatabaseException;

/**
 * Interface for database data manipulation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Statement {

  /**
   * Sets the connection object between PHP and a database server
   * 
   * @param  PDO $pdo connection object between PHP and a database server
   * @return $this for a fluent interface
   */
  public function setPDO(PDO $pdo);

  /**
   * Returns the current connection object between PHP and a database server
   * 
   * @return PDO connection object between PHP and a database server
   * @link   https://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function getPDO(): PDO;

  /**
   * Checks the basic validity of the statement
   * 
   * @return bool true for a valid statement, false otherwise
   */
  public function isValid(): bool;

  /**
   * Returns the SQL query as a string
   *
   * @return string the SQL query as a string 
   * @throws InvalidStateException if the statement is not valid SQL
   */
  public function getQueryString(): string;

  /**
   * Returns the database statement object
   *
   * @return PDOStatement the database statement object
   * @throws DatabaseException if execution fails
   * @link   https://www.php.net/manual/en/class.pdostatement.php The PDOStatement class
   */
  public function prepare(): PDOStatement;

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
   * @throws DatabaseException if execution fails
   * @link   https://www.php.net/manual/en/class.pdostatement.php The PDOStatement class
   */
  public function execute(): PDOStatement;
}
