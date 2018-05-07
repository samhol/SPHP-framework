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
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Named parameter handler
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class NamedParameterHandler extends AbstractParameterHandler {

  /**
   * Constructor
   * 
   * @param mixed $params
   */
  public function __construct($params = null) {
    parent::__construct();
    if ($params !== null) {
      $this->mergeParams($params);
    }
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
   * @param  string $name 
   * @param  mixed $value
   * @param  int $type
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function setParam($name, $value, int $type = PDO::PARAM_STR) {
    if (!is_string($name)) {
      throw new InvalidArgumentException('Parameter name must be a string');
    }
    parent::setParam($this->standardizeName($name), $value, $type);
    return $this;
  }

  public function contains($offset): bool {
    return parent::offsetExists($this->standardizeName($offset));
  }

  public function getParamValue($offset) {
    return parent::offsetGet($this->standardizeName($offset));
  }

  /**
   * 
   * @param  string $offset
   * @return $this for a fluent interface
   */
  public function unsetParam($offset) {
    parent::unsetParam($this->standardizeName($offset));
    return $this;
  }

}
