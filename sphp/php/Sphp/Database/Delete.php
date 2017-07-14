<?php

/**
 * Delete.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use Sphp\Stdlib\Arrays;
use PDO;
/**
 * An implementation of a SQL DELETE statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Delete extends ConditionalStatement implements DataManipulationStatement {

  /**
   * the table(s) that are updated
   *
   * @var string
   */
  private $tables = [];

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

  public function statementToString(): string {
    $query = "DELETE FROM " . $this->tables;
    if ($this->conditions()->hasConditions()) {
      $query .= " WHERE " . $this->conditions();
    }
    return $query;
  }

  public function affectRows(): int {
    return $this->execute()->rowCount();
  }

}
