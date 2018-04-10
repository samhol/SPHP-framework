<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Rules;

use Sphp\Database\Parameters\ParameterHandler;

/**
 * Defines a rule to SQL CLAUSES
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface RuleInterface {

  /**
   * Returns the parameter handler containing used parameters
   * 
   * @return ParameterHandler
   */
  public function getParams(): ParameterHandler;

  /**
   * Returns the SQL rule as a string
   *
   * @return string the SQL rule as a string
   */
  public function getSQL(): string;

  /**
   * Returns the SQL rule as a string
   *
   * @return string the SQL rule as a string
   */
  public function __toString(): string;
}
