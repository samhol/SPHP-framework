<?php

/**
 * HTMLCodeFormatter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Filters;

use Gajus\Dindent\Indenter;

/**
 * Filter formats an `HTML` code string
 * 
 * **IMPORTANT!** manipulates only string inputs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @see     https://github.com/gajus/dindent
 */
class HTMLCodeFormatter extends AbstractFilter {

  /**
   *
   * @var Indenter 
   */
  private static $formatter;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    if (static::$formatter === null) {
      static::$formatter = new Indenter();
    }
  }

  public function filter($variable) {
    if (is_string($variable)) {
      return static::$formatter->indent($variable);
    }
    return $variable;
  }

}
