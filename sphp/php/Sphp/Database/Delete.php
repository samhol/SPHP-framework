<?php

/**
 * Delete.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

/**
 * An implementation of a SQL DELETE statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Delete extends ConditionalStatement implements DataManipulationStatement {

  /**
   * the target table
   *
   * @var string
   */
  private $table;

  /**
   * Sets the table from where the data is to be deleted
   *
   * @param  string $table the table
   * @return self for a fluent interface
   */
  public function from(string $table) {
    $this->table = $table;
    return $this;
  }

  public function statementToString(): string {
    return "DELETE FROM `$this->table`" . $this->conditionsToString();
  }

  public function affectRows(): int {
    return $this->execute()->rowCount();
  }

}
