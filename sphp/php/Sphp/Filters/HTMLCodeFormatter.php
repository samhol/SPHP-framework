<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

use Gajus\Dindent\Indenter;

/**
 * Filter formats an `HTML` code string
 * 
 * **IMPORTANT!** manipulates only string inputs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 * @see     https://github.com/gajus/dindent
 */
class HTMLCodeFormatter extends AbstractFilter {

  /**
   * @var Indenter 
   */
  private static $formatter;

  /**
   * Constructor
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
