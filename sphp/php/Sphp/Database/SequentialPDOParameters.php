<?php

/**
 * TaskRunner.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;
use PDOStatement;
use PDOException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\RuntimeException;

/**
 * Base class for all SQL Statement classes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SequentialPDOParameters extends AbstractPDOParameters {

  /**
   * 
   * @param  mixed $value
   * @param  int $type
   * @return self for a fluent interface
   */
  public function appendParam($value, int $type = PDO::PARAM_STR) {
    $this->setParam(null, $value, $type);
    return $this;
  }

  /**
   * 
   * @param  string $name
   * @param  mixed $value
   * @param  int $type
   * @return self for a fluent interface
   */
  public function setParam($name, $value, int $type = PDO::PARAM_STR) {
    if ($name !== null && (!is_int($name) || $name < 0)) {
      throw new InvalidArgumentException('Offset must be zero or a positive integer');
    }
    parent::setParam($name, $value, $type);
    return $this;
  }

  /**
   * 
   * @param  array|Traversable $params
   * @return self for a fluent interface
   * @throws InvalidArgumentException
   */
  public function mergeParams($params) {
    if (!is_iterable($params) || is_array($params)) {
      throw new InvalidArgumentException('Merged data must be an iterable object or an array');
    }
    foreach ($params as $name => $value) {
      if (is_int($name)) {
        $this->setParam($name, $value);
      } else {
        $this->setParam(null, $value);
      }
    }
    return $this;
  }

  /**
   * Returns an array of values with as many elements as there are bound
   * parameters in the clause
   *
   * @return array values that are vulnerable to an SQL injection
   */
  public function getParamType($index): array {
    return $this->paramTypes[$index];
  }

}
