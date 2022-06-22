<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database;

use PDO;
use PDOStatement;
use Sphp\Database\Exceptions\DatabaseException;

/**
 * Abstract Base class for any executable `SQL` Statements
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractStatement implements Statement {

  private PDO $pdo;

  /**
   * Constructor
   *
   * @param PDO $pdo a connection object between PHP and a database server 
   */
  public function __construct(PDO $pdo) {
    $this->setPDO($pdo);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->pdo);
  }

  public function getPDO(): PDO {
    return $this->pdo;
  }

  public function setPDO(PDO $pdo) {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_PERSISTENT, true);
    $this->pdo = $pdo;
    return $this;
  }

  public function prepare(): PDOStatement {
    try {
      return $this->getPDO()->prepare($this->getQueryString());
    } catch (\Throwable $e) {
      throw new DatabaseException($e->getMessage(), $e->getCode(), $e);
    }
  }

  public function execute(): PDOStatement {
    try {
      $statement = $this->prepare();
      $this->getParams()->bindTo($statement);
      $statement->execute();
      return $statement;
    } catch (\Throwable $e) {
      throw new DatabaseException($e->getMessage(), 0, $e);
    }
  }

}
