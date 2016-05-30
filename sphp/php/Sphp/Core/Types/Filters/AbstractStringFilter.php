<?php

/**
 * AbstractFilter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Types\Filters;

use Sphp\Core\Types\StringObject as StringObject;

/**
 * An abstract implementation of a string value filter
 * 
 * Filters only `string` and {@link StringObject} input. All other input types 
 * remain unchanged.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractStringFilter extends AbstractSelectiveFilter {

  /**
   * Constructs a new instance
   * 
   */
  public function __construct() {
    $checker = function($value) {
      //var_dump(is_string($value));
      return is_string($value) || $value instanceof StringObject;
    };
    parent::__construct($checker);
  }

}
