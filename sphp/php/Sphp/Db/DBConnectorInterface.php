<?php

/**
 * DBConnectorInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db;

/**
 * Interface implements a {@link \PDO} database connection management system
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-02-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface DBConnectorInterface {

  /**
   * Obtains the {@link \PDO} object for default database connection
   *
   * @return self for PHP Method Chaining
   * @throws \PDOException if no database connection was established
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function obtainDefaultConnection();

  /**
   * Sets a {@link PDO} connection to the given database
   *
   * @param  string $dsn the Data Source Name
   * @param  string $username the user name for the DSN string
   * @param  string $password the password for the DSN string
   * @return self for PHP Method Chaining
   * @throws \PDOException if there is no database connection or query execution fails
   * @uses   PDOConnector
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   * @link   http://www.php.net/manual/en/pdo.construct.php \PDO::__construct
   */
  public function createConnection($dsn, $username, $password);

  /**
   * Sets the {@link \PDO} object for database connection
   *
   * @param  \PDO $pdo the database connection
   * @return self for PHP Method Chaining
   * @throws \PDOException if no database connection was established
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function setConnection(\PDO $pdo);

  /**
   * Gets the {@link \PDO} object
   *
   * @return \PDO|null database connection
   */
  public function getConnection();

  /**
   * Checks whether the database connection {@link \PDO} object is set or not
   *
   * @return boolean true if the database connection exists, false otherwise
   */
  public function hasConnection();
}
