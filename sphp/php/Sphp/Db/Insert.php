<?php

/**
 * Insert.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db;

use Sphp\Stdlib\Arrays;
use Sphp\Objects\DbObjectInterface as DbObjectInterface;

/**
 * An implementation of an SQL INSERT statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-04-02

 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Insert extends AbstractStatement implements DataManipulationStatement {

  /**
   * the table(s) that are updated
   *
   * @var string
   */
  private $table = "";

  /**
   * a list of column(s) to be included in the query
   *
   * @var string[]
   */
  private $columns = [];

  /**
   * a list of value(s) to be included in the query
   *
   * @var mixed[]
   */
  private $values = [];

  /**
   * Constructs a new instance
   *
   * @param  string $table the name of the target database table
   * @param  string|string[] $values
   * @throws \PDOException if there is no database connection or query execution fails
   */
  public function __construct($table = null, $values = null) {
    parent::__construct();
    if ($table !== null) {
      $this->table($table);
    }
    if ($values !== null) {
      $this->values($values);
    }
  }

  /**
   * Sets the database table where to insert the data
   *
   * @param  string $table an existing database table
   * @return self for a fluent interface
   */
  public function table($table) {
    $this->table = $table;
    return $this;
  }

  /**
   * Sets the values that are to be inserted to the table
   *
   * @param  array|DbObjectInterface|\Traversable $values
   * @return self for a fluent interface
   */
  public function values($values) {
    if ($values instanceof DbObjectInterface) {
      $values = $values->getInsertionData();
    } else if ($values instanceof Traversable) {
      $arr = array();
      foreach ($values as $key => $value) {
        $arr[$key] = $value;
      }
      $values = $arr;
    }
    if (!Arrays::isIndexed($values)) {
      $this->columnNames(array_keys($values));
    }
    $this->values = $values;
    return $this;
  }

  /**
   * Sets the order and the names of the columns in the INSERT data
   *
   * @param  string[] $columnNames
   * @return self for a fluent interface
   */
  public function columnNames($columnNames) {
    $this->columns = $columnNames;
    return $this;
  }

  /**
   * Resets the specific part of the query or the entire query if no parameter is given
   *
   *  Values and their explanations for parameter <var>$part</var>:
   *
   * * 'TABLE'   : removes the table definition from the query
   * * 'COLUMNS' : removes the column name definitions from the query
   * * 'VALUES'  : removes the new data values from the query
   *
   * @param  string $part the specified part
   * @return self for a fluent interface
   */
  public function reset($part = "") {
    switch ($part) {
      case "TABLE":
        $this->table = "";
        break;
      case "COLUMNS":
        $this->columns = array();
        break;
      case "VALUES":
        $this->values = array();
        break;
      default:
        $this->table = "";
        $this->columns = array();
        $this->values = array();
        break;
    }
    return $this;
  }

  public function statementToString() {
    $query = "INSERT INTO " . $this->table;
    if (count($this->columns) > 0) {
      $query .= " (" . implode(", ", $this->columns) . ")";
    }
    $qms = array_fill(0, count($this->values), "?");
    $query .= " VALUES (" . implode(", ", $qms) . ")";
    return $query;
  }

  public function getParams() {
    return array_values($this->values);
  }

  public function affectRows() {
    try {
      return $this->execute()->rowCount();
    } catch (Exception $ex) {
      throw new PDORelatedException($ex);
    }
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
      $query->where()->equals(array_combine($this->columns, $this->values));
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
