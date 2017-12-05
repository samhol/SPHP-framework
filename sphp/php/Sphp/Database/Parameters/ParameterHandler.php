<?php

/**
 * ParameterHandler.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database\Parameters;

use PDO;
use PDOStatement;
use Iterator;
use Countable;
use Sphp\Stdlib\Datastructures\Arrayable;
use Sphp\Database\Exceptions\DatabaseException;

/**
 * Base class for all SQL Statement classes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ParameterHandler extends \ArrayAccess, Iterator, Countable, Arrayable {

  /**
   * Stores a parameter to the handler
   * 
   * @param  mixed $name the name (or key) of the parameter
   * @param  mixed $value the value of the parameter
   * @param  int $type the PDO parameter type of the parameter
   * @return $this for a fluent interface
   */
  public function setParam($name, $value);

  /**
   * Stores an array of parameter name value pairs
   *
   * @param  array $params parameter name value pairs
   * @param  int $type the PDO parameter type of the parameters
   * @return $this for a fluent interface
   */
  public function setParams(array $params, int $type = PDO::PARAM_STR);

  public function unsetParam($name);

  public function unsetParams();

  public function notEmpty(): bool;

  /**
   * Returns the value of the parameter stored
   *
   * @return mixed the value of the parameter stored
   */
  public function getParamValue($index);

  /**
   * Returns the type of the parameter stored
   *
   * @return int the type of the parameter stored
   */
  public function getParamType($index): int;

  /**
   * Binds the managed parameters to the given statement
   * 
   * @param  PDOStatement $statement the statement object
   * @return PDOStatement the statement object
   * @throws DatabaseException if the binding fails
   */
  public function bindTo(PDOStatement $statement): PDOStatement;

  /**
   * Executes the given statement using managed parameters
   * 
   * @param  PDOStatement $statement the statement object
   * @return PDOStatement the statement object
   * @throws DatabaseException if the execution fails
   */
  public function executeIn(PDOStatement $statement): PDOStatement;
}
