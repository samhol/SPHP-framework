<?php

/**
 * AbstractInsert.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use Traversable;

/**
 * An abstract implementation of an SQL INSERT statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractInsert extends AbstractStatement implements Insert {

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
   * @var array[]
   */
  private $params;

  public function into(string $table) {
    $this->table = $table;
    return $this;
  }

  protected function getTable(): string {
    return $this->table;
  }

  protected function getNames(): array {
    return $this->names;
  }

  protected function generateQuestionMarks(array $data): string {
    $num = count($data);
    if ($num > 1) {
      $qMarks = array_fill(0, $num, '?');
      return '(' . implode(', ', $qMarks) . ')';
    }
    return '?';
  }

  public function values(... $values) {
    $this->valuesFromCollection([$values]);
    return $this;
  }

  public function valuesFromCollection(array $values) {
    if ($values instanceof Traversable) {
      $values = iterator_to_array($values);
    }
    $this->params = $values;
    return $this;
  }

  public function columnNames(string ... $name) {
    $this->names = $name;
    return $this;
  }

  protected function dataToStatement(): string {
    $rows = [];
    foreach ($this->params as $row) {
      $rows[] = $this->generateQuestionMarks($row);
    }
    return implode(', ', $rows);
  }

  public function statementToString(): string {
    $query = "INSERT INTO `$this->table`";
    if (!empty($this->names)) {
      $query .= ' (' . implode(', ', $this->names) . ') ';
    }

    return "$query VALUES " . $this->dataToStatement();
  }

  public function affectRows(): int {
    return $this->execute()->rowCount();
  }

  public function getParams(): ParameterHandler {
    $p = new SequentialParameters();
    foreach ($this->params as $row) {
      $p->appendParams($row);
    }
    return $p;
  }

}
