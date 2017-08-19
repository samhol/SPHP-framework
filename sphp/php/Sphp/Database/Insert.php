<?php

/**
 * Insert.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use Traversable;
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
   * @var ParametersHandler
   */
  private $values;

  public function __construct(PDO $pdo) {
    parent::__construct($pdo);
    $this->values = new SequentialParameters();
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
    $this->setParams(new SequentialParameters($values));
    return $this;
  }

  /**
   * Sets the values that are to be inserted to the table
   *
   * @param  array|Traversable $values
   * @return self for a fluent interface
   */
  public function valuesFromCollection($values) {
    if ($values instanceof Traversable) {
      $values = iterator_to_array($values);
    }
    if (!\Sphp\Stdlib\Arrays::isIndexed($values)) {
      $this->names = array_keys($values);
    } if ($values instanceof ParameterHandler) {
      $this->values = $values;
    } else {
      $this->values = Parameters::fromArray($values);
    }
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
      $query .= ' (' . implode(', ', $this->names) . ') ';
    }
    if ($this->getParams()->notEmpty()) {
      if (!empty($this->names)) {
        $params = array_map(function($value) {
          return ":$value";
        }, $this->names);
      } else {
        $params = $this->getParams()->getParamNames();
      }
    } else {
      $params = array_fill(0, $this->getPDORunner()->countParams(), '?');
    }
    return $query . ' VALUES (' . implode(', ', $params) . ') ';
  }

  public function affectRows(): int {
    return $this->execute()->rowCount();
  }

  public function getParams(): ParameterHandler {
    return $this->values;
  }

}
