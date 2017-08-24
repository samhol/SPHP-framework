<?php

/**
 * Query.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database\Legacy;

use Sphp\Database\AbstractQuery;

/**
 * An implementation of a SQL SELECT statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
