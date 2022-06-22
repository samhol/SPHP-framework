<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Clauses;

use IteratorAggregate;
use Sphp\Database\Predicates\PredicateSet;
use Sphp\Database\Predicates\Predicate;
use Sphp\Database\Parameters\SequentialParameterHandler;
use Sphp\Database\Parameters\ParameterHandler;

/**
 * The AbstractClause class
 * 
 * @method Equals equals(string $column, mixed $param, ?int $paramType = null) Adds AND Equals rule
 * @method Equals orEquals(string $column, mixed $param, ?int $paramType = null) Adds OR Equals rule
 * @method NotEquals notEquals(string $column, mixed $param, ?int $paramType = null) Adds AND Not Equals rule
 * @method NotEquals orNotEquals(string $column, mixed $param, ?int $paramType = null) Adds OR Not Equals rule
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractClause implements IteratorAggregate {

  private string $name;
  private PredicateSet $predicateSet;

  /**
   * Constructor
   * 
   * @param string $name
   * @param Predicate|string|null $predicateSet
   */
  public function __construct(string $name, ?PredicateSet $predicateSet = null) {
    $this->name = $name;
    if (!$predicateSet instanceof PredicateSet) {
      $predicateSet = new PredicateSet();
    }
    $this->predicateSet = $predicateSet;
  }

  public function __destruct() {
    unset($this->predicateSet);
  }

  public function __clone() {
    $this->predicateSet = clone $this->predicateSet;
  }

  public function getRuleSet(): PredicateSet {
    return $this->predicateSet;
  }

  /**
   * 
   * @param  string $name
   * @param  array $arguments
   * @return Predicate
   * @throws BadMethodCallException
   */
  public function __call(string $name, array $arguments): Predicate {
    return $this->predicateSet->__call($name, $arguments);
  }

  /**
   * Adds new rule set connected with Logical AND Operators 
   * 
   * @param  Predicate|string ... $rules
   * @return PredicateSet new rule set
   */
  public function andThese(Predicate|string ... $rules): PredicateSet {
    $out = new PredicateSet($rules);
    $this->predicateSet->fulfills($out, 'AND');
    return $out;
  }

  /**
   * Adds new rule set connected with Logical OR Operators 
   * 
   * @param  Predicate|string ... $rules
   * @return PredicateSet new rule set
   */
  public function orThese(Predicate|string ... $rules): PredicateSet {
    $out = new PredicateSet($rules);
    $this->predicateSet->fulfills($out, 'OR');
    return $out;
  }

  public function notEmpty(): bool {
    return $this->predicateSet->notEmpty();
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

  public function getIterator(): \Traversable {
    yield from $this->predicateSet;
  }

  public function __toString() {
    $out = '';
    if ($this->notEmpty()) {
      $out = "$this->name $this->predicateSet";
    }
    return $out;
  }

}
