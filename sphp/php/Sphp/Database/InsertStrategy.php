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
class InsertStrategy {

  /**
   * @var PDO 
   */
  private $pdo;

  //bookList is not instantiated at construct time
  public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
  }

  public function createInsert() {
    $driver = $this->pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    switch ($driver) {
      case 'mysql':
        $insert = new MySQL\Insert($this->pdo);
        break;
      default :
        $insert = new Insert($this->pdo);
        break;
    }
    return $insert;
  }

  public function createQuery() {
    $driver = $this->pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    switch ($driver) {
      case 'mysql':
        $insert = new MySQL\Query($this->pdo);
        break;
      case 'sqlsrv':
        $insert = new Microsoft\Query($this->pdo);
        break;
      default :
        $insert = new Query($this->pdo);
        break;
    }
    return $insert;
  }

}
