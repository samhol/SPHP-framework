<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Parameters;

use ArrayAccess;
use PDO;
use Traversable;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Sequential parameter handler
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SequentialParameterHandler extends AbstractParameterHandler implements ArrayAccess {

  /**
   * Constructor
   * 
   * @param mixed $params
   */
  public function __construct($params = null) {
    parent::__construct();
    if ($params !== null) {
      $this->appendParams($params);
    }
  }

  /**
   * 
   * @param  mixed $value
   * @param  int $type
   * @return $this for a fluent interface
   */
  public function appendParam($value, int $type = PDO::PARAM_STR) {
    $name = $this->count() + 1;
    $this->setParam($name, $value, $type);
    return $this;
  }

  /**
   * 
   * @param array|Traversable $params
   * @param int $type
   * @return $this for a fluent interface
   */
  public function appendParams($params, int $type = PDO::PARAM_STR) {
    foreach ($params as $value) {
      $this->appendParam($value, $type);
    }
    return $this;
  }

  public function setParam($name, $value, int $type = PDO::PARAM_STR) {
    if ($name !== null && (!is_int($name) || $name <= 0)) {
      throw new InvalidArgumentException('Offset must be zero or a positive integer');
    }
    if ($name === null) {
      $name = $this->count() + 1;
    }
    parent::setParam($name, $value, $type);
    return $this;
  }

  /**
   * 
   * @param  array|Traversable $params
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function mergeParams($params) {
    if (!is_array($params) && !$params instanceof \Traversable) {
      throw new InvalidArgumentException('Merged data must be an iterable object or an array');
    }
    foreach ($params as $name => $value) {
      if (is_int($name)) {
        $this[$name] = $value;
      } else {
        $this[] = $value;
      }
    }
    return $this;
  }

  /**
   * Returns an array of values with as many elements as there are bound
   * parameters in the clause
   *
   * @param  array $params
   * @param  int $type
   * @return $this for a fluent interface
   */
  public function setParams(array $params, int $type = PDO::PARAM_STR) {
    foreach ($params as $name => $value) {
      $this->setParam($name, $value, $type);
    }
    return $this;
  }

}
