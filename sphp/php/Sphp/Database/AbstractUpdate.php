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
use PDO;

/**
 * An abstract implementation of an `UPDATE` statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractUpdate extends AbstractConditionalStatement implements Update {

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
   * Constructor
   * 
   * @param PDO $db
   * @param Clause $where
   */
  public function __construct(PDO $db, Clause $where = null) {
    parent::__construct($db, $where);
    $this->newData = new SequentialParameterHandler();
  }

  /**
   * Sets the table(s) which are updated
   *
   * @param  string $table the table to update
   * @return $this for a fluent interface
   */
  public function table(string $table) {
    $this->table = $table;
    return $this;
  }

  /**
   * Sets the updating data
   *
   * @param  array $data new data
   * @return $this for a fluent interface
   */
  public function set(array $data) {
    $this->newData = new SequentialParameterHandler($data);
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
