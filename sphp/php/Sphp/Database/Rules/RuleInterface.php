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

  public function getParams(): ParameterHandler;

  public function getSQL(): string;

  public function __toString(): string;
}
