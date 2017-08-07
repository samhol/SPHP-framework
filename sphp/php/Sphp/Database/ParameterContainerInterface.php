<?php

/**
 * ParameterContainerInterface.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;
use PDOStatement;
use Sphp\Exceptions\RuntimeException;
use Iterator;
use Countable;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Base class for all SQL Statement classes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ParameterContainerInterface extends \ArrayAccess, Iterator, Countable, Arrayable {

  /**
   * 
   * @param  mixed $name
   * @param  mixed $value
   * @param  int $type
   * @return self for a fluent interface
   */
  public function setParam($name, $value);

  /**
   * Returns an array of values with as many elements as there are bound
   * parameters in the clause
   *
   * @param  array $params
   * @param  int $type
   * @return self for a fluent interface
   */
  public function setParams(array $params, int $type = PDO::PARAM_STR);

  public function unsetParam($name);

  public function unsetParams();

  public function notEmpty(): bool;

  /**
   * Returns an array of values with as many elements as there are bound
   * parameters in the clause
   *
   * @return array values that are vulnerable to an SQL injection
   */
  public function getParamNames(): array;

  /**
   * Returns the type of the parameter stored
   *
   * @return array values that are vulnerable to an SQL injection
   */
  public function getValue($index);

  /**
   * Returns the type of the parameter stored
   *
   * @return array values that are vulnerable to an SQL injection
   */
  public function getParamType($index): int;
}
