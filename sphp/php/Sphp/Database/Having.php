<?php

/**
 * Having.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

/**
 * Implements aggregate rules of the having clause
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-08-15
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Having extends Rule {

  public static function numberOf(string $columnName, string $comparisonOperator, $value) {
    return new static("COUNT($columnName) $comparisonOperator $value");
  }

}
