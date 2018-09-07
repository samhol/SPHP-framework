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

/**
 * Represents a connection between PHP and a database server
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class NestablePDO extends PDO {

  /**
   * database engines supporting nestable transactions 
   *
   * @var string[] 
   */
  private static $savepointTransactions = ['pgsql', 'mysql'];

  /**
   * the current transaction level
   * 
   * @var int  
   */
  private $transLevel = 0;

  /**
   * Checks if the database engine supports nestable transactions 
   * 
   * @return boolean true if the database engine supports nestable transactions 
   *         or false otherwise
   */
  protected function nestable(): bool {
    return in_array($this->getAttribute(PDO::ATTR_DRIVER_NAME), self::$savepointTransactions);
  }

  /**
   * Executes an SQL statement, returning a result set as a PDOStatement object
   * 
   * @param  string|ExecutableStatement $statement
   * @return \PDOStatement object, or false on failure
   */
  public function query($statement) {
    if ($statement instanceof ExecutableStatement) {
      return $statement->setConnection($this)->execute();
    } else {
      return parent::query($statement);
    }
  }

  /**
   * Executes an SQL statement and returns the number of affected rows
   * 
   * @param  string|ExecutableStatement $statement the SQL statement to prepare and execute
   * @return int the number of rows that were modified or deleted by the SQL statement
   */
  public function exec($statement) {
    if ($statement instanceof AbstractStatement) {
      if ($statement instanceof DataManipulator) {
        return $statement->setConnection($this)->affectRows();
      } else {
        return $statement->setConnection($this)->count();
      }
    } else {
      return parent::exec($statement);
    }
  }

  /**
   * Initiates a transaction
   * 
   * @return boolean true on success or false on failure
   */
  public function beginTransaction() {
    if (!$this->nestable() || $this->transLevel == 0) {
      parent::beginTransaction();
    } else {
      $this->exec("SAVEPOINT LEVEL{$this->transLevel}");
    }

    $this->transLevel++;
  }

  /**
   * Commits a transaction
   * 
   * @return boolean true on success or false on failure
   */
  public function commit() {
    $this->transLevel--;

    if (!$this->nestable() || $this->transLevel == 0) {
      parent::commit();
    } else {
      $this->exec("RELEASE SAVEPOINT LEVEL{$this->transLevel}");
    }
  }

  /**
   * Rolls back a transaction
   * 
   * @return boolean true on success or false on failure
   */
  public function rollBack() {
    $this->transLevel--;
    if (!$this->nestable() || $this->transLevel === 0) {
      parent::rollBack();
    } else {
      $this->exec("ROLLBACK TO SAVEPOINT LEVEL{$this->transLevel}");
    }
  }

}
