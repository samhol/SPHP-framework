<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database;

use Sphp\Database\Rules\Clause;
use Sphp\Database\Rules\RuleInterface;

/**
 * Defines a conditional `SQL` statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ConditionalStatement extends Statement {

  /**
   * Sets the `WHERE` clause
   *
   * The `WHERE` clause is used to filter records
   *
   * @param  Clause $c
   * @return $this for a fluent interface
   */
  public function setWhere(Clause $c);

  /**
   * Returns the `WHERE` clause
   * 
   * @return Clause the `WHERE` clause
   */
  public function getWhere(): Clause;

  /**
   * Adds rules to the `WHERE` conditions component
   *
   * **Important!**
   *
   * * **ALWAYS SANITIZE ALL USER INPUTS!**
   * * **If you are using multiple arguments; None of the arguments should be an array**
   *
   *  The `WHERE` clause includes a comparison predicate, which restricts the rows returned by the query.
   *  The `WHERE` clause eliminates all rows from the result set for which the comparison predicate does
   *  not evaluate to `true`.
   *
   * @param  string|RuleInterface|array $rules `SQL` condition(s)
   * @return $this for a fluent interface
   */
  public function where(... $rules);

  /**
   * Appends `SQL` conditions by using logical `AND` as a conjunction
   *
   * @param  string|RuleInterface|array $rules `SQL` condition(s)
   * @return $this for a fluent interface
   */
  public function andWhere(... $rules);

  /**
   * Appends `SQL` conditions by using `AND NOT` as a conjunction
   *
   * @param  string|RuleInterface|array $rules `SQL` condition(s)
   * @return $this for a fluent interface
   */
  public function andNotWhere(... $rules);

  /**
   * Appends `SQL` conditions by using logical `OR` as a conjunction
   *
   * @param  string|RuleInterface|array $rules `SQL` condition(s)
   * @return $this for a fluent interface
   */
  public function orWhere(... $rules);

  /**
   * Appends `SQL` conditions by using logical `OR NOT` as a conjunction
   *
   * @param  string|RuleInterface|array $rules `SQL` condition(s)
   * @return $this for a fluent interface
   */
  public function orNotWhere(... $rules);

  /**
   * Checks if there are any `SQL` conditions set
   *
   * @return boolean conditions are set
   */
  public function hasConditions(): bool;
}
