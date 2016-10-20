<?php

/**
 * AbstractStatement.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db;

/**
 * Base class for all SQL Statement classes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-04-02

 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @deprecated
 */
abstract class AbstractStatement implements DBConnectorInterface, StatementInterface {

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
    }
  }

  public function getStatement() {
    try {
      if (!$this->hasConnection()) {
        $this->obtainDefaultConnection();
      }
      $conn = $this->getConnection();
      $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      return $conn->prepare($this->statementToString());
    } catch (\PDOException $e) {
      throw new PDORelatedException($e);
    } catch (\Exception $e) {
      throw new SQLException($e->getMessage(), $e->getCode(), $this->getStatement(), $e);
    }
  }

  public function execute() {
    try {
      $sth = $this->getStatement();
      $sth->execute($this->getParams());
      return $sth;
    } catch (\PDOException $e) {
      throw new PDORelatedException($e);
    }
  }

  public function __toString() {
    $keys = array();
    $values = $this->getParams();

    # build a regular expression for each parameter
    foreach ($this->getParams() as $key => $value) {
      if (is_string($key)) {
        $keys[] = '/:' . $key . '/';
      } else {
        $keys[] = '/[?]/';
      }

      if (is_array($value)) {
        $values[$key] = implode(',', $value);
      }

      if (is_null($value)) {
        $values[$key] = 'null';
      }
    }
    // Walk the array to see if we can add single-quotes to strings
    array_walk($values, create_function('&$v, $k', 'if (!is_numeric($v) && $v!="null") $v = "\'".$v."\'";'));

    $query = preg_replace($keys, $values, $this->statementToString(), 1, $count);

    return $query;
  }

}
