<?php

/**
 * Update.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;

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
  private $table = '';

  /**
   * a list of column(s) to be included in the query
   *
   * @var array
   */
  private $newData;

  /**
   * a list of column(s) to be included in the query
   *
   * @var array
   */
  private $cols = [];

  /**
   * Constructs a new instance
   * 
   * @param PDO $db
   * @param Clause $where
   */
  public function __construct(PDO $db, Clause $where = null) {
    parent::__construct($db, $where);
    $this->newData = new SequentialParameters();
  }

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
    $this->newData = new SequentialParameters($data);
    $this->cols = array_keys($data);
    return $this;
  }

  public function getParams(): ParameterHandler {
    return $this->newData->appendParams(parent::getParams());
  }

  protected function valuesToString(): string {
    $names = array_map(function($name) {
      return "$name = ?";
    }, $this->cols);
    return implode(', ', $names);
  }

  public function statementToString(): string {
    $query = "UPDATE `$this->table` SET {$this->valuesToString()}";
    $query .= $this->conditionsToString();
    return $query;
  }

  public function affectRows(): int {
    return $this->execute()->rowCount();
  }

}
