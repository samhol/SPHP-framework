<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Predicates;

use Sphp\Database\Parameters\SequentialParameterHandler;

/**
 * The Equals `=` predicate for SQL
 * ```php
 * <?php
 * new Equals('a', 'foo'); // a = 'foo'
 * new Equals('a', null); // a IS NULL
 * ?>
 * ```
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 * 
 * @example 
 */
class Equals implements Predicate {

  protected string $column;
  protected mixed $value;
  protected ?int $paramType;
  protected string $op = '=';
  protected string $nullOp = 'IS NULL';

  /**
   * Constructor
   * 
   * 
   * @ecample new Equals('a', 'foo'); => a = 'foo'
   * @param string $column 
   * @param string|int|float|bool|null $value
   * @param int|null $paramType data type for the parameter
   */
  public function __construct(string $column, string|int|float|bool|null $value, ?int $paramType = null) {
    $this->column = $column;
    $this->value = $value;
    $this->paramType = $paramType;
  }

  public function getParams(): SequentialParameterHandler {
    $params = new SequentialParameterHandler();
    if ($this->value !== null) {
      $params->appendNewParams($this->value, $this->paramType);
    }
    return $params;
  }

  public function __toString(): string {
    if ($this->value === null) {
      $out = "$this->column $this->nullOp";
    } else {
      $out = "$this->column $this->op ?";
    }
    return $out;
  }

}
