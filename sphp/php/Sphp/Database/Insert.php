<?php

/**
 * Insert.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;

/**
 * An implementation of an SQL INSERT statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Insert extends AbstractStatement implements DataManipulationStatement {

  /**
   * the table(s) that are updated
   *
   * @var string
   */
  private $table = '';

  /**
   * a list of column(s) to be included in the query
   *
   * @var string[]
   */
  private $names = [];

  /**
   * a list of value(s) to be included in the query
   *
   * @var mixed[]
   */
  private $values = [];

  public function __construct(PDO $pdo) {
    parent::__construct(new PDORunner($pdo));
  }

  /**
   * Sets the database table where to insert the data
   *
   * @param  string $table an existing database table
   * @return self for a fluent interface
   */
  public function into(string $table) {
    $this->table = $table;
    return $this;
  }

  /**
   * Sets the values that are to be inserted to the table
   *
   * @param  mixed $values
   * @return self for a fluent interface
   */
  public function values(... $values) {
    array_unshift($values, '');
    unset($values[0]);
    $this->getPDORunner()->setParams($values);
    return $this;
  }

  /**
   * Sets the values that are to be inserted to the table
   *
   * @param  array $values
   * @return self for a fluent interface
   */
  public function valuesFromArray(array $values) {
    $this->getPDORunner()->setParams($values);
    return $this;
  }

  /**
   * Sets the order and the names of the columns in the INSERT data
   *
   * @param  string $name
   * @return self for a fluent interface
   */
  public function columnNames(string ... $name) {
    $this->names = $name;
    return $this;
  }

  public function statementToString(): string {
    $query = "INSERT INTO `$this->table`";
    if (!empty($this->names)) {
      $query .= " (" . implode(', ', $this->names) . ") ";
    }
    if ($this->getPDORunner()->hasNamedParams()) {
      if (!empty($this->names)) {
        $fields = array_map(function($value) {
          return ":$value";
        }, $this->names);
      } else {
        $fields = $this->getPDORunner()->getParamNames();
      }
      $query .= ' VALUES (' . implode(', ', $fields) . ') ';
    } else {
      $query .= ' VALUES (?';
      for ($i = 2; $i <= count($this->getParams()); $i++) {
        $query .= ", ?";
      }
    }
    return "$query)";
  }

  public function affectRows(): int {
    return $this->execute()->rowCount();
  }

  /**
   * Executes the INSERT SQL statement, returning the number of affected rows
   *
   * @param  string $indexField Description
   * @return int the number of affected rows
   * @throws \PDOException if there is no database connection or query execution fails
   */
  public function affectData($indexField = null) {
    if ($this->affectRows() == 1) {
      //$temp = $this->getConnection()->lastInsertId($indexField);
      //echo "\nid: $temp\n";
      //$temp = $this->fetch(PDO::FETCH_ASSOC);
      $query = (new Query($this->getConnection()))->from($this->table);
      $query->where()->equals(array_combine($this->names, $this->values));
      //echo $query;
      return $query->fetchArray();
    }
    return [];
  }

  /**
   * Returns the bound parameters as an array
   *
   * @return mixed[] the bound parameters
   */
  public function executeAsTransaction() {
    $dbh = $this->getConnection();
    try {
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $dbh->beginTransaction();
      $statement = $dbh->prepare($this->getStatement());
      $statement->execute($this->values);
      $dbh->commit();
    } catch (\Exception $e) {
      $dbh->rollBack();
      throw new SQLException("Error in SQL execution", "", $e);
    }
  }

}
