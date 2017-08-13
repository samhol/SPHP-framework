<?php

/**
 * Rules.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use Iterator;

/**
 * Implements a collection of rules
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-08-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Rules implements RuleInterface, Iterator {

  /**
   * @var array 
   */
  private $rules;

  /**
   * Constructs a new instance
   * 
   * @param string $sql
   * @param mixed $params
   */
  public function __construct(array $rules = []) {
    $this->rules = [];
    $this->appendRules($rules);
  }

  public function append(RuleInterface $rule, string $conn = 'AND') {
    if (!empty($this->rules)) {
      $this->rules[] = $conn;
    }
    $this->rules[] = $rule;
  }

  public function appendRules(array $rules) {
    foreach ($rules as $rule) {
      if (is_array($rule) && count($rule) > 2) {
        $this->append(Rule::compare(array_shift($rule), array_shift($rule), array_shift($rule)));
      } else if ($rule instanceof RuleInterface) {
        $this->append($rule);
      } else if (is_string($rule)) {
        $this->append(new Rule($rule));
      } else {
        echo 'vitun kettu';
      }
    }
  }

  public function getParams(): ParameterHandler {
    $params = new SequentialParameters();
    foreach ($this as $part) {
      if ($part instanceof RuleInterface) {
        $parArr = $part->getParams()->toArray();
        $params->appendParams($parArr);
      }
    }
    return $params;
  }

  public function getSQL(): string {
    $output = '';
    foreach ($this->rules as $rule) {
      if ($rule instanceof Rules) {
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
