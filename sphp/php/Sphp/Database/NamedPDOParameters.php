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
class NamedPDOParameters extends AbstractPDOParameters {

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
   * @param  string $name  [:][a-zA-Z0-9_]+;
   * @param  mixed $value
   * @param  int $type
   * @return self for a fluent interface
   * @throws InvalidArgumentException
   */
  public function setParam($name, $value, int $type = PDO::PARAM_STR) {
    /*if (preg_match("/^[:]?[a-zA-Z]{1,}[a-zA-Z0-9_]+$/", $name) !== 1) {
      throw new InvalidArgumentException('Parameter name must be a string');
    }*/
    if (!\Sphp\Stdlib\Strings::startsWith($name, ':')) {
      $name = ":$name";
    }
    parent::setParam($name, $value, $type);
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

  public function offsetExists($offset): bool {
    if (is_string($offset) && substr($offset, 0, 1) !== ':') {
      $offset = ":$offset";
    }
    return parent::offsetExists($offset);
  }

  public function offsetGet($offset) {
    if (is_string($offset) && substr($offset, 0, 1) !== ':') {
      $offset = ":$offset";
    }
    return parent::offsetGet($offset);
  }

  public function offsetSet($offset, $value) {
    $this->setParam($offset, $value);
    return $this;
  }

  public function offsetUnset($offset) {
    if (is_string($offset) && !\Sphp\Stdlib\Strings::startsWith($offset, ':')) {
      $name = ":$name";
    }
    if ($this->offsetExists($offset)) {
      unset($this->paramTypes[$offset], $this->params[$offset]);
    }
    return $this;
  }

}
