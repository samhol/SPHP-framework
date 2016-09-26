<?php

/**
 * CallbackFilter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Types\Filters;

/**
 * Filter converts an input value to a corresponding integer value according to the PHP type conversion
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CallbackFilter extends VariableFilter {

  /**
   * Constructs a new instance
   * 
   * @param int $callback
   */
  public function __construct($callback) {
    parent::__construct(FILTER_CALLBACK, ["options" => $callback]);
  }

}
