<?php

/**
 * AbstractStatement.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;
use PDOStatement;
use PDOException;
use Sphp\Exceptions\RuntimeException;

/**
 * Base class for all SQL Statement classes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractStatement implements StatementInterface {

  /**
   * @var ParameterHandler 
   */
  private $params;

  /**
   * @var PDO
   */
  private $pdo;

  /**
   * Constructs a new instance
   *
   * @param ParameterHandler $params
   * @param PDO $pdo
   * @link  http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function __construct(ParameterHandler $params, PDO $pdo) {
    $this->setPDO($pdo);
    $this->setParams($params);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->params, $this->pdo);
  }

  protected function setParams(ParameterHandler $params) {
    $this->params = $params;
    return $this;
  }

  public function getPDO(): PDO {
    return $this->pdo;
  }

  /**
   * 
   * @param  PDO $pdo
   * @return self for a fluent interface
   */
  public function setPDO(PDO $pdo) {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_PERSISTENT, true);
    $this->pdo = $pdo;
    return $this;
  }

  /**
   * Returns an array of values with as many elements as there are bound
   * parameters in the clause
   *
   * @return ParameterHandler values that are vulnerable to an SQL injection
   */
  public function getParams(): ParameterHandler {
    echo 'abstract:';
    return $this->params;
  }

  /**
   * 
   * @return PDOStatement
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function getStatement(): PDOStatement {
    echo $this->statementToString();
    try {
      return $this->getPDO()->prepare($this->statementToString());
    } catch (PDOException $e) {
      echo $this->statementToString();
      throw new RuntimeException($e->getMessage(), 0, $e);
    }
  }

  /**
   * 
   * @return PDOStatement
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function execute(): PDOStatement {
    
      //var_dump($this->statementToString());
 
      print_r($this->getParams()->toArray());
    try {
      return $this->getParams()->executeIn($this->getStatement());
    } catch (PDOException $e) {
      throw new RuntimeException($e->getMessage(), 0, $e);
    }
  }

}
