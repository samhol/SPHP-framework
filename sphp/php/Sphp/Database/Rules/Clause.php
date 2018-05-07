<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Rules;

use Iterator;
use Sphp\Database\Parameters\ParameterHandler;
use Sphp\Database\Parameters\SequentialParameterHandler;

/**
 * Implements a collection of rules
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Clause implements RuleInterface, Iterator {

  /**
   * @var array 
   */
  private $rules;

  /**
   * Constructor
   * 
   * @param array $rules
   */
  public function __construct(array $rules = []) {
    $this->rules = [];
    $this->fulfillsAll($rules);
  }

  /**
   * 
   * @param  mixed $rule
   * @param  string $conn
   * @return $this for a fluent interface
   */
  public function fulfills($rule, string $conn = 'AND') {
    if (!empty($this->rules)) {
      $this->rules[] = $conn;
    }
    $this->rules[] = $rule;
    return $this;
  }

  /**
   * 
   * @param  array $rules
   * @return $this for a fluent interface
   */
  public function fulfillsAll(array $rules) {
    foreach ($rules as $rule) {
      if ($rule instanceof RuleInterface) {
        $this->fulfills($rule);
      } else if (is_string($rule)) {
        $this->fulfills($rule);
      } else {
        $this->fulfills(Rule::create($rule));
      }
    }
    return $this;
  }

  public function getParams(): ParameterHandler {
    $params = new SequentialParameterHandler();
    foreach ($this as $part) {
      if ($part instanceof RuleInterface) {
        $parArr = $part->getParams();
        $params->appendParams($parArr);
      }
    }
    return $params;
  }

  public function getSQL(): string {
    $output = '';
    foreach ($this->rules as $rule) {
      if ($rule instanceof Clause) {
        $output .= "($rule) ";
      } else {
        $output .= "$rule ";
      }
    }
    return trim($output);
  }

  public function __toString(): string {
    return $this->getSQL();
  }

  public function notEmpty(): bool {
    return !empty($this->rules);
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->rules);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->rules);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->rules);
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    reset($this->rules);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->rules);
  }

}
