<?php

/**
 * VariableFilter.php (UTF-8)
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
class VariableFilter extends AbstractFilter {

  /**
   *
   * @var int 
   */
  private $filter;

  /**
   *
   * @var mixed[] 
   */
  private $options;

  /**
   * Constructs a new instance
   * 
   * @param int $filter
   * @param mixed[] $options
   * @link  http://php.net/manual/en/filter.filters.php filter_var
   * @link  http://php.net/manual/en/filter.filters.php Types of filters
   */
  public function __construct($filter, $options = []) {
    $this->filter = $filter;
    $this->options = $options;
  }
  
  public function filter($variable) {
    return filter_var($variable, $this->filter, $this->options);
  }

}
