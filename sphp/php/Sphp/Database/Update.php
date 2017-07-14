<?php

/**
 * Update.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use Sphp\Objects\DbObjectInterface as DbObjectInterface;

/**
 * An implementation of an SQL UPDATE statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-04-02

 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Update extends ConditionalStatement implements DataManipulationStatement {

  /**
   * the table that are updated
   *
   * @var string
   */
  private $table = "";

  /**
   * a list of column(s) to be included in the query
   *
   * @var string
   */
  private $newData = [];

  /**
   * Sets the table(s) which are updated
   *
   * @param  string $table the table to update
   * @return self for a fluent interface
   */
  public function table(string $table) {
    $this->table = $table;
    return $this;
  }

  /**
   * Sets the updating data
   *
   * @param  array $data new data
   * @return self for a fluent interface
   */
  public function set(array $data) {
    $this->newData = $data;
    return $this;
  }

  public function statementToString(): string {
    $k = array_keys($this->newData);
    $a = implode(" = ?, ", $k);
    //echo $a;
    $query = "UPDATE " . $this->table . " SET $a = ?";
    //var_dump(array_keys($this->newData));
    //$a =  implode(" = ?, ", $k);
    //$query .= $a;
    if ($this->conditions()->hasConditions()) {
      $query .= " WHERE " . $this->conditions();
    }
    return $query;
  }

  public function getParams(): array {
    return array_merge(array_values($this->newData), parent::getParams());
  }

  public function affectRows(): int {
    return $this->execute()->rowCount();
  }

}
