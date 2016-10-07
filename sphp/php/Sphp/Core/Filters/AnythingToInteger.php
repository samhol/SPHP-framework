<?php

/**
 * AnythingToInteger.php.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Filters;

/**
 * Filter converts an input value to a corresponding integer value according to the PHP type conversion
 * 
 * * All non negative integer values remain unchanged. 
 * * value is consideserd as an integer if it contains only numbers
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AnythingToInteger extends VariableFilter {

  /**
   * Constructs a new instance
   * 
   * @param int $default the value for noninteger values
   */
  public function __construct($default = 0) {
    parent::__construct(\FILTER_VALIDATE_INT, ['options' => ['default' => (int)$default]]);
  }

}
