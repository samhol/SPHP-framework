<?php

/**
 * DatabaseConnector.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Db;

/**
 * Obtains a singelton {@link Database} instance for the given database connection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @update 2011-03-08
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class DatabaseConnector {

  /**
   * the classes which represent connections to database servers
   *
   * @var NestablePDO[]
   */
  private static $dbLinks = [];

  /**
   * Obtains a singelton {@link Database} instance for given database connection
   *
   * @param string $dsn the Data Source Name
   * @param string $username the user name for the DSN string
   * @param string $password the password for the DSN string
   * @return NestablePDO the object that represents a connection to a database server
   * @throws \PDOException if there is no database connection or query execution fails
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   * @link   http://www.php.net/manual/en/pdo.construct.php \PDO::__construct
   */
  public static function obtain($dsn = PDO_DNS, $username = PDO_USERNAME, $password = PDO_PASSWORD) {
    $hashId = hash("md4", $dsn . $username . $password);
    if (!array_key_exists($hashId, self::$dbLinks) || self::$dbLinks[$hashId] === null) {
      $options = [
          \PDO::ATTR_PERSISTENT => true,
          \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
      ];
      $db = new NestablePDO($dsn, $username, $password, $options);
      self::$dbLinks[$hashId] = $db;
    }
    return self::$dbLinks[$hashId];
  }

}
