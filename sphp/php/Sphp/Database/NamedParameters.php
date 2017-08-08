<?php

/**
 * TaskRunner.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;
use PDOStatement;
use PDOException;
use Sphp\Exceptions\RuntimeException;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Base class for all SQL Statement classes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class NamedParameters extends Parameters {

  /**
   * Constructs a new instance
   * 
   * @param mixed $params
   */
  public function __construct($params = null) {
    if ($params !== null) {
      $this->mergeParams($params);
    }
  }

  /**
   * 
   * @param  array|Traversable $params
   * @return self for a fluent interface
   * @throws InvalidArgumentException
   */
  public function mergeParams($params) {
    if (!is_array($params) && !$params instanceof \Traversable) {
      throw new InvalidArgumentException('Merged data must be an iterable object or an array');
    }
    foreach ($params as $name => $value) {
      $this->setParam($name, $value);
    }
    return $this;
  }

  /**
   * 
   * @param  mixed $name
   * @return string standardized name string
   */
  protected function standardizeName($name): string {
    $res = (string) $name;
    if (substr($res, 0, 1) !== ':') {
      $res = ":$res";
    }
    return $res;
  }

  /**
   * 
   * @param  string $name  [:][a-zA-Z0-9_]+;
   * @param  mixed $value
   * @param  int $type
   * @return self for a fluent interface
   * @throws InvalidArgumentException
   */
  public function setParam($name, $value, int $type = PDO::PARAM_STR) {
    if (!is_string($name)) {
      throw new InvalidArgumentException('Parameter name must be a string');
    }
    parent::setParam($this->standardizeName($name), $value, $type);
    return $this;
  }

  /**
   * 
   * 
   * @param  PDOStatement $statement
   * @return PDOStatement
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function executeIn(PDOStatement $statement): PDOStatement {
    try {
      $statement->execute($this->toArray());
      return $statement;
    } catch (PDOException $e) {
      throw new RuntimeException($e->getMessage(), 0, $e);
    }
  }

  public function contains($offset): bool {
    $this->standardizeName($offset);
    return parent::offsetExists($offset);
  }

  public function getParamValue($offset) {
    $this->standardizeName($offset);
    return parent::offsetGet($offset);
  }

  public function unsetParam($offset) {
    $this->standardizeName($offset);
    parent::unsetParam($offset);
    return $this;
  }

}
