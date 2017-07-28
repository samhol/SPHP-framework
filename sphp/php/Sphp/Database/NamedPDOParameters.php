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
use Iterator;

/**
 * Base class for all SQL Statement classes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class NamedPDOParameters extends PDOParameters {

  /**
   * 
   * @param  string $name
   * @param  mixed $value
   * @param  int $type
   * @return self for a fluent interface
   */
  public function setParam($name, $value, int $type = PDO::PARAM_STR) {
    if (is_numeric($name)) {
      throw new InvalidArgumentException('Parameter name must be a string');
    }
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
    return array_key_exists($offset, $this->params);
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
