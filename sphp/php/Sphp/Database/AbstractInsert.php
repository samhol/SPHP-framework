<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database;

use Sphp\Database\Parameters\ParameterHandler;
use Sphp\Database\Parameters\SequentialParameterHandler;
use Sphp\Database\Exceptions\InvalidStateException;
use Sphp\Stdlib\Arrays;

/**
 * An abstract implementation of an `INSERT` statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractInsert extends AbstractStatement implements Insert {

  /**
   * the table that is manipulated 
   */
  protected string $table;

  /**
   * an optional list of column(s) to be included in the query
   *
   * @var string[]
   */
  protected array $names = [];

  /**
   * a list of value(s) to be included in the query
   *
   * @var array[]
   */
  protected array $params = [];

  public function into(string $table) {
    $this->table = $table;
    return $this;
  }

  public function values(mixed ... $values) {
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
    $groupMarker = static function (int $count): string {
      return '(' . implode(', ', array_fill(0, $count, '?')) . ')';
    };
    if (Arrays::isMultidimensional($this->params)) {
      foreach ($this->params as $id => $row) {
        $count = count($row);
        if ($count === 0) {
          throw new InvalidStateException("Data row($id) has insufficient amount of parameterss");
        }
        $rows[] = $groupMarker($count);
        $out = implode(', ', $rows); 
      }
    } else {
      $out = $groupMarker(count($this->params));
    }
    return $out;
  }

  public function isValid(): bool {
    return !empty($this->params) && isset($this->table);
  }

  public function getQueryString(): string {
    if (!$this->isValid()) {
      throw new InvalidStateException('INSERT query requires atleast a table name and data to insert');
    }
    $query = "INSERT INTO $this->table";
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
      $p->appendNewParams($row);
    }
    return $p;
  }

}
