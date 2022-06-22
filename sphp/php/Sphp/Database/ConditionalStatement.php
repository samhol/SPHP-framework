<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database;

use Sphp\Database\Predicates\Predicate;
use Sphp\Database\Clauses\Where;

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
   * @param  Where|null $where
   * @return $this for a fluent interface
   */
  public function resetWhere(?Where $where = null);

  /**
   * Adds rules to the `WHERE` conditions component and returns the WHERE clause
   *  
   * * The `WHERE` clause includes a comparison predicate, which restricts the rows returned by the query.
   * * The `WHERE` clause eliminates all rows from the result set for which the comparison predicate does
   *   not evaluate to `true`.
   *
   * @param  Predicate|string ... $rules `SQL` condition(s)
   * @return Where
   */
  public function where(Predicate|string ... $rules): Where;
}
