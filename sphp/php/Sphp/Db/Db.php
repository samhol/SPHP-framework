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
class Db implements DBConnectorInterface {

  use DBConnectorTrait;

  /**
   * Constructs a new instance
   *
   * @param  null|\PDO $pdo the database connection
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function __construct(\PDO $pdo = null) {
    if ($pdo !== null) {
      $this->setConnection($pdo);
    } else {
      $this->obtainDefaultConnection();
    }
  }

  /**
   *
   * @param  string $from
   * @param   $where
   * @return Query new instance of the database querier
   */
  public function query($from = null, $where = null) {
    $query = new Query();
    $query->setConnection($this->getConnection());
    if ($from !== null) {
      $query->from($from);
    }
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
   * @param  string $table optional table name
   * @param  mixed $values
   * @return Insert new instance of the database inserter
   */
  public function insert($table = null, $values = null) {
    $insert = new Insert();
    $insert->setConnection($this->getConnection());
    if ($table !== null) {
      $insert->table($table);
    }
    if ($values !== null) {
      $insert->values($values);
    }
    return $insert;
  }

  /**
   * Returns a new instance of the database updater
   *
   * @param  string|null $table optional relation name
   * @param  string|Conditions|null $where
   * @return Update new instance of the database updater
   */
  public function update($table = null, $where = null) {
    $update = new Update();
    $update->setConnection($this->getConnection());
    if ($table !== null) {
      $update->table($table);
    }
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
   * @param  string|null $from optional relation names
   * @param  string|Conditions|null $where
   * @return Delete
   */
  public function delete($from = null, $where = null) {
    $update = new Delete();
    $update->setConnection($this->getConnection());
    if ($from !== null) {
      $update->from($from);
    }
    if ($where !== null) {
      if (is_string($where)) {
        $where = new Conditions($where);
      }
      $update->setConditions($where);
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

  /**
   *
   * @param  \PDO $conn
   * @return Table new instance
   */
  public static function table($table, \PDO $conn = null) {
    return (new Table($table, $conn));
  }

}
