<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Database;

use PDO;
use PDOStatement;
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
interface ParameterHandler extends \ArrayAccess, Iterator, Countable, Arrayable {

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
  public function getParamValue($index);

  /**
   * Returns the type of the parameter stored
   *
   * @return array values that are vulnerable to an SQL injection
   */
  public function getParamType($index): int;

  /**
   * 
   * @return PDOStatement
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function bindTo(PDOStatement $statement): PDOStatement;

  /**
   * 
   * 
   * @param  PDOStatement $statement
   * @return PDOStatement
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function executeIn(PDOStatement $statement): PDOStatement;
}
