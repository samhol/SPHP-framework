<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Predicates;

use IteratorAggregate;
use Sphp\Database\Parameters\ParameterHandler;
use Sphp\Database\Parameters\SequentialParameterHandler;
use Sphp\Database\Exceptions\BadMethodCallException;
use Sphp\Stdlib\Arrays;

/**
 * The PredicateSet class
 * 
 * Implements a collection of rules
 *
 * @method Equals andEquals(string $column, mixed $param, int $paramType = PDO::PARAM_STR) Adds AND Equals rule
 * @method Equals orEquals(string $column, mixed $param, int $paramType = PDO::PARAM_STR) Adds OR Equals rule
 * @method NotEquals andNotEquals(string $column, mixed $param, int $paramType = PDO::PARAM_STR) Adds AND Not Equals rule
 * @method NotEquals orNotEquals(string $column, mixed $param, int $paramType = PDO::PARAM_STR) Adds OR Not Equals rule
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PredicateSet implements Predicate, IteratorAggregate {

  /**
   * @var array<Rule|string>
   */
  private array $rules;

  /**
   * Constructor
   * 
   * @param array $rules
   */
  public function __construct(array $rules = []) {
    $this->rules = [];
    $this->fulfillsAll(...$rules);
  }

  /**
   * Destuctor
   */
  public function __destruct() {
    unset($this->rules);
  }

  public function __clone() {
    $this->rules = Arrays::copy($this->rules);
  }

  /**
   * 
   * @param  string $name
   * @param  array $arguments
   * @return $this for a fluent interface
   * @throws BadMethodCallException
   */
  public function __call(string $name, array $arguments) {
    preg_match('/^((?<op>and|or)(?<class>[A-Z][a-zA-Z]+))|(?<method>[a-z][a-zA-Z]+)$/', $name, $matches, PREG_UNMATCHED_AS_NULL);
    // var_dump($matches);

    $op = $matches['op'] ?? 'AND';

    //$op = strtoupper($op);
    $className = $matches['class'] ?? null;
    if ($className === null) {
      $className = $matches['method'] ?? null;
    }
    if ($className === null) {
      throw new BadMethodCallException("Bad method name $name");
    }
    $class = "Sphp\\Database\\Predicates\\" . ucfirst($className);
    if (!class_exists($class)) {
      throw new BadMethodCallException($class);
    }
    try {
      $rule = new $class(...$arguments);
    } catch (\Error $ex) {
      throw new BadMethodCallException('Invalid arguments provided for ' . $name . '() method', $ex->getCode(), $ex);
    }
    $this->fulfills($rule, strtoupper($op));
    return $this;
  }

  /**
   * 
   * @param  string|Predicate $rule
   * @param  string $conn
   * @return $this for a fluent interface
   */
  public function fulfills(string|Predicate $rule, string $conn = 'AND') {
    if (!empty($this->rules)) {
      $this->rules[] = $conn;
    }
    $this->rules[] = $rule;
    return $this;
  }

  /**
   * 
   * @param  Predicate|string ... $rules)
   * @return $this for a fluent interface
   */
  public function fulfillsAll(Predicate|string ... $rules) {
    foreach ($rules as $rule) {
      $this->fulfills($rule, 'AND');
    }
    return $this;
  }

  public function getParams(): ParameterHandler {
    $params = new SequentialParameterHandler();
    foreach ($this as $part) {
      if ($part instanceof Predicate) {
        $parArr = $part->getParams();
        $params->appendParams($parArr);
      }
    }
    return $params;
  }

  public function __toString(): string {
    $output = '';
    foreach ($this->rules as $rule) {
      if ($rule instanceof PredicateSet && $rule->notEmpty()) {
        $output .= "($rule) ";
      } else {
        $output .= "$rule ";
      }
    }
    return trim($output);
  }

  public function notEmpty(): bool {
    return !empty($this->rules);
  }

  public function getIterator(): \Traversable {
    yield from $this->rules;
  }

}
