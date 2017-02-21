<?php

/**
 * Delete.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db;

use Sphp\Stdlib\Arrays;

/**
 * An implementation of a SQL DELETE statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-04-02

 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Delete extends ConditionalStatement implements DataManipulationStatement {

  /**
   * the table(s) that are updated
   *
   * @var string
   */
  private $tables = "";

  /**
   * Constructs a new instance
   *
   * @param  string $from the name of the target database table
   * @param  string|string[] $values
   * @throws \PDOException if there is no database connection or query execution fails
   */
  public function __construct($from = null, $values = null) {
    parent::__construct();
    if ($from !== null) {
      $this->from($from);
    }
    if ($values !== null) {
      $this->setConditions($values);
    }
  }

  /**
   * Sets the table(s) from where the data is to be deleted.
   *
   * @param  string|string[] $tables the table(s)
   * @return Delete this (used for method chaining)
   */
  public function from($tables) {
    if (func_num_args() > 0) {
      $tables = func_get_args();
    }
    if (!is_array($tables)) {
      $tables = [$tables];
    }
    $this->tables = implode(", ", Arrays::flatten($tables));
    return $this;
  }

  /**
   * Resets the specific part of the query or the entire query if no parameter is given
   *
   *  Values and their explanations for parameter <var>$part</var>:
   *
   * * 'WHERE'
   * * 'FROM'
   *
   * @param  string $part the specified part
   * @return Select this (used for method chaining)
   */
  public function reset($part = "") {
    switch ($part) {
      case "FROM":
        $this->tables = "";
        break;
      case "WHERE":
        $this->where()->reset();
        break;
      default:
        $this->where()->reset();
        $this->tables = "";
        break;
    }
    return $this;
  }

  public function statementToString() {
    $query = "DELETE FROM " . $this->tables;
    if ($this->where()->hasConditions()) {
      $query .= " WHERE " . $this->where();
    }
    return $query;
  }

  public function affectRows() {
    return $this->execute()->rowCount();
  }

}
