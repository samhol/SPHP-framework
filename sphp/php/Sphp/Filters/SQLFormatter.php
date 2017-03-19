<?php

/**
 * SQLFormatter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Filters;

use SqlFormatter;

/**
 * Filter formats an SQL string
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SQLFormatter extends AbstractFilter {

  public function filter($variable) {
    if (is_string($variable)) {
      return SqlFormatter::format($variable, false);
    }
    return $variable;
  }

}
