<?php

/**
 * RuleInterface.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database\Rules;

use Sphp\Database\Parameters\ParameterHandler;

/**
 * Defines a rule to SQL CLAUSES
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
