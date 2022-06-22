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
 * The `BETWEEN` predicate for SQL
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Between implements Predicate {

  protected string $column;
  protected string|int|float $min;
  protected string|int|float $max;
  protected string $opEnd = 'BETWEEN ? AND ?';

  /**
   * Constructor
   * 
   * @param string $column
   * @param string|int|float $min
   * @param string|int|float $max
   * @param int $paramType
   */
  public function __construct(string $column, string|int|float $min, string|int|float $max, ?int $paramType = null) {
    $this->column = $column;
    $this->min = $min;
    $this->max = $max;
    $this->paramType = $paramType;
  }

  public function getParams(): SequentialParameterHandler {
    $params = new SequentialParameterHandler();
    $params->appendNewParams([$this->min,$this->max], $this->paramType);
    return $params;
  }

  public function __toString(): string {
    return "$this->column $this->opEnd";
  }

}
