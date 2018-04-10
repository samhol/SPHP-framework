<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database;

use Sphp\Database\Parameters\ParameterHandler;
use Sphp\Database\Parameters\SequentialParameterHandler;

/**
 * An abstract implementation of an `INSERT` statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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

  public function values(... $values) {
    $this->valuesFromArray([$values]);
    return $this;
  }

  public function valuesFromArray(array $values) {
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
      $rows[] = Utils::createGroupOfQuestionMarks(count($row));
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
    $p = new SequentialParameterHandler();
    foreach ($this->params as $row) {
      $p->appendParams($row);
    }
    return $p;
  }

}
