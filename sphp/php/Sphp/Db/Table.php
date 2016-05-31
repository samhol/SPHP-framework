<?php

/**
 * Database.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db;

/**
 * Class Database
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-10-08
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Table implements DBConnectorInterface {

  use DBConnectorTrait;

  private $table;

  /**
   * Constructs a new instance
   *
   * @param  string $table  table name
   * @param  null|\PDO $pdo optional database connection
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function __construct($table, \PDO $pdo = null) {
    if ($pdo !== null) {
      $this->setConnection($pdo);
    } else {
      $this->obtainDefaultConnection();
    }
    $this->setTable($table);
  }

  /**
   * 
   * @return type
   */
  public function getTable() {
    return $this->table;
  }

  /**
   * 
   * @param type $table
   * @return \Sphp\Db\Table
   */
  public function setTable($table) {
    $this->table = $table;
    return $this;
  }

  /**
   *
   * @param  string|Conditions|null $where
   * @return Query new instance of the database querier
   */
  public function query($where = null) {
    $query = (new Query())
            ->from($this->getTable())
            ->setConnection($this->getConnection());
    if ($where !== null) {
      if (is_string($where)) {
        $where = new Conditions($where);
      }
      $query->where($where);
    }
    return $query;
  }

  /**
   *
   * @param  mixed $values
   * @return Insert new instance of the database inserter
   */
  public function insert($values = null) {
    $insert = (new Insert())
            ->setConnection($this->getConnection())
            ->table($this->getTable());
    if ($values !== null) {
      $insert->values($values);
    }
    return $insert;
  }

  /**
   * Returns a new instance of the database updater
   *
   * @param  string|Conditions|null $where
   * @return Update new instance of the database updater
   */
  public function update($where = null) {
    $update = (new Update())
            ->setConnection($this->getConnection())
            ->table($this->getTable());
    if ($where !== null) {
      if (is_string($where)) {
        $where = new Conditions($where);
      }
      $update->where($where);
    }
    return $update;
  }

  /**
   *
   * @param  string|Conditions|null $where
   * @return Delete
   */
  public function delete($where = null) {
    $update = (new Delete())
            ->setConnection($this->getConnection())
            ->from($this->getTable());
    if ($where !== null) {
      if (is_string($where)) {
        $where = new Conditions($where);
      }
      $update->where($where);
    }
    return $update;
  }

  /**
   *
   * @param \PDO $conn
   * @return self new instance
   */
  public static function connect(\PDO $conn = null) {
    return new static($conn);
  }

}
