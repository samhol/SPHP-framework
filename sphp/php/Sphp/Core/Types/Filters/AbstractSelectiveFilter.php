<?php

/**
 * AbstractFilter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Types\Filters;

/**
 * An abstract implementation of a filter
 * 
 * **Important:** the value gets filtered only if the type checker {@link \Closure} 
 * is not set or return `true` for the value to be filtered
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractSelectiveFilter extends AbstractFilter {

  /**
   * the type checker lambda function
   *
   * @var \Closure|null
   */
  private $checker;

  /**
   * Constructs a new {@link self} object
   * 
   * @param  \Closure|null $checker the type checker of the filtered value
   */
  public function __construct(\Closure $checker = null) {
    $this->checker = $checker;
  }

  /**
   * Runs the filter for the given value
   * 
   * @param  mixed $value the value to filter
   * @return mixed the filtered value
   */
  abstract protected function runFilter($value);

  /**
   * Executes the filter for the given value
   * 
   * **Important:** the value gets filtered only if the type checker lambda function 
   * 
   * @param  mixed $value the value to filter
   * @return mixed the filtered value
   */
  public function filter($value) {
    if ($this->checker === null || $this->checker->__invoke($value) == true) {
      //echo "'" . $this->runFilter($value)."'\n";
      return $this->runFilter($value);
    } else {
      return $value;
    }
  }

}
