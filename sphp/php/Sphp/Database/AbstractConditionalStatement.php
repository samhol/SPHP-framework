<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database;

use PDO;
use Sphp\Database\Rules\Clause;
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
   * the conditions in the WHERE part of the SELECT, UPDATE and INSERT queries
   *
   * @var Clause
   */
  private $where;

  /**
   * Constructor
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

  public function setWhere(Clause $c) {
    $this->where = $c;
    return $this;
  }

  public function getWhere(): Clause {
    return $this->where;
  }

  public function where(... $rules) {
    $obj = new Clause($rules);
    $this->where->fulfills($obj, 'AND');
    return $this;
  }

  public function andWhere(... $rules) {
    $obj = new Clause($rules);
    $this->where->fulfills($obj, 'AND');
    return $this;
  }

  public function andNotWhere(... $rules) {
    $obj = new Clause($rules);
    $this->where->fulfills($obj, 'AND NOT');
    return $this;
  }

  public function orWhere(... $rules) {
    $obj = new Clause($rules);
    $this->where->fulfills($obj, 'OR');
    return $this;
  }

  public function orNotWhere(... $rules) {
    $obj = new Clause($rules);
    $this->where->fulfills($obj, 'OR NOT');
    return $this;
  }

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
