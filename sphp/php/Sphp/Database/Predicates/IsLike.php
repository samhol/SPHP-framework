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

use PDO;

/**
 * The Is LIKE predicate for SQL
 * 
 * Generates a rule to test the for a specified pattern in a column
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class IsLike extends Compare {

  protected string $op = 'LIKE';

  /**
   * Constuctor
   * 
   * * Use the `%` sign to define wildcards (missing letters in the <var>$pattern</var>).
   * * The `%` sign can be used both before and after the pattern string.
   *
   * @param  string $column the column
   * @param  string $pattern pattern string
   */
  public function __construct(string $column, string $pattern) {
    parent::__construct($column, $pattern, PDO::PARAM_STR);
  }

}
