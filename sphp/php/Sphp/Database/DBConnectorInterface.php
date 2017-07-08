<?php

/**
 * DBConnectorInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;

/**
 * Interface implements a {@link \PDO} database connection management system
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface DBConnectorInterface {

  /**
   * Sets the connection object between PHP and a database server
   *
   * @param  PDO $pdo the connection between PHP and a database server.
   * @return self for a fluent interface
   * @throws \PDOException if no database connection was established
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function setPDO(PDO $pdo);

  /**
   * Returns the connection object between PHP and a database server
   *
   * @return PDO the connection object between PHP and a database server
   */
  public function getPDO(): PDO;
}
