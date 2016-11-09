<?php

/**
 * DBConnectorTrait.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db;

use Sphp\Db\DatabaseConnector as DatabaseConnector,
    \PDO as PDO;

/**
 * Trait implements {@link DBConnectorInterface} for {@link PDO} database connection management 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-02-02

 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait DBConnectorTrait {

  /**
   * Represents a connection between PHP and a database server
   *
   * @var PDO|null
   */
  private $db;

  /**
   * Sets a {@link Database} connection to the given database
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
  public function createConnection($dsn, $username, $password) {
    $this->setConnection(DatabaseConnector::obtain($dsn, $username, $password));
    return $this;
  }

  /**
   * Obtains the {@link Database} object for default database connection
   *
   * @return self for PHP Method Chaining
   * @throws \PDOException if no database connection was established
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects 
   */
  public function obtainDefaultConnection() {
    $this->setConnection(DatabaseConnector::obtain());
    return $this;
  }

  /**
   * Sets the {@link PDO} object for database connection
   *
   * @param  PDO $pdo the database connection
   * @return self for PHP Method Chaining
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects 
   */
  public function setConnection(PDO $pdo) {
    $this->db = $pdo;
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->db->setAttribute(PDO::ATTR_PERSISTENT, true);
    return $this;
  }

  /**
   * Gets the {@link PDO} object
   *
   * @param  boolean $forced whether to use the default connection as a fall back
   * @return PDO|null database connection or `null` if none present
   * @throws \PDOException if no database connection was established on forced mode
   */
  public function getConnection($forced = false) {
    if ($forced && !$this->hasConnection()) {
      $this->obtainDefaultConnection();
    }
    return $this->db;
  }

  /**
   * Checks whether the database connection {@link PDO} object is set or not
   *
   * @return boolean true if the database connection exists, false otherwise
   */
  public function hasConnection() {
    return $this->db !== null;
  }

}
