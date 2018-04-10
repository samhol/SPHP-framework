<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Legacy;

use Sphp\Database\AbstractQuery;

/**
 * Legacy implementation of `SELECT` statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Query extends AbstractQuery {

  public function statementToString(): string {
    $query = 'SELECT ';
    $query .= " " . implode(', ', $this->getColumns());
    $query .= $this->fromToString();
    $query .= $this->conditionsToString();
    $query .= $this->groupByToString();
    $query .= $this->havingToString();
    $query .= $this->orderByToString();
    if ($this->hasLimit()) {
      $query .= " LIMIT {$this->getLimit()}";
      if ($this->getOffset() > 0) {
        $query .= " OFFSET {$this->getOffset()}";
      }
    }
    return $query;
  }

}
