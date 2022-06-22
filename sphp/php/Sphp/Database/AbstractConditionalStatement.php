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

use PDO;
use Sphp\Database\Clauses\Where;
use Sphp\Database\Predicates\Predicate;
use Sphp\Database\Parameters\ParameterHandler;

/**
 * Implements the conditions for statements in SQL
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractConditionalStatement extends AbstractStatement implements ConditionalStatement {

  /**
   * The conditions in the WHERE part of the `SELECT`, `UPDATE` and `DELETE` queries 
   */
  protected Where $where;

  /**
   * Constructor
   * 
   * @param PDO $db database connection
   * @param Where $where optional WHERE clause
   */
  public function __construct(PDO $db, Where $where = null) {
    if ($where === null) {
      $where = new Where();
    }
    $this->where = $where;
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
   * @link https://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    parent::__clone();
    $this->where = clone $this->where;
  }

  public function resetWhere(?Where $where = null) {
    if ($where === null) {
      $where = new Where();
    }
    $this->where = $where;
    return $this;
  }

  public function where(Predicate|string ... $rules): Where {
    $this->where->andThese(...$rules);
    return $this->where;
  }

  public function getParams(): ParameterHandler {
    return $this->where->getParams();
  }

}
