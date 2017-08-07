<?php

/**
 * SimpleParameterContainer.php (UTF-8)
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
class SingleParameterContainer implements \Sphp\Stdlib\Datastructures\Arrayable {

  private $name;
  private $value;
  private $type;

  /**
   * Constructs a new instance
   * 
   * @param mixed $params
   */
  public function __construct($name, $value, int $type = PDO::PARAM_STR) {
    $this->setName($name)->setValue($value)->setType($type);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->value);
  }

  public function getName() {
    return $this->name;
  }

  public function getType() {
    return $this->type;
  }

  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  public function setValue($value) {
    $this->value = $value;
    return $this;
  }

  public function setType(int $type) {
    $this->type = $type;
    return $this;
  }

  public function getValue() {
    return $this->value;
  }

  /**
   * Returns an array of values with as many elements as there are bound
   * parameters in the clause
   *
   * @return array values that are vulnerable to an SQL injection
   */
  public function toArray(): array {
    return [$this->getName() => $this->getValue()];
  }

}
