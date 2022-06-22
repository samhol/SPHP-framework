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
use Sphp\Database\Exceptions\InvalidArgumentException;

/**
 * The Is In predicate for SQL
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class IsIn implements Predicate {

  protected iterable $group;
  protected string $column;
  protected string $op = 'IN';
  protected mixed $value;
  protected ?int $paramType;

  /**
   * Constructor
   * 
   * @param  string $column 
   * @param  iterable $group
   * @param  int|null $paramType data type for the parameter
   * @throws InvalidArgumentException if the group is empty collection
   */
  public function __construct(string $column, iterable $group, ?int $paramType = null) {
    $length = count($group);
    if ($length === 0) {
      throw new InvalidArgumentException("The group parameter cannot be empty");
    }
    $this->column = $column;
    $this->paramType = $paramType;
    $this->group = $group;
  }

  public function getParams(): SequentialParameterHandler {
    $params = new SequentialParameterHandler();
    $params->appendNewParams($this->group, $this->paramType);
    return $params;
  }

  public function __toString() {
    $length = count($this->group);
    $qmarkstr = '(' . implode(', ', array_fill(0, $length, '?')) . ')';
    return "$this->column $this->op $qmarkstr";
  }

}
