<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data;

use Sphp\Stdlib\Datastructures\Arrayable;
use ArrayAccess;
use IteratorAggregate;
use ReflectionClass;
use Traversable;
use Sphp\Exceptions\OutOfRangeException;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Abstract implementation of a Data object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractDataObject implements ArrayAccess, Arrayable, IteratorAggregate {

  /**
   * @var ReflectionClass 
   */
  private $reflector;

  /**
   * Constructor
   * 
   * @param array|null $data optional data
   */
  public function __construct(array $data = null) {
    $this->reflector = new ReflectionClass($this);
    if ($data !== null) {
      $this->fromArray($data);
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->reflector);
  }

  /**
   * 
   * @param  array $data
   * @return $this for a fluent interface
   */
  public abstract function fromArray(array $data);

  public function toJson(): string {
    return json_encode($this->toArray(), JSON_PRETTY_PRINT);
  }

  public function __toString(): string {
    return $this->toJson();
  }

  public function getIterator(): Traversable {
    return new \ArrayIterator($this->toArray());
  }

  public function offsetExists($offset): bool {
    $getMethod = 'get' . ucfirst($offset);
    $setMethod = 'set' . ucfirst($offset);
    return $this->reflector->hasMethod($getMethod) && $this->reflector->hasMethod($setMethod);
  }

  public function offsetGet($offset) {
    if ($this->offsetExists($offset)) {
      $methodName = 'get' . ucfirst($offset);
      return $this->$methodName();
    } else {
      throw new OutOfRangeException("Offset '$offset' does not exist");
    }
  }

  /**
   * 
   * @param  string $offset
   * @param  mixed $value
   * @throws InvalidArgumentException
   * @throws OutOfRangeException
   */
  public function offsetSet($offset, $value) {
    if ($this->offsetExists($offset)) {
      $methodName = 'set' . ucfirst($offset);
      $f = $this->reflector->getMethod($methodName);
      if ($f->getNumberOfParameters() === 1) {
        $pars = $f->getParameters();
        var_dump($pars[0]->hasType());
        $f->invoke($this, $value);
      } else {
        throw new InvalidArgumentException("Offset '$offset' does not exist");
      }
    } else {
      throw new OutOfRangeException("Setting member variable failed: '$offset' does not exist");
    }
  }

  /**
   * 
   * @param  mixed $offset
   * @throws InvalidArgumentException
   * @throws OutOfRangeException
   */
  public function offsetUnset($offset) {
    if ($this->offsetExists($offset)) {
      $methodName = 'set' . ucfirst($offset);
      $reflectionFunc = $this->reflector->getMethod($methodName);
      $pars = $reflectionFunc->getParameters();
      if (count($pars) == 1 && $pars[0]->allowsNull()) {
        //echo 'unsetting';
        $reflectionFunc->invoke($this, null);
      } else {
        throw new InvalidArgumentException("Unsetting member variable failed: '$offset' cannot be NULL");
      }
    } else {
      throw new OutOfRangeException("Unsetting member variable failed: '$offset' does not exist");
    }
  }

}
