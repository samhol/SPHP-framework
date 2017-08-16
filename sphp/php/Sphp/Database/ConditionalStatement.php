<?php

/**
 * ConditionalStatement.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;

/**
 * Implements the conditions for statements in SQL
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @deprecated
 */
abstract class ConditionalStatement extends AbstractStatement {

  /**
   * the conditions in the WHERE part of the SELECT, UPDATE and INSERT queries
   *
   * @var Clause
   */
  private $where;

  /**
   * Constructs a new instance
   *
   * @param PDO $db
   * @param Clause $where
   */
  public function __construct(PDO $db, Clause $where = null) {
    if ($where === null) {
      $this->where = new Clause();
    } else {
      $this->where = $where;
    }
    parent::__construct($db);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->where);
    parent::__destruct();
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    parent::__clone();
    $this->where = clone $this->where;
  }

  /**
   * Sets The WHERE clause.
   *
   * The WHERE clause is used to filter records
   *
   * @param  Clause $c
   * @return self for a fluent interface
   */
  public function setWhere(Clause $c) {
    $this->where = $c;
    return $this;
  }

  /**
   * 
   * @return Clause
   */
  public function getWhere(): Clause {
    return $this->where;
  }

  /**
   * Adds rules to the WHERE conditions component
   *
   * **Important!**
   *
   * * **ALWAYS SANITIZE ALL USER INPUTS!**
   * * **If you are using multiple arguments; None of the arguments should be an array**
   *
   *  The WHERE clause includes a comparison predicate, which restricts the rows returned by the query.
   *  The WHERE clause eliminates all rows from the result set for which the comparison predicate does
   *  not evaluate to `true`.
   *
   * @param  string|RuleInterface|array $rules SQL condition(s)
   * @return self for a fluent interface
   */
  public function where(... $rules) {
    $obj = new Clause($rules);
    $this->where->fulfills($obj, 'AND');
    return $this;
  }

  /**
   * Appends SQL conditions by using logical AND as a conjunction
   *
   * @param  string|RuleInterface|array $rules SQL condition(s)
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function andWhere(... $rules) {
    $obj = new Clause($rules);
    $this->where->fulfills($obj, 'AND');
    return $this;
  }

  /**
   * Appends SQL conditions by using AND NOT as a conjunction
   *
   * @param  string|RuleInterface|array $rules SQL condition(s)
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function andNotWhere(... $rules) {
    $obj = new Clause($rules);
    $this->where->fulfills($obj, 'AND NOT');
    return $this;
  }

  /**
   * Appends SQL conditions by using logical OR as a conjunction
   *
   * @param  string|RuleInterface|array $rules SQL condition(s)
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function orWhere(... $rules) {
    $obj = new Clause($rules);
    $this->where->fulfills($obj, 'OR');
    return $this;
  }

  /**
   * Appends SQL conditions by using logical OR NOT as a conjunction
   *
   * @param  string|RuleInterface|array $rules SQL condition(s)
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function orNotWhere(... $rules) {
    $obj = new Clause($rules);
    $this->where->fulfills($obj, 'OR NOT');
    return $this;
  }

  /**
   * Checks if there are any SQL conditions set
   *
   * @return boolean conditions are set
   */
  public function hasConditions(): bool {
    return $this->where->notEmpty();
  }

  protected function conditionsToString(): string {
    $output = '';
    if ($this->hasConditions()) {
      $output .= " WHERE $this->where";
    }
    return $output;
  }

  public function getParams(): ParameterHandler {
    return $this->where->getParams();
  }

}
