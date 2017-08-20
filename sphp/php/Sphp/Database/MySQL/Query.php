<?php

/**
 * Query.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database\MySQL;

use Sphp\Database\AbstractQuery;

/**
 * An implementation of a SQL SELECT statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Query extends AbstractQuery {

  /**
   * result limit
   *
   * @var int  
   */
  private $limit = '';

  /**
   * Limits the result rows
   *
   * The actual approach to do this often varies per vendor and therefore
   * this method is currently supported  only for the following engines
   *
   * * Netezza
   * * MySQL
   * * Sybase SQL Anywhere
   * * PostgreSQL (also supports the standard, since version 8.4)
   * * SQLite
   * * HSQLDB
   * * H2
   * * Vertica
   * * Polyhedra
   *
   * @param  int $limit the maximum number of rows to return
   * @param  mixed $offset the offset of the initial row
   * @return $this for a fluent interface
   */
  public function limit(int $limit, int $offset = 0) {
    $this->limit = '';
    if ($limit > 0) {
      $this->limit .= " LIMIT $limit ";
      if ($offset > 0) {
        $this->limit .= " OFFSET $offset ";
      }
    }
    return $this;
  }

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
