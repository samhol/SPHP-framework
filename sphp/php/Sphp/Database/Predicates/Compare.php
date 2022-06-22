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

use Sphp\Database\Parameters\ParameterHandler;
use Sphp\Database\Parameters\SequentialParameterHandler;

/**
 * The Compare class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class Compare implements Predicate {

  protected string $columnName;
  protected string $op;
  protected mixed $value;
  protected ?int $paramType;

  /**
   * Constructor
   * 
   * @param string $column 
   * @param mixed $value
   * @param int|null $paramType PDO data type for the parameter
   */
  public function __construct(string $column, mixed $value, ?int $paramType = null) {
    $this->columnName = $column;
    $this->value = $value;
    $this->paramType = $paramType;
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->value);
  }

  public function getParams(): ParameterHandler {
    $params = new SequentialParameterHandler();
    $params->appendNewParams($this->value, $this->paramType);
    return $params;
  }

  public function __toString(): string {
    return "$this->columnName $this->op ?";
  }

}
