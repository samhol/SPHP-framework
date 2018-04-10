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
   * @throws DatabaseException if execution fails
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
   * @throws DatabaseException if execution fails
   * @link   http://php.net/manual/en/class.pdostatement.php The PDOStatement class
   */
  public function execute(): PDOStatement;
}
