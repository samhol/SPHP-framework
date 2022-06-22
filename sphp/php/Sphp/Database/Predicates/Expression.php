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
 * The free formed predicate for SQL
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Expression implements Predicate {

  private string $expession;
  private mixed $value;
  protected ?int $paramType;

  public function __construct(string $expession, mixed $value, ?int $paramType = null) {
    $this->expession = $expession;
    $this->value = $value;
    $this->paramType = $paramType;
  }

  public function getParams(): ParameterHandler {
    $params = new SequentialParameterHandler();
    $params->appendNewParams($this->value, $this->paramType);
    return $params;
  }

  public function __toString(): string {
    return $this->expession;
  }

}
