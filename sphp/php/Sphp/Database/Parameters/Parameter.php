<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Parameters;

use PDO;

/**
 * The Paramete class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Parameter {

  private mixed $value;
  private int $type;

  /**
   * Constructor
   * 
   * @param mixed $value
   * @param int|null $type
   */
  public function __construct(mixed $value, ?int $type = null) {
    $this->value = $value;
    if ($type === null) {
      $type = $this->resolveParameterType($value);
    }
    $this->type = $type;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->value);
  }

  /**
   * Resolves the PDO parameter type for the given value
   * 
   * @param  mixed $value the parameter value
   * @return int the parameter type
   */
  public function resolveParameterType(mixed $value): int {
    if (is_bool($value)) {
      $var_type = PDO::PARAM_BOOL;
    } else if (is_int($value)) {
      $var_type = PDO::PARAM_INT;
    } else if (is_null($value)) {
      $var_type = PDO::PARAM_NULL;
    } else {
      $var_type = PDO::PARAM_STR;
    }
    return $var_type;
  }

  /**
   * Returns the paramete value
   * 
   * @return mixed the parameter value
   */
  public function getValue(): mixed {
    return $this->value;
  }

  /**
   * Returns the paramete type
   * 
   * @return int the paramete type
   */
  public function getType(): int {
    return $this->type;
  }

}
