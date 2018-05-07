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
use PDOStatement;
use PDOException;
use Sphp\Exceptions\RuntimeException;

/**
 * Abstract Base class for any executable `SQL` Statements
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractStatement implements Statement {

  /**
   * @var PDO
   */
  private $pdo;

  /**
   * Constructor
   *
   * @param PDO $pdo a connection object between PHP and a database server
   * @link  http://www.php.net/manual/en/book.pdo.php PHP Data Objects
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

  public function getStatement(): PDOStatement {
    try {
      return $this->getPDO()->prepare($this->statementToString());
    } catch (PDOException $e) {
      throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
    }
  }

  public function execute(): PDOStatement {
    try {
      return $this->getParams()->executeIn($this->getStatement());
    } catch (PDOException $e) {
      throw new RuntimeException($e->getMessage(), 0, $e);
    }
  }

}
