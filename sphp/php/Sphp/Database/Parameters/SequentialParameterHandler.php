<?php

declare(strict_types=1);
/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Parameters;

use IteratorAggregate;
use Traversable;
use PDOStatement;
use PDOException;
use Sphp\Database\Exceptions\DatabaseException;

/**
 * Abstract implementation of parameter handler
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SequentialParameterHandler implements IteratorAggregate, ParameterHandler {

  /**
   * @var Parameter[]
   */
  private array $parameters;

  /**
   * Constructor
   */
  public function __construct() {
    $this->parameters = [];
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->parameters);
  }

  /**
   * Clones the instance
   */
  public function __clone() {
    foreach ($this->parameters as $index => $parameter) {
      $this->parameters[$index] = clone $parameter;
    }
  }

  /**
   * Creates and appends new parameter(s) to the handler
   * 
   * @param  mixed $values value(s) for new parameter(s)
   * @param  int|null $type optional PDO parameter type for new parameter(s)
   * @return $this for a fluent interface
   * @see    Parameter
   */
  public function appendNewParams(mixed $values, ?int $type = null) {
    if (is_iterable($values)) {
      foreach ($values as $value) {
        $this->appendNewParams($value, $type);
      }
    } else {
      $this->appendParam(new Parameter($values, $type));
    }
    return $this;
  }

  /**
   * Appends new parameter(s) to the handler
   * 
   * @param  Parameter $p
   * @return $this for a fluent interface
   */
  public function appendParam(Parameter $p) {
    if ($this->isEmpty()) {
      $this->parameters[1] = $p;
    } else {
      $this->parameters[] = $p;
    }
    return $this;
  }

  /**
   * Appends parameter(s) from a collection
   * 
   * @param  iterable<Parameter> $params
   * @return $this for a fluent interface
   */
  public function appendParams(iterable $params) {
    foreach ($params as $value) {
      $this->appendParam($value);
    }
    return $this;
  }

  public function isEmpty(): bool {
    return empty($this->parameters);
  }

  public function count(): int {
    return count($this->parameters);
  }

  public function bindTo(PDOStatement $statement): void {
    try {
      foreach ($this->parameters as $index => $param) {
        $statement->bindValue($index, $param->getValue(), $param->getType());
      }
    } catch (PDOException $e) {
      throw new DatabaseException($e->getMessage(), $e->getCode(), $e);
    }
  }

  /**
   * 
   * @return Traversable<int, Parameter>
   */
  public function getIterator(): Traversable {
    yield from $this->parameters;
  }

}
