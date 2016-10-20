<?php

/**
 * Update.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db;

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
   * @return self for PHP Method Chaining
   */
  public function table($table) {
    $this->table = $table;
    return $this;
  }

  /**
   * Sets the updating data
   *
   * @param  mixed[]|DbObjectInterface $data new data
   * @return self for PHP Method Chaining
   */
  public function set($data) {
    if ($data instanceof DbObjectInterface) {
      $this->newData = $data->toArray();
    } else {
      $this->newData = $data;
    }
    return $this;
  }

  /**
   * Resets the specific part of the query or the entire query if no parameter is given
   *
   *  Values and their explanations for parameter <var>$part</var>:
   *
   * * 'COLUMNS'
   * * 'WHERE'
   * * 'FROM'
   *
   * @param  string $part the specified part
   * @return self for PHP Method Chaining
   */
  public function reset($part = self::ALL) {
    $types = new BitMask($part);
    if ($types->contains(self::RESET_WHERE)) {
      parent::reset();
    }
    if ($types->contains(self::RESET_COLUMNS)) {
      $this->columns = "*";
    }
    if ($types->contains(self::RESET_FROM)) {
      $this->from = "";
    }
    return $this;
  }

  public function statementToString() {
    $k = array_keys($this->newData);
    $a = implode(" = ?, ", $k);
    //echo $a;
    $query = "UPDATE " . $this->table . " SET $a = ?";
    //var_dump(array_keys($this->newData));
    //$a =  implode(" = ?, ", $k);
    //$query .= $a;
    if ($this->where()->hasConditions()) {
      $query .= " WHERE " . $this->where();
    }
    return $query;
  }

  public function getParams() {
    return array_merge(array_values($this->newData), parent::getParams());
  }

  public function affectRows() {
    return $this->execute()->rowCount();
  }

}
