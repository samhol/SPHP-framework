<?php

/**
 * StatementStrategy.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;

/**
 * Description of InsertStrategy
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class StatementStrategy {

  /**
   * @var PDO 
   */
  private $pdo;

  /**
   * @var string[] 
   */
  private $map = [
      'mysql' => 'MySQL',
      'sqlsrv' => 'Microsoft'
  ];

  /**
   * 
   * @param PDO $pdo
   */
  public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
  }

  /**
   * 
   * @param  string $className
   * @return Statement
   */
  public function createStatement(string $className): Statement {

    //$ns = __NAMESPACE__ . "\\Legacy";
    $result = __NAMESPACE__ . "\\Legacy\\" . ucfirst($className);
    $driverName = $this->pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    if (array_key_exists($driverName, $this->map)) {
      $try = __NAMESPACE__ . "\\{$this->map[$driverName]}\\$className";
      //var_dump($try);
      if (class_exists($try)) {
        $result = $try;
      }
    }
    //var_dump($result);
    return new $result($this->pdo);
  }

  /**
   * Returns new `INSERT` statement object
   * 
   * @return Insert new `INSERT` statement object
   */
  public function createInsert(): Insert {
    return $this->createStatement('Insert');
  }

  /**
   * Returns new `SELECT` statement object
   * 
   * @return Query new `SELECT` statement object
   */
  public function createQuery(): QueryInterface {
    return $this->createStatement('Query');
  }

  /**
   * Returns new `UPDATE` statement object
   * 
   * @return Update new `UPDATE` statement object
   */
  public function createUpdate(): Update {
    return $this->createStatement('Update');
  }

  /**
   * Returns new `DELETE` statement object
   * 
   * @return Delete new `DELETE` statement object
   */
  public function createDelete(): Delete {
    return $this->createStatement('Delete');
  }

}
