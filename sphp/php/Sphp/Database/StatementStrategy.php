<?php

/**
 * InsertStrategy.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;

/**
 * Description of InsertStrategy
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-08-18
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

  public function generateStatement($className): StatementInterface {

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

  public function createInsert(): Insert {
    return $this->generateStatement('Insert');
    return new $q($this->pdo);
  }

  public function createQuery(): QueryInterface {
    return $this->generateStatement('Query');
    return new $q($this->pdo);
  }

  public function createUpdate(): Update {
    return $this->generateStatement('Update');
    return new $q($this->pdo);
  }

  public function createDelete(): DeleteInterface {
    return $this->generateStatement('Delete');
    return new $q($this->pdo);
  }

}
