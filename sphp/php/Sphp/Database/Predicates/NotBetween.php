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

/**
 * The NOT BETWEEN predicate for SQL
 * 
 * **Notes:** 
 * 
 * * This rule is inclusive: begin and end values are included. 
 * * `TRUE` if the operand is not within the range of comparisons
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class NotBetween extends Between {

  protected string $opEnd = "NOT BETWEEN ? AND ?";

}
