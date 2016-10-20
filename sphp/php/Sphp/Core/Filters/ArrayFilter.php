<?php

/**
 * ArrayFilter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Filters;

/**
 * Filter converts a numeric input value to a corresponding roman numeral
 * 
 * * All non negative integer values remain unchanged. 
 * * value is consideserd as an integer if it contains only numbers
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @link    http://php.net/manual/en/filter.filters.php filter_var
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ArrayFilter extends AbstractFilter {

  /**
   *
   * @var mixed[]  
   */
  private $definition;

  /**
   *
   * @var boolean
   */
  private $add_empty;

  /**
   * Constructs a new instance
   * 
   * @param mixed[] $definition an array defining the arguments
   * @param boolean $add_empty
   * @link  http://php.net/manual/en/function.filter-var-array.php filter_var_array
   * @link  http://php.net/manual/en/filter.filters.php Types of filters
   */
  public function __construct(array $definition = [], $add_empty = true) {
    $this->definition = $definition;
    $this->add_empty = $add_empty;
  }

  public function filter($variable) {
    if (!is_array($variable)) {
      $variable = [];
    }
    return filter_var_array($variable, $this->definition, $this->add_empty);
  }

}
