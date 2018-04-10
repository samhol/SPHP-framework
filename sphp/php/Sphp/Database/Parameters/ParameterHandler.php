<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Parameters;

use PDO;
use PDOStatement;
use Traversable;
use Countable;
use ArrayAccess;
use Sphp\Stdlib\Datastructures\Arrayable;
use Sphp\Database\Exceptions\DatabaseException;

/**
 * Defines a parameter handler
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ParameterHandler extends ArrayAccess, Traversable, Countable, Arrayable {

  /**
   * Stores a parameter to the handler
   * 
   * @param  mixed $name the name (or key) of the parameter
   * @param  mixed $value the value of the parameter
   * @param  int $type the PDO parameter type of the parameter
   * @return $this for a fluent interface
   */
  public function setParam($name, $value, int $type = PDO::PARAM_STR);

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
   * @link   http://php.net/manual/en/class.pdostatement.php The PDOStatement class
   */
  public function bindTo(PDOStatement $statement): PDOStatement;

  /**
   * Executes the given statement using managed parameters
   * 
   * @param  PDOStatement $statement the statement object
   * @return PDOStatement the statement object
   * @throws DatabaseException if the execution fails
   * @link   http://php.net/manual/en/class.pdostatement.php The PDOStatement class
   */
  public function executeIn(PDOStatement $statement): PDOStatement;
}
