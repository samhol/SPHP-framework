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
    parent::__construct();
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
   * @param  string $name 
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

  public function contains($offset): bool {
    return parent::offsetExists($this->standardizeName($offset));
  }

  public function getParamValue($offset) {
    return parent::offsetGet($this->standardizeName($offset));
  }

  public function unsetParam($offset) {
    parent::unsetParam($this->standardizeName($offset));
    return $this;
  }

}
