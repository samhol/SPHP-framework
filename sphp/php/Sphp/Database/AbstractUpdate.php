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
use Sphp\Database\Parameters\Parameter;

/**
 * An abstract implementation of an `UPDATE` statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractUpdate extends AbstractConditionalStatement implements Update {

  /**
   * the table that is updated
   */
  private string $table;

  /** 
   * @var array<string, Parameter>
   */
  private array $data = [];

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
   * Sets the updating data for a single column
   * 
   * @param  string $name the name of the column
   * @param  mixed $value new value the of the column
   * @param  int|null $type optional PDO parameter type for a new parameter
   * @return $this for a fluent interface
   */
  public function setColumn(string $name, mixed $value, ?int $type = null) {
    $this->data[$name] = new Parameter($value, $type);
    return $this;
  }

  /**
   * Sets the updating data
   *
   * @param  array $data new data
   * @return $this for a fluent interface
   */
  public function setColumns(array $data) {
    foreach ($data as $name => $value) {
      $this->setColumn($name, $value);
    }
    return $this;
  }

  public function getParams(): ParameterHandler {
    $params = new SequentialParameterHandler();
    $params->appendParams($this->data);
    $params->appendParams($this->where->getParams());
    return $params;
  }

  protected function valuesToString(): string {
    $cols = array_keys($this->data);
    return implode(' = ?, ', $cols) . ' = ?';
  }

  public function isValid(): bool {
    return isset($this->table) && !empty($this->data);
  }

  public function getQueryString(): string {
    $out = "UPDATE $this->table SET {$this->valuesToString()}";
    if ($this->where->notEmpty()) {
      $out .= " $this->where";
    }
    return $out;
  }

  public function affectRows(): int {
    return $this->execute()->rowCount();
  }

}
