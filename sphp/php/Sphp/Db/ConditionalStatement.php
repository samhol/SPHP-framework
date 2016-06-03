<?php

/**
 * ConditionalStatement.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db;

/**
 * Class implements the conditions for statements in SQL
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-04-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @deprecated
 */
abstract class ConditionalStatement extends AbstractStatement {

  const ALL = 0b111111111111111111;
  const WHERE = 0b1;

  /**
   * the conditions in the WHERE part of the SELECT, UPDATE and INSERT queries
   *
   * @var Conditions
   */
  private $where;

  /**
   * Constructs a new instance
   *
   * @param  Conditions $where
   * @throws \PDOException if no database connection was established
   */
  public function __construct(Conditions $where = null) {
    if ($where === null) {
      $this->where = new Conditions();
    } else {
      $this->where = $where;
    }
    parent::__construct();
  }

  /**
   * Sets The WHERE clause.
   *
   * The WHERE clause is used to filter records
   *
   * @param  Conditions $c
   * @return self for PHP Method Chaining
   */
  public function setConditions(Conditions $c) {
    $this->where = $c;
    return $this;
  }

  /**
   * Returns the WHERE conditions component
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
   * @return Conditions
   */
  public function where() {
    return $this->where;
  }

  /**
   * Returns the bound parameters as an array
   *
   * @return mixed[] the bound parameters
   */
  public function getParams() {
    return $this->where()->getParams();
  }

  /**
   * Resets the specific part of the query or the entire query if no parameter is given
   *
   * @return self for PHP Method Chaining
   */
  public function reset() {
    $this->where()->reset();
    return $this;
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->where = clone $this->where;
  }

}
